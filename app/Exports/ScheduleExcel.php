<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScheduleExcel implements FromView
{
    protected $leagueRepository;
    protected $scheduleRepository;
    protected $id;

    public function __construct($leagueRepository, $scheduleRepository, $id)
    {
        $this->leagueRepository = $leagueRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->id = $id;
    }

    public function view(): View
    {
        $getSchedule = $this->scheduleRepository->getScheduleById($this->id);
        $getLeague = $this->leagueRepository->getLeagueById($getSchedule->league_id);

        return view('exports.result-schedule');
    }
}
