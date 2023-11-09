<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use Illuminate\Http\Request;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listTeam = $this->teamRepository->index();
        return view('admin.team.index',['listTeam' => $listTeam]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == Role::ADMIN)
        {
            return view('admin.team.create');
        }
        return view('page.team.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $input = $request->except(['_token']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/logo/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->teamRepository->store($input);

        if(Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-team');
        }
        return redirect()->to('list-teams');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataTeam = $this->teamRepository->showTeamInfo($id);
        return view('admin.team.show',['dataTeam'=> $dataTeam]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataTeam = $this->teamRepository->showTeamInfo($id);
        return view('admin.team.show',['dataTeam'=> $dataTeam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        $input = $request->except(['_token']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/logo/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $dataTeam = $this->teamRepository->updateTeam($input, $id);
        return redirect('list-team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postFile($input)
    {
        if ($input['image']) {
            $file = $input['image'];

            $typeFile = $file->getClientOriginalExtension();
            if ($typeFile == 'png' || $typeFile == 'jpg' || $typeFile == 'jpeg' ) {
                $fileSize = $file->getSize();
                if ($fileSize <= 1024000) {
                    $fileName = $file->getClientOriginalName();
                    $file->move('img', $fileName);
                    return $fileName;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
}
