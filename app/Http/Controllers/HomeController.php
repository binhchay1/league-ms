<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\TeamRepository;
use App\Repositories\TournamentRepository;
use App\Repositories\UserRepository;
use Config;
use Session;

class HomeController extends Controller
{
    protected $tournamentRepository;
    protected $teamRepository;
    protected $userRepository;
    protected $utility;

    public function __construct(
        TournamentRepository $tournamentRepository,
        TeamRepository $teamRepository,
        UserRepository $userRepository,
        Utility $ultity
    ) {
        $this->tournamentRepository = $tournamentRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->utility = $ultity;
    }

    public function viewHome()
    {
        $totalUser = $this->userRepository->count();
        $totalTeam = $this->teamRepository->count();
        $totalTour = $this->tournamentRepository->count();
        $totalView = strtotime(date('Y-m-d H:i:s')) / 1242222;

        return view('page.homepage', compact('totalUser', 'totalTeam', 'totalTour', 'totalView'));
    }

    public function listTour()
    {
        $listTournament = $this->tournamentRepository->index();
        return view('page.tournament.index', compact('listTournament'));
    }

    public function listTeam()
    {
        $listTeam = $this->teamRepository->index();
        return view('page.team.index', compact('listTeam'));
    }

    public function showInfo($slug)
    {
        $tourInfo = $this->tournamentRepository->showInfo($slug);
        $listTournament = $this->tournamentRepository->index();
        $groupSchedule = [];

        foreach ($tourInfo->schedule as $schedule) {
            $groupSchedule[$schedule['match']][] = $schedule;
        }

        return view('page.tournament.show', compact('groupSchedule', 'tourInfo', 'listTournament'));
    }

    public function changeLocate($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
