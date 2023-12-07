<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\LeagueRequest;
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
        $listLeagues = $this->leagueRepository->index();
        return view('admin.league.index', compact('listLeagues'));
    }

    public function create()
    {
        $type_leagues = config('league.type');
        $format_leagues = config('league.format');
        if (Auth::user()->role == Role::ADMIN) {
            return view('admin.league.create', compact('type_leagues', 'format_leagues'));
        }

        return view('page.league.create', compact('type_league', 'format_league'));
    }

    public function store(LeagueRequest $request)
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
        $this->leagueRepository->store($input);
        if (Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-league');
        }
        return redirect()->to('list-leagues');
    }

    public function show($id)
    {
        $userRegisterLeague = $this->leagueRepository->show($id);
        return view('admin.league.user-register-league', compact('userRegisterLeague'));
    }

    public function edit($id)
    {
        $type_leagues = config('league.type');
        $format_leagues = config('league.format');
        $dataLeague = $this->leagueRepository->show($id);
        return view('admin.league.edit', compact('dataLeague', 'format_leagues', 'type_leagues'));
    }


    public function update(LeagueRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageLeague($input);
            if ($img) {
                $path = '/images/upload/league/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->leagueRepository->updateLeague($input, $id);
        return redirect('list-league');
    }

    public function updatePlayer(Request $request, $id)
    {

        $input = $request->except(['_token']);
        foreach($input['status'] as $key => $value)
        {
            $this->userLeagueRepository->updatePlayer(['status' => $value], $key);
        }
        return back()->with('success', __('Thông tin đã được gửi đi thành công!'));
    }

    public function destroyPlayer($id)
    {
        $this->userLeagueRepository->destroy($id);
        return back()->with('success', 'Delete User successfully!');
    }
}
