<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Repositories\TeamRepository;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    protected $teamRepository;
    protected $utility;

    public function __construct(
        TeamRepository $teamRepository,
        Utility $utility

    ) {
        $this->teamRepository = $teamRepository;
        $this->utility = $utility;
    }


    public function index()
    {
        $listTeam = $this->teamRepository->index();
        return view('admin.team.index', compact('listTeam'));
    }


    public function create()
    {
        if (Auth::user()->role == Role::ADMIN) {
            return view('admin.team.create');
        }
        return view('page.team.create');
    }


    public function store(TeamRequest $request)
    {
        $input = $request->except(['_token']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageTeam($input);
            if ($img) {
                $path = '/images/upload/team/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->teamRepository->store($input);

        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-team');
        }
        return redirect()->to('list-teams');
    }


    public function show($id)
    {
        $dataTeam = $this->teamRepository->showTeamInfo($id);
        return view('admin.team.show', compact('dataTeam'));
    }


    public function edit($id)
    {
        $dataTeam = $this->teamRepository->showTeamInfo($id);
        return view('admin.team.show', compact('dataTeam'));
    }


    public function update(TeamRequest $request, $id)
    {
        $input = $request->except(['_token']);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageTeam($input);
            if ($img) {
                $path = '/images/upload/team/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $dataTeam = $this->teamRepository->updateTeam($input, $id);
        return redirect('list-team');
    }
}
