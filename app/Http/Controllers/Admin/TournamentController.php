<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\TournamentRequest;
use App\Repositories\TournamentRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $listTournaments = $this->tournamentRepository->index();
        return view('admin.tournament.index', compact('listTournaments'));
    }

    public function create()
    {
        $type_tours = config('tournament.type');
        $format_tours = config('tournament.format');
        if (Auth::user()->role == Role::ADMIN) {
            return view('admin.tournament.create', compact('type_tours', 'format_tours'));
        }

        return view('page.tournament.create', compact('type_tour', 'format_tour'));
    }

    public function store(TournamentRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);

        if (isset($input['image'])) {
            $img = $this->utility->saveImageTournament($input);
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
        $type_tours = config('tournament.type');
        $format_tours = config('tournament.format');
        $dataTournament = $this->tournamentRepository->show($id);
        return view('admin.tournament.edit', compact('dataTournament', 'format_tours', 'type_tours'));
    }


    public function update(TournamentRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageTournament($input);
            if ($img) {
                $path = '/images/tournament/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $dataTour = $this->tournamentRepository->updateTour($input, $id);
        return redirect('list-tournament');
    }
}
