<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ranking;
use App\Enums\Role;
use App\Http\Requests\LeagueRequest;
use App\Models\League;
use App\Repositories\LeagueRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use App\Repositories\UserLeagueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LeagueController extends Controller
{
    protected $leagueRepository;
    protected $userLeagueRepository;
    protected $utility;

    public function __construct(
        UserLeagueRepository $userLeagueRepository,
        LeagueRepository $leagueRepository,
        Utility $ultity
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->userLeagueRepository = $userLeagueRepository;
        $this->utility = $ultity;
    }
    public function index()
    {
        $user = Auth::user()->id;
        $listLeagues = $this->leagueRepository->index($user);
        return view('admin.league.index', compact('listLeagues'));
    }

    public function create()
    {
        $listType = Ranking::RANKING_ARRAY_TYPE;
        $listFormat = Ranking::RANKING_ARRAY_FORMAT;

            return view('admin.league.create', compact('listType', 'listFormat'));

    }

    public function store(LeagueRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->leagueRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-league')->with('success','League successfully created.');
        }
        return redirect()->to('list-league')->with('success','League successfully created.');
    }

    public function show($slug)
    {
        $userRegisterLeague = $this->leagueRepository->show($slug);
        return view('admin.league.user-register-league', compact('userRegisterLeague'));
    }

    public function edit($slug)
    {
        $listType = Ranking::RANKING_ARRAY_TYPE;
        $listFormat = Ranking::RANKING_ARRAY_FORMAT;
        $dataLeague = $this->leagueRepository->show($slug);
        return view('admin.league.edit', compact('dataLeague', 'listType', 'listFormat'));
    }


    public function update(LeagueRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->leagueRepository->updateLeague($input, $id);
        return redirect('list-league')->with('success','League successfully updated.');
    }

    public function updatePlayer(Request $request, $id)
    {
        $input = $request->except(['_token']);
        foreach($input['status'] as $key => $value)
        {
            $this->userLeagueRepository->updatePlayer(['status' => $value], $key);
        }
        return back()->with('success', __('Player has been sent successfully!'));
    }

    public function destroyPlayer($id)
    {
        $this->userLeagueRepository->destroy($id);
        return back()->with('success','League successfully deleted.');
    }

    public function leagues()
    {
        $user = Auth::user()->id;

        $listLeagues = $this->leagueRepository->index($user);
        return view('admin.league.active-league', compact('listLeagues'));
    }

    public function activeLeague(Request $request, $id)
    {

        $league = League::find($id);
        if($league->status) {
            $league->status = 0;
        }
        else{
            $league->status = 1;
        }
        $league->save();

        return back();
    }
}
