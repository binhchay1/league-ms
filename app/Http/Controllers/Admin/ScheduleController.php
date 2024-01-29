<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ranking;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultScheduleRequest;
use App\Jobs\NotificationNextMatch;
use App\Repositories\ScheduleRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $leagueRepository;
    protected $notificationRepository;

    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeagueRepository $leagueRepository,
        NotificationRepository $notificationRepository

    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->leagueRepository = $leagueRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $user = Auth::user()->id;
        $listLeagues = $this->leagueRepository->index($user);
        $rounds =  Ranking::RANKING_ARRAY_ROUND;
        $listSchedules = $this->scheduleRepository->index();

        return view('admin.schedule.index', compact('listSchedules', 'listLeagues', 'rounds'));
    }

    public function league()
    {
        $user = Auth::user()->id;
        $listLeagues = $this->leagueRepository->index($user);

        return view('admin.schedule.list-league', compact('listLeagues'));
    }

    public function leagueSchedule($lug)
    {
        $league = $this->leagueRepository->show($lug);
        $rounds =  Ranking::RANKING_ARRAY_ROUND;

        return view('admin.schedule.create', compact('league', 'rounds'));
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        foreach ($input as $key => $arrValue) {
            $count = count($arrValue);
            break;
        }
        for ($i = 0; $i < $count; $i++) {
            $dataRecord = [];
            foreach ($input as $key => $arrValue) {
                if ($key == 'league_id') {
                    $dataRecord['league_id'] = $arrValue;
                } else {
                    $dataRecord[$key] = $arrValue[$i];
                }
            }

            $this->scheduleRepository->store($dataRecord);
        }

        return redirect('list-schedule')->with('success', 'Create schedule successfully!');
    }

    public function show($id)
    {
        $dataSchedule = $this->scheduleRepository->showInfo($id);

        return view('admin.schedule.show', compact('dataSchedule'));
    }

    public function update(ResultScheduleRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $this->scheduleRepository->update($input, $id);

        if ($input['result_team_1'] == 2 or $input['result_team_2'] == 2) {
            $league_id = $input['league_id'];
            $match = (int) $input['match'] + 1;

            NotificationNextMatch::dispatch($league_id, $match, $this->leagueRepository, $this->scheduleRepository, $this->notificationRepository)->onQueue('next-match');
        }

        return redirect()->to('result');
    }

    public function result()
    {
        $user = Auth::user()->id;
        $listLeagues = $this->leagueRepository->index($user);
        $rounds =  Ranking::RANKING_ARRAY_ROUND;
        $dataResult = $this->scheduleRepository->index();

        return view('admin.schedule.result', compact('dataResult', 'listLeagues', 'rounds'));
    }

    public function autoCreateLeague(Request $request)
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

        if (strpos($getLeague->type_of_league, 'singles') > 0) {
            if ($totalMembers < 4) {
                $report = __('The number of members participating in the tournament must be greater than 4');
                return redirect()->route('schedule.leagueSchedule', $getLeague->id)->with('message', $report);
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

                $data = [
                    'league_id' => $getLeague->id,
                    'match' => $countMatch,
                    'round' => $round,
                    'time' => $timeInDay,
                    'date' => $getLeague->start_date,
                    'player1_team_1' => $listAuto[$i],
                ];

                if ($i != (count($listAuto) - 1)) {
                    $data['player1_team_2'] = $listAuto[$i + 1];
                }

                $dataSchedule[] = $data;
                $endTime = strtotime($timeInDay) + (90 * 60);
                $timeInDay = date('h:i:s', $endTime);
                $countMatch++;
            }
        } else {
            $countLack = 0;
            $breakFor = 0;
            if ($totalMembers < 8) {
                $report = __('The number of members participating in the tournament must be greater than 8');
                return redirect()->route('schedule.leagueSchedule', $getLeague->id)->with('message', $report);
            }

            if ($totalMembers <= 8) {
                $round = 'semi-finals';
            } elseif ($totalMembers <= 16) {
                $round = 'quarter-finals';
            } elseif ($totalMembers <= 32) {
                $round = 'round 2';
            } else {
                $round = 'round 1';
            }

            for ($i = 0; $i < count($listAuto); $i++) {

                if ($i <= $breakFor and $i != 0) {
                    continue;
                }

                $data = [
                    'league_id' => $getLeague->id,
                    'match' => $countMatch,
                    'round' => $round,
                    'time' => $timeInDay,
                    'date' => $getLeague->start_date,
                    'player1_team_1' => $listAuto[$i],
                ];

                if (!isset($listAuto[$i + 1])) {
                    $countLack++;
                    break;
                } else {
                    $data['player2_team_1'] = $listAuto[$i + 1];
                    if (!isset($listAuto[$i + 2])) {
                        $countLack = 0;
                        $dataSchedule[] = $data;
                        break;
                    } else {
                        $data['player1_team_2'] = $listAuto[$i + 2];
                        if (!isset($listAuto[$i + 3])) {
                            $countLack++;
                            break;
                        } else {
                            $data['player2_team_2'] = $listAuto[$i + 3];
                        }
                    }
                }

                $dataSchedule[] = $data;
                $endTime = strtotime($timeInDay) + (90 * 60);
                $timeInDay = date('h:i:s', $endTime);
                $breakFor = $i + 3;
                $countMatch++;
            }

            if ($countLack != 0) {
                $stringAfter = __('Your league need ');
                $stringBefore = __(' member to be use auto create schedule');
                $report = $stringAfter . $countLack . $stringBefore;

                return redirect()->route('schedule.leagueSchedule', $getLeague->id)->with('message', $report);
            }
        }

        $this->scheduleRepository->createMultiple($dataSchedule);

        return redirect()->route('schedule.index')->with('message', __('Create auto schedule successfully!'));
    }
}
