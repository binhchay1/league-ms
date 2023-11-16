<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\TournamentRequest;
use App\Repositories\TournamentRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    protected $tournamentRepository;
    protected $utility;

    public function __construct(
        TournamentRepository $tournamentRepository,
        Utility $ultity
    ) {
        $this->tournamentRepository = $tournamentRepository;
        $this->utility = $ultity;
    }
    public function index()
    {
        $listTournament = $this->tournamentRepository->index();
        return view('admin.tournament.index', compact('listTournament'));
    }

    public function create()
    {
        $type_tour = config('tournament.type');
        $format_tour = config('tournament.format');
        if (Auth::user()->role == Role::ADMIN) {
            return view('admin.tournament.create', compact('type_tour', 'format_tour'));
        }

        return view('page.tournament.create', compact('type_tour', 'format_tour'));
    }

    public function store(TournamentRequest $request)
    {
        $input = $request->except(['_token']);

        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/tournament/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->tournamentRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-tournament');
        }
        return redirect()->to('list-tournaments');
    }

    public function show($id)
    {
        $dataTournament = $this->tournamentRepository->show($id);
    }

    public function edit($id)
    {
        $type_tour = config('tournament.type');
        $format_tour = config('tournament.format');
        $dataTournament = $this->tournamentRepository->show($id);
        return view('admin.tournament.edit', compact('dataTournament', 'formatTour', 'type_tour',));
    }


    public function update(TournamentRequest $request, $id)
    {
        $input = $request->except(['_token']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/tournament/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $dataTour = $this->tournamentRepository->updateTour($input, $id);
        return redirect('list-tournament');
    }
}
