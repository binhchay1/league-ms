<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\TournamentRepository;


class HomeController extends Controller
{
    protected $tournamentRepository;
    protected $utility;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(
        TournamentRepository $tournamentRepository,
        Utility $ultity
    ) {
        $this->tournamentRepository = $tournamentRepository;
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
}
