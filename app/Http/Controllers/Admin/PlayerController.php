<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;

class PlayerController extends Controller
{
    protected $playerRepository;
    protected $teamRepository;
    protected $utility;

    public function __construct(
        PlayerRepository $playerRepository,
        TeamRepository $teamRepository,
        Utility $utility

    ) {
        $this->playerRepository = $playerRepository;
        $this->teamRepository = $teamRepository;
        $this->utility = $utility;
    }

    public function create()
    {
        $listTeam = $this->teamRepository->index();
        $gender = config('player.gender');
        return view('admin.player.create',[
            'gender'=> $gender,
            'listTeam'=> $listTeam
        ]);
    }

    public function store(PlayerRequest $request)
    {
        $input = $request->except(['_token']);

        if (isset($input['image'])) {
            $img = $this->utility->saveImagePlayer($input);
            if ($img) {
                $path = '/images/player/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }
        $this->playerRepository->store($input);

        return redirect()->back()->with('success', 'Create player successfully!');
    }
}
