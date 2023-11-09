<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\TeamRepository;
use App\Repositories\TournamentRepository;


class HomeController extends Controller
{
    protected $tournamentRepository;
    protected $teamRepository;
    protected $utility;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(
        TournamentRepository $tournamentRepository,
        TeamRepository $teamRepository,
        Utility $ultity
    ) {
        $this->tournamentRepository = $tournamentRepository;
        $this->teamRepository = $teamRepository;
        $this->utility = $ultity;
    }

    public function viewHome()
    {
        return view('page.homepage');
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
        return view ('page.team.index', [
            'listTeam' => $listTeam,
        ]);
    }
}
