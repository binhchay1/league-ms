<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Ranking;
use App\Enums\Role;
use App\Http\Requests\LeagueRequest;
use App\Http\Requests\LeagueUpdateRequest;
use App\Models\League;
use App\Models\UserLeague;
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
        $listPlayer = \App\Enums\League::NUMBER_PLAYER;

        return view('admin.league.create', compact('listType', 'listFormat', 'listPlayer'));
    }

    public function store(LeagueRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        $input['owner_id'] = Auth::user()->id;
        $input['status'] = 1;
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->leagueRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-league')->with('success', 'League successfully created.');
        }
        return redirect()->to('list-league')->with('success', 'League successfully created.');
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
        $listPlayer = \App\Enums\League::NUMBER_PLAYER;
        $dataLeague = $this->leagueRepository->show($slug);
        return view('admin.league.edit', compact('dataLeague', 'listType', 'listFormat', 'listPlayer'));
    }


    public function update(LeagueUpdateRequest $request, $id)
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
        return redirect('list-league')->with('success', 'League successfully updated.');
    }

    public function destroy($slug)
    {
        $this->leagueRepository->destroy($slug);

        return back()->with('success', __('Delete League successfully!'));
    }

    public function updatePlayer(Request $request)
    {
        $input = $request->except(['_token']);
        // Retrieve the user IDs and the new status from the request
        $userIds = $request->input('user_ids');
        $activeStatus = $request->input('status');
        // Update the 'active' status for all specified users
        if(empty($userIds))
        {
            return back()->with('success', __('No players to action!'));
        }

        UserLeague::whereIn('id', $userIds)->update(['status' => $activeStatus]);

        return back()->with('success', __('Player has been update status successfully!'));
    }

    public function destroyPlayer($id)
    {
        $this->userLeagueRepository->destroy($id);
        return back()->with('success', 'Player successfully deleted.');
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
        if ($league->status) {
            $league->status = 0;
        } else {
            $league->status = 1;
        }
        $league->save();

        return back();
    }

    public function leagueById($id)
    {
        $leagueById = $this->leagueRepository->leagueId($id);
    }

    public function createLeague()
    {
        $listType = Ranking::RANKING_ARRAY_TYPE;
        $listFormat = Ranking::RANKING_ARRAY_FORMAT;
        $listPlayer = \App\Enums\League::NUMBER_PLAYER;
        $listTypeLeague = \App\Enums\League::TYPE;

        return view('page.league.create', compact('listType', 'listFormat', 'listPlayer','listTypeLeague'));
    }

    public function storeLeagueTour(LeagueRequest $request)
    {

        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        $input['owner_id'] = Auth::user()->id;
        $input['status'] = 1;
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->leagueRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->route('my.league')->with('success', 'League successfully created.');
        }
        return redirect()->route('my.league')->with('success', 'League successfully created.');
    }

}
