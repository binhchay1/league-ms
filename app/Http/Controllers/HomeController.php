<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\TeamRepository;
use App\Repositories\TournamentRepository;
use App\Repositories\UserRepository;

class HomeController extends Controller
{
    protected $tournamentRepository;
    protected $teamRepository;
    protected $userRepository;
    protected $utility;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        return view('page.tournament.index', [
            'listTournament' => $listTournament,
        ]);
    }

    public function listTeam()
    {
        $listTeam = $this->teamRepository->index();
        return view('page.team.index', [
            'listTeam' => $listTeam,
        ]);
    }

    public function showInfo($name){
        $tourInfo = $this->tournamentRepository->showInfo($name);
        $listTournament = $this->tournamentRepository->index();
        return view('page.tournament.show', [
            'tourInfo' => $tourInfo,
            'listTournament' => $listTournament,
        ]);

    }
}
