<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ranking;
use App\Enums\League;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultScheduleRequest;
use App\Http\Requests\ScheduleRequest;
use App\Jobs\NotificationNextMatch;
use App\Repositories\ScheduleRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\Utility;
use App\Events\LiveScore;
use Excel;
use App\Exports\ScheduleExcel;
use App\Jobs\UpdateResultJob;
use App\Repositories\RefereeRepository;
use App\Repositories\ResultRepository;
use App\Repositories\UserLeagueRepository;

class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $leagueRepository;
    protected $notificationRepository;
    protected $userLeagueRepository;
    protected $resultRepository;
    protected $refereeRepository;
    protected $utility;

    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeagueRepository $leagueRepository,
        NotificationRepository $notificationRepository,
        UserLeagueRepository $userLeagueRepository,
        ResultRepository $resultRepository,
        RefereeRepository $refereeRepository,
        Utility $utility
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->leagueRepository = $leagueRepository;
        $this->notificationRepository = $notificationRepository;
        $this->userLeagueRepository = $userLeagueRepository;
        $this->resultRepository = $resultRepository;
        $this->refereeRepository = $refereeRepository;
        $this->utility = $utility;
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

    public function leagueSchedule($slug)
    {
        $league = $this->leagueRepository->show($slug);
        $rounds =  Ranking::RANKING_ARRAY_ROUND;

        return view('admin.schedule.create', compact('league', 'rounds'));
    }

    public function store(Request $request)
    {
        $leagueById = $request->league_id;
        $getLeague = $this->leagueRepository->leagueId($leagueById);

        $listMember = $getLeague->userLeagues;

        if (count($listMember) < 4) {
            $report = __('The number of members participating in the tournament must be greater than 4');
            return back()->with('error', $report);
        }
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

    public function edit($id)
    {
        $dataSchedule = $this->scheduleRepository->showInfo($id);
        $rounds =  Ranking::RANKING_ARRAY_ROUND;

        return view('admin.schedule.edit', compact('dataSchedule', 'rounds'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $input = $request->except(['_token']);
        $this->scheduleRepository->updateLeague($input, $id);
        return redirect('list-schedule')->with('success', 'Schedule successfully updated.');
    }

    public function show($id)
    {
        $dataSchedule = $this->scheduleRepository->showInfo($id);

        return view('admin.schedule.show', compact('dataSchedule'));
    }

    public function updateResult(ResultScheduleRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $this->scheduleRepository->updateResult($input, $id);

        if ($input['result_team_1'] == 2 or $input['result_team_2'] == 2) {
            $league_id = $input['league_id'];
            $match = (int) $input['match'] + 1;

            NotificationNextMatch::dispatch($league_id, $match, $this->leagueRepository, $this->scheduleRepository, $this->notificationRepository)->onQueue('next-match');
        }

        return redirect()->to('result')->with('success', 'Result successfully updated.');
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
        $dateData = $getLeague->start_date;
        $countNextDate = 1;
        if (strpos($getLeague->type_of_league, 'singles') !== false) {
            if ($totalMembers < 4) {
                $report = __('The number of members participating in the tournament must be greater than 4');
                return redirect()->route('schedule.leagueSchedule', $getLeague->slug)->with('error', $report);
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
        } else {
            $countLack = 0;
            $breakFor = 0;
            if ($totalMembers < 8) {
                $report = __('The number of members participating in the tournament must be greater than 8');
                return redirect()->route('schedule.leagueSchedule', $getLeague->slug)->with('error', $report);
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
                $countNextDate++;
            }

            $whileMatch = $totalMatch = $preCountMatch = $countMatch - 1;

            if(($countMatch - 1) % 2 != 0) {
                $whileMatch = $totalMatch = $preCountMatch = $countMatch;
            } else {
                $whileMatch = $totalMatch = $preCountMatch = $countMatch - 1;
            }

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

                $roundInsert = League::ROUND_PER_LEAGUE[$preRound][$indexRound];

                $data = [
                    'league_id' => $getLeague->id,
                    'match' => $countMatch,
                    'round' => $roundInsert,
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

            if ($countLack != 0) {
                $stringAfter = __('Your league need ');
                $stringBefore = __(' member to be use auto create schedule');
                $report = $stringAfter . $countLack . $stringBefore;

                return redirect()->route('schedule.leagueSchedule', $getLeague->slug)->with('error', $report);
            }
        }

        $this->scheduleRepository->createMultiple($dataSchedule);

        return redirect()->route('schedule.index')->with('success', __('Create auto schedule successfully!'));
    }


    public function exportSchedule($id)
    {
        $getSchedule = $this->scheduleRepository->getScheduleById($id);

        if (empty($getSchedule)) {
            abort(404);
        }
        $getUserLeague = $this->userLeagueRepository->getLeagueByUserIdAndLeagueId(Auth::user()->id, $getSchedule->league_id);

        if (empty($getUserLeague)) {
            abort(403);
        }

        $getLeague = $this->leagueRepository->getLeagueById($getSchedule->league_id);
        $getResult = $this->resultRepository->getResultByScheduleId($id);
        $getReferees = $this->refereeRepository->getRefereeByScheduleId($getSchedule->id);
        $name = 'results_' . $getLeague->slug . '_' . $getSchedule->match . '_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new ScheduleExcel($getSchedule, $getResult, $getLeague, $getReferees), $name);
    }
}
