<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\GroupRepository;
use App\Repositories\TeamRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\MatchesRepository;
use App\Repositories\UserRepository;
use App\Repositories\GroupUserRepository;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use Session;

class HomeController extends Controller
{
    protected $leagueRepository;
    protected $teamRepository;
    protected $userRepository;
    protected $matchesRepository;
    protected $groupRepository;
    protected $groupUserRepository;
    protected $messageRepository;
    protected $utility;

    public function __construct(
        LeagueRepository $leagueRepository,
        TeamRepository $teamRepository,
        UserRepository $userRepository,
        MatchesRepository $matchesRepository,
        GroupRepository $groupRepository,
        GroupUserRepository $groupUserRepository,
        MessageRepository $messageRepository,
        Utility $ultity
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->matchesRepository = $matchesRepository;
        $this->groupRepository = $groupRepository;
        $this->groupUserRepository = $groupUserRepository;
        $this->messageRepository = $messageRepository;
        $this->utility = $ultity;
    }

    public function viewHome()
    {
        $totalMatch = $this->matchesRepository->count();
        $totalTeam = $this->teamRepository->count();
        $totalLeague = $this->leagueRepository->count();
        $totalView = strtotime(date('Y-m-d H:i:s')) / 1242222;

        return view('page.homepage', compact('totalMatch', 'totalTeam', 'totalLeague', 'totalView'));
    }

    public function viewSearch(Request $request)
    {
        $search = $request->get('search');
        $isList = false;
        if ($search) {
            $listLeagueBySearch = $this->leagueRepository->getLeagueBySearch($search);
            if ($listLeagueBySearch->count() > 0) {
                $isList = true;
            }

            return view('page.search', compact('listLeagueBySearch', 'search', 'isList'));
        }

        return view('page.search', compact('search', 'isList'));
    }

    public function viewShop()
    {
        return view('page.shop.index');
    }

    public function viewAbout()
    {
        return view('page.about');
    }

    public function viewPricing()
    {
        return view('page.pricing');
    }

    public function viewPrivacy()
    {
        return view('page.privacy');
    }

    public function viewTermAndConditions()
    {
        return view('page.term');
    }

    public function viewTeamRegister()
    {
        return view('page.team-register');
    }

    public function listLeague()
    {
        $listLeague = $this->leagueRepository->index();

        return view('page.league.index', compact('listLeague'));
    }

    public function listTeam()
    {
        $listTeam = $this->teamRepository->index();

        return view('page.team.index', compact('listTeam'));
    }

    public function listGroup()
    {
        $getGroup = $this->groupRepository->getGroupWithStatus();
        $listGroup = $this->utility->paginate($getGroup, 30);

        return view('page.group.index', compact('listGroup'));
    }

    public function showInfo($slug)
    {
        $tourInfo = $this->leagueRepository->showInfo($slug);
        $listLeague = $this->leagueRepository->index();
        $groupSchedule = [];

        foreach ($tourInfo->schedule as $schedule) {
            $groupSchedule[$schedule['match']][] = $schedule;
        }

        return view('page.league.show', compact('groupSchedule', 'tourInfo', 'listLeague'));
    }

    public function changeLocate($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    public function detailGroup(Request $request)
    {
        $nameGroup = $request->get('g_i');
        if (empty($nameGroup)) {
            abort(404);
        }

        $user = Auth::user();
        $getGroup = $this->groupRepository->getGroupByName($nameGroup);
        if (empty($getGroup)) {
            abort(404);
        }

        $checkJoined = $this->groupUserRepository->checkJoinedGroupByName($user->id, $getGroup->id);
        if (empty($checkJoined)) {
            $isJoined = false;
        } else {
            $isJoined = true;
        }
        $messages = $this->messageRepository->getMessagesByGroupId($getGroup->id);
        $members = $this->groupUserRepository->getMembersByGroupId($getGroup->id);

        return view('page.group.detail', compact('getGroup', 'messages', 'members', 'isJoined'));
    }
}
