<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ScheduleRepository;
use App\Repositories\TeamRepository;
use App\Repositories\TournamentRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $teamRepository;
    protected $tournamentRepository;

    public function __construct(
        TeamRepository $teamRepository,
        ScheduleRepository $scheduleRepository,
        TournamentRepository $tournamentRepository

    ) {
        $this->teamRepository = $teamRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->tournamentRepository = $tournamentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listSchedule = $this->scheduleRepository->index();
        return view('admin.schedule.index', [
            'listSchedule' =>$listSchedule,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listTeam1 = $this->teamRepository->index();
        $listTeam2 = $this->teamRepository->index();
        $listTournament = $this->tournamentRepository->index();
        return view('admin.schedule.create', [
            'listTeam1' =>$listTeam1,
            'listTeam2' =>$listTeam2,
            'listTournament' =>$listTournament,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        $data = $this->scheduleRepository->store($input);

        return redirect()->back()->with('success', 'Create schedule successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataSchedule = $this->scheduleRepository->showInfo($id);
        return view('admin.schedule.show',['dataSchedule' => $dataSchedule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        $data = $this->scheduleRepository->update($input, $id);
        return redirect()->to('result');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function result()
    {
        $dataResult = $this->scheduleRepository->index();
        dd($dataResult);
        return view('admin.schedule.result', ['dataResult'=> $dataResult]);
    }
}
