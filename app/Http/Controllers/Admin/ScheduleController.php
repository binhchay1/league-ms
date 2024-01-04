<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ranking;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultScheduleRequest;
use App\Http\Requests\ScheduleRequest;
use App\Repositories\ScheduleRepository;
use App\Repositories\LeagueRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $leagueRepository;

    public function __construct(
        ScheduleRepository $scheduleRepository,
        LeagueRepository $leagueRepository

    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->leagueRepository = $leagueRepository;
    }

    public function index()
    {
        $listLeagues = $this->leagueRepository->index();
        $rounds =  Ranking::RANKING_ARRAY_ROUND;
        $listSchedules = $this->scheduleRepository->index();

        return view('admin.schedule.index', compact('listSchedules', 'listLeagues', 'rounds'));
    }

    public function league()
    {
        $listLeagues = $this->leagueRepository->index();

        return view('admin.schedule.list-league', compact('listLeagues'));
    }

    public function leagueSchedule($id)
    {
        $league = $this->leagueRepository->show($id);
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

            // $getNextSchedule = $this->scheduleRepository->getScheduleByLeagueAndMatch($league_id, $match);
            // dd($getNextSchedule);

            // if (!empty($getNextSchedule)) {
            //     if() {

            //     }
            // }
        }


        return redirect()->to('result');
    }

    public function result()
    {
        $listLeagues = $this->leagueRepository->index();
        $rounds =  Ranking::RANKING_ARRAY_ROUND;
        $dataResult = $this->scheduleRepository->index();

        return view('admin.schedule.result', compact('dataResult', 'listLeagues', 'rounds'));
    }
}
