<?php

namespace App\Http\Controllers\User;

use App\Enums\League;
use App\Enums\Ranking;
use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Requests\LeagueUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\Ranks;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserLeague;
use App\Repositories\GroupRepository;
use App\Repositories\GroupUserRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\UserLeagueRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $leagueRepository;
    protected $groupRepository;
    protected $userLeagueRepository;
    protected $scheduleRepository;
    protected $userRepository;
    protected $utility;

    public function __construct(
        UserLeagueRepository $userLeagueRepository,
        GroupRepository $groupRepository,
        ScheduleRepository $scheduleRepository,
        UserRepository $userRepository,
        LeagueRepository $leagueRepository,
        Utility $utility
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->userRepository = $userRepository;
        $this->leagueRepository = $leagueRepository;
        $this->utility = $utility;
        $this->userLeagueRepository = $userLeagueRepository;
        $this->groupRepository = $groupRepository;
    }

    public function show($id)
    {
        $dataUser = $this->userRepository->showInfo($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);
        return view('page.user.profile', ['dataUser' => $dataUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $userIdHash)
    {
        if (empty($userIdHash)) {
            abort(404);
        }

        $input = $request->except(['_token']);
        if (isset($input['profile_photo_path'])) {
            $img = $this->utility->saveImageUser($input);
            if ($img) {
                $path = 'images/upload/user/' . $input['profile_photo_path']->getClientOriginalName();
                $input['profile_photo_path'] = $path;
            }
        }
        $this->userRepository->update($input, $userIdHash);
        return back()->with('success', __('Information has been updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('page.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", __("Old passwords do not match!"));
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", __("Password successfully changed!"));
    }

    public function deleteAccount()
    {
        if (Auth::user()->apple == null) {
            abort(403);
        }

        $getUser = $this->userRepository->getUserByAppleID(Auth::user()->apple_id);

        if (!$getUser) {
            abort(404);
        } else {
            Session::flush();
            $this->userRepository->deleteById($getUser->id);
            Auth::guard('web')->logout();
        }

        return redirect()->route('login');
    }

    public function viewMyLeague()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);

        $getLeague = $dataUser->league()->orderByRaw("CASE WHEN status = '1' THEN 1 ELSE 2 END") // Active trước, inactive sau
        ->orderBy('id', 'desc') // Sắp xếp theo id giảm dần
        ->get();
        $listLeague = $this->utility->paginate($getLeague, 10, '/my-league');

        return view('page.user.my-league.my-league', compact('listLeague'));
    }

    public function leagueJoin()
    {
        $user = auth()->user();
        $getLeague = \App\Models\League::whereHas('userLeagues', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();
        $listLeague = $this->utility->paginate($getLeague, 10, '/my-league');

        return view('page.user.my-league.my-league-join', compact('listLeague'));
    }

    public function leagueCreated()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);

        $getLeague = $dataUser->league()->orderByRaw("CASE WHEN status = '1' THEN 1 ELSE 2 END") // Active trước, inactive sau
        ->orderBy('id', 'desc') // Sắp xếp theo id giảm dần
        ->get();
        $listLeague = $this->utility->paginate($getLeague, 10, '/my-league');

        return view('page.user.my-league.my-league-create', compact('listLeague'));
    }

    public function leagueSetting($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail.setting', compact( 'champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function leagueActivity($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail.setting.activity-history', compact( 'champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function leagueConfig($slug)
    {
        $listPlayer = \App\Enums\League::NUMBER_PLAYER;
        $listTypeLeague = \App\Enums\League::TYPE;
        $listFormatLeague = \App\Enums\League::FORMAT;
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail.setting.config', compact( 'listTypeLeague','listPlayer', 'listFormatLeague','champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function leagueStatus($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail.setting.activity-status', compact( 'champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function leagueManagerPlayer($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail.setting.manager-player', compact( 'champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function leagueSchedule($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }

        $players = UserLeague::with('user')
            ->where('league_id', $leagueInfor->id)
            ->get()
            ->map(function ($registration) {
                return (object)[
                    'id' => $registration->id, // hoặc registration_id nếu bạn dùng nó làm player1_id
                    'name' => $registration->user->name ?? 'Unknown',
                ];
            });
        $listSchedule = $leagueInfor->schedule;
        return view('page.user.my-league.detail.setting.manager-schedule', compact( 'listSchedule', 'players','champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function detailMyLeague($slug)
    {
        $user = Auth::user()->id;
        $leagueInfor = $this->leagueRepository->myLeague($slug, $user);
        if (empty($leagueInfor)) {
            abort(404);
        }
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $countMatch = count($leagueInfor->schedule) ?? 0;
        $countPlayer = count($leagueInfor->userLeagues) ?? 0;
        $firstGroup = reset($groupSchedule);
        if (is_array($firstGroup)) {
            $firstThreeSchedules = array_slice($firstGroup, 0, 3);
        } else {
            $firstThreeSchedules = [];
        }

        $registrations = UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->get();
        $pendingCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 0)->count();
        $acceptedCount =UserLeague::with(['user', 'partner'])
            ->where('league_id', $leagueInfor->id)
            ->where('status', 1)->count();

        // ===== XỬ LÝ RANKING =====
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }
        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail-my-league', compact( 'champion','hasEnded', 'champion','topRank', 'bottomRank','ranking','registrations','pendingCount', 'acceptedCount','countPlayer','countMatch','firstThreeSchedules','leagueInfor','getListLeagues', 'groupSchedule'));
    }

    public function infoMyLeague($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->getLeagueHome();
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        $listType = Ranking::RANKING_ARRAY_TYPE;
        $listFormat = Ranking::RANKING_ARRAY_FORMAT;
        $listPlayer = \App\Enums\League::NUMBER_PLAYER;
        $listTypeLeague = \App\Enums\League::TYPE;
        $listFormatLeague = \App\Enums\League::FORMAT;

        $currentDate = now()->format('Y-m-d');
        $hasEnded = $currentDate > $leagueInfor->end_date;
        $topRank = null;
        $bottomRank = null;
        if ($leagueInfor->format_of_league === 'round-robin') {
            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->orderByDesc('point')
                ->orderByDesc('win')
                ->orderBy('match_played')
                ->get();
            $topRank = $ranking->first();
            $bottomRank = $ranking->last();

        } elseif ($leagueInfor->format_of_league === 'knockout') {
            $priority = [
                null => 999,
                'final' => 1,
                'semi-finals' => 2,
                'quarter-finals' => 3,
                'round-of-16' => 4,
                'round-of-32' => 5,
                'round-of-64' => 6,
            ];

            $ranking = Ranks::where('league_id', $leagueInfor->id)
                ->with(['user.partner', 'league'])
                ->get()
                ->sortBy(fn($r) => $priority[$r->eliminated_round] ?? 999)
                ->values(); // Reindex

            $topRank = $ranking->first();
            $bottomRank = $ranking->last();
        } else {
            $ranking = collect(); // fallback nếu không xác định được loại giải
        }

        $champion = null;
        if ($hasEnded) {
            if ($leagueInfor->format_of_league === 'knockout') {
                $champion = $ranking->firstWhere('eliminated_round', null);
            } else {
                $champion = $ranking->first(); // đã sort theo point + win
            }
        }
        return view('page.user.my-league.detail-my-league', compact('hasEnded', 'champion','listFormatLeague','listTypeLeague','groupSchedule','leagueInfor', 'listLeagues', 'getListLeagues','listPlayer','listFormat','listType'));

    }

    public function updateMyLeague(LeagueUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);

        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }
        $this->leagueRepository->updateLeague($input, $id);

        return redirect()->back()->with('success', __('League updated successfully!'));
    }

    public function deleteMyLeague($id)
    {
        $this->leagueRepository->deleteMyLeague($id);

        return redirect()->route('my.league')->with('success', 'League delete successfully');
    }

    public function updateScheduleRobin(Request $request, $id)
    {
        $schedule =  $this->scheduleRepository->showInfo($id);;

        if ($schedule->result_team_1 !== null || $schedule->result_team_2 !== null) {
            return redirect()->back()->with('error', 'Cannot update schedule with result.');
        }


        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $league = $schedule->league;
        // Kiểm tra date nằm trong khoảng start_date và end_date
        if ($request->date < $league->start_date || $request->date > $league->end_date) {
            return back()
                ->with(['error' => 'The match date must fall within the tournament period.'])
                ->withInput()
                ->with('modal_schedule_id', $schedule->id);
        }
        // Kiểm tra so với trận round trước
        $previousMatch = Schedule::where('league_id', $league->id)
            ->where('round', '<', $schedule->round)
            ->orderByDesc('round')
            ->first();
        if ($previousMatch) {
            $prevDateTime = Carbon::parse($previousMatch->date . ' ' . $previousMatch->time);
            $currentDateTime = Carbon::parse($request->date . ' ' . $request->time);
            if ($currentDateTime->lessThanOrEqualTo($prevDateTime)) {
                return back()
                    ->with(['error' => 'Match time must be after the previous round match.'])
                    ->withInput()
                    ->with('modal_schedule_id', $schedule->id);
            }
        }

        $schedule->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            // 'player1_team_id' => $request->input('player1_team_id'), nếu cho phép đổi đội
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }

    public function updateScheduleKnockout(Request $request, $id)
    {
        $schedule =  $this->scheduleRepository->showInfo($id);;

        if ($schedule->result_team_1 !== null || $schedule->result_team_2 !== null) {
            return redirect()->back()->with('error', 'Cannot update schedule with result.');
        }

        $schedule->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            // 'player1_team_id' => $request->input('player1_team_id'), nếu cho phép đổi đội
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }

    public function myGroupActiveUser($id)
    {
        $user = Auth::user()->id;
        $group = $this->groupRepository->myGroupActive($id, $user);
        if (empty($group)) {
            abort(404);
        }

        return view('page.user.my-group.my-group-active-user', compact('group'));
    }

    public function autoCreateMyLeague(Request $request)
    {
        if (empty($request->get('s'))) {
            abort(404);
        }

        $slug = $request->get('s');
        $getLeague = $this->leagueRepository->getLeagueBySlug($slug);

        if (empty($getLeague)) {
            abort(404);
        }

        $listMember = $getLeague->userLeagues;
        $listAuto = [];
        foreach ($listMember as $member) {
            $listAuto[] = $member->user_id;
        }
        shuffle($listAuto);
        $dataSchedule = [];
        $timeInDay = $getLeague->start_time;
        $countMatch = 1;
        $totalMembers = count($listAuto);
        $dateData = $getLeague->start_date;
        $countNextDate = 1;

    if(strpos($getLeague->format_of_league, 'round-robin') !== false) {
        if ($totalMembers < 4) {
            $report = __('The number of members participating in the tournament must be greater than 4');
            return back()->with('error', $report);
        }
        // Thiết lập thời gian bắt đầu
        $startDate = \Carbon\Carbon::parse($getLeague->start_date);
        $startTime = \Carbon\Carbon::parse($getLeague->start_time);

// Số trận tối đa mỗi ngày
        $matchesPerDay = 3;
        $currentDate = $startDate->copy();
        $currentTime = $startTime->copy();
        $matchInDay = 0;

// Sinh lịch thi đấu vòng tròn (chỉ lượt đi)
        for ($i = 0; $i < $totalMembers - 1; $i++) {
            for ($j = $i + 1; $j < $totalMembers; $j++) {
                // Thêm lịch đấu
                $dataSchedule[] = [
                    'league_id'      => $getLeague->id,
                    'player1_team_1'  => $listAuto[$i],
                    'player1_team_2'  => $listAuto[$j],
                    'match'          =>  $countMatch,
                    'round'          => 'Round ' . $countMatch,
                    'date'           => $currentDate->toDateString(),
                    'time'           => $currentTime->format('H:i'),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];

                $countMatch++;
                $matchInDay++;
                $currentTime->addHours(1); // mỗi trận cách nhau 1 giờ

                // Nếu đủ số trận 1 ngày thì chuyển sang ngày mới
                if ($matchInDay >= $matchesPerDay) {
                    $currentDate->addDay();
                    $currentTime = $startTime->copy();
                    $matchInDay = 0;
                }
            }
        }
    } else {
            if ($totalMembers < 4) {
                $report = __('The number of members participating in the tournament must be greater than 4');
                return back()->with('error', $report);
            }

            if ($totalMembers == 4) {
                $round = 'semi-finals';
            } elseif ($totalMembers <= 8) {
                $round = 'quarter-finals';
            } elseif ($totalMembers <= 16) {
                $round = 'round 2';
            } else {
                $round = 'round 1';
            }

            for ($i = 0; $i < count($listAuto); $i++) {
                if ($i % 2 != 0) {
                    continue;
                }
                if ($countNextDate == 4) {
                    $dateData = date('Y-m-d', strtotime($dateData . ' +1 day'));
                    $countNextDate = 1;
                }
                $data = [
                    'league_id' => $getLeague->id,
                    'match' => $countMatch,
                    'round' => $round,
                    'time' => $timeInDay,
                    'date' => $dateData,
                    'player1_team_1' => $listAuto[$i]
                ];
                if ($i != (count($listAuto) - 1)) {
                    $data['player1_team_2'] = $listAuto[$i + 1];
                }

                $dataSchedule[] = $data;
                $endTime = strtotime($timeInDay) + (90 * 60);
                $timeInDay = date('h:i:s', $endTime);
                $countMatch++;
                $countNextDate++;
            }

            $whileMatch = $totalMatch = $preCountMatch = $countMatch - 1;
            while ($whileMatch != 1) {
                $whileMatch = $whileMatch / 2;
                $totalMatch = $totalMatch + $whileMatch;
            }
            $forMatch = $totalMatch - $preCountMatch;
            $countNextDate = 1;
            $indexRound = 1;
            $countMatchIndex = 0;
            $preRound = $round;
            $dateData = date('Y-m-d', strtotime($dateData . ' +1 day'));
            for ($i = 0; $i < $forMatch; $i++) {
                if ($countNextDate == 4) {
                    $dateData = date('Y-m-d', strtotime($dateData . ' +1 day'));
                    $countNextDate = 1;
                }
                if ($countMatchIndex == $preCountMatch / 2) {
                    $preCountMatch = $preCountMatch / 2;
                    $countMatchIndex = 0;
                    $indexRound++;
                }

                $round = League::ROUND_PER_LEAGUE[$preRound][$indexRound];

                $data = [
                    'league_id' => $getLeague->id,
                    'match' => $countMatch,
                    'round' => $round,
                    'time' => $timeInDay,
                    'date' => $dateData,
                ];

                $dataSchedule[] = $data;
                $endTime = strtotime($timeInDay) + (90 * 60);
                $timeInDay = date('h:i:s', $endTime);
                $countMatch++;
                $countNextDate++;
                $countMatchIndex++;
            }

    }
        $this->scheduleRepository->createMultiple($dataSchedule);

        return back()->with('success', __('Create auto schedule successfully!'));
    }

    public function viewMyGroup()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);

        $getGroup = $dataUser->groups;
        $listGroup = $this->utility->paginate($getGroup, 10, '/my-group');

        return view('page.user.my-group.my-group', compact('listGroup'));
    }

    public function groupJoin()
    {
        $user = auth()->user();
        $getGroup = $user->group()
            ->with('groups') // eager load
            ->get()
            ->pluck('groups');

        $listGroup = $this->utility->paginate($getGroup, 10, '/my-group');
        return view('page.user.my-group.my-group-join', compact('listGroup'));
    }

    public function groupCreated()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);
        $getGroup = $dataUser->groups;
        $listGroup = $this->utility->paginate($getGroup, 10, '/my-group');

        return view('page.user.my-group.my-group-create', compact('listGroup'));
    }

    public function infoMyGroup($id)
    {
        $dataGroup = $this->groupRepository->getById($id);

        return view('page.user.my-group.edit', compact('dataGroup'));
    }

    public function updateMyGroup(GroupUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->updateById($id, $input);

        return redirect()->route('my.group')->with('success', __('Group updated successfully!'));
    }

    public function deleteMyGroup($id)
    {
        $this->leagueRepository->deleteMyLeague($id);

        return redirect()->route('my.group')->with('success', 'Group delete successfully');
    }
}
