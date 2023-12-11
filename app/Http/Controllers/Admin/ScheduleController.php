<?php

namespace App\Http\Controllers\Admin;

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
        $rounds = config('league.round');
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
        $rounds = config('league.round');
        return view('admin.schedule.create', compact('league', 'rounds'));
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        $data = $this->scheduleRepository->store($input);
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
        $data = $this->scheduleRepository->update($input, $id);
        return redirect()->to('result');
    }

    public function result()
    {
        $dataResult = $this->scheduleRepository->index();
        return view('admin.schedule.result', compact('dataResult'));
    }
}
