<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ScheduleExcel implements FromView, WithColumnWidths
{
    protected $schedule;
    protected $result;
    protected $league;
    protected $referees;

    public function __construct($schedule, $result, $league, $referees)
    {
        $this->schedule = $schedule;
        $this->result = $result;
        $this->league = $league;
        $this->referees = $referees;
    }

    public function view(): View
    {
        return view('exports.result-schedule', [
            'schedule' => $this->schedule,
            'result' => $this->result,
            'league' => $this->league,
            'referees' => $this->referees,
        ]);
    }

    public function columnWidths(): array
    {
        $alphas = range('A', 'Z');
        $arrColumn = array();
        foreach($alphas as $character) {
            $arrColumn[$character] = 5;
            $arrColumn['A' . $character] = 5;
        }

        return $arrColumn;
    }
}
