<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\LeagueRequest;
use App\Repositories\LeagueRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LeagueController extends Controller
{
    protected $leagueRepository;
    protected $utility;

    public function __construct(
        LeagueRepository $leagueRepository,
        Utility $ultity
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->utility = $ultity;
    }
    public function index()
    {
        $listLeagues = $this->leagueRepository->index();
        return view('admin.league.index', compact('listLeagues'));
    }

    public function create()
    {
        $type_tours = config('league.type');
        $format_tours = config('league.format');
        if (Auth::user()->role == Role::ADMIN) {
            return view('admin.league.create', compact('type_tours', 'format_tours'));
        }

        return view('page.league.create', compact('type_tour', 'format_tour'));
    }

    public function store(LeagueRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);

        if (isset($input['image'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->leagueRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-league');
        }
        return redirect()->to('list-leagues');
    }

    public function show($id)
    {
        $this->leagueRepository->show($id);
    }

    public function edit($id)
    {
        $type_tours = config('league.type');
        $format_tours = config('league.format');
        $dataLeague = $this->leagueRepository->show($id);
        return view('admin.league.edit', compact('dataLeague', 'format_tours', 'type_tours'));
    }


    public function update(LeagueRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->leagueRepository->updateLeague($input, $id);
        return redirect('list-league');
    }
}
