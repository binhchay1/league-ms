<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\GroupRepository;
use App\Repositories\TeamRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\MatchesRepository;
use App\Repositories\UserRepository;
use Config;
use Session;

class HomeController extends Controller
{
    protected $leagueRepository;
    protected $teamRepository;
    protected $userRepository;
    protected $matchesRepository;
    protected $groupRepository;
    protected $utility;

    public function __construct(
        LeagueRepository $leagueRepository,
        TeamRepository $teamRepository,
        UserRepository $userRepository,
        MatchesRepository $matchesRepository,
        GroupRepository $groupRepository,
        Utility $ultity
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->matchesRepository = $matchesRepository;
        $this->groupRepository = $groupRepository;
        $this->utility = $ultity;
    }

    public function viewHome()
    {
        $totalMatch = $this->matchesRepository->count();
        $totalTeam = $this->teamRepository->count();
        $totalLeague = $this->leagueRepository->count();
        $totalView = strtotime(date('Y-m-d H:i:s')) / 1242222;

        return view('page.homepage', compact('totalMatch', 'totalTeam', 'totalLeague', 'totalView'));
    }

    public function viewSearch()
    {
        return view('page.search');
    }

    public function viewMarket()
    {
        return view('page.shop');
    }

    public function viewAbout()
    {
        return view('page.about');
    }

    public function viewPricing()
    {
        return view('page.pricing');
    }

    public function viewPrivacy()
    {
        return view('page.privacy');
    }

    public function viewTermAndConditions()
    {
        return view('page.term');
    }

    public function viewTeamRegister()
    {
        return view('page.team-register');
    }

    public function listLeague()
    {
        $listLeague = $this->leagueRepository->index();

        return view('page.league.index', compact('listLeague'));
    }

    public function listTeam()
    {
        $listTeam = $this->teamRepository->index();

        return view('page.team.index', compact('listTeam'));
    }

    public function listGroup()
    {
        $listGroup = $this->groupRepository->getGroupWithStatus();
        $listGroup = $this->utility->paginate($listGroup, 30);

        return view('page.group.index', compact('listGroup'));
    }

    public function showInfo($slug)
    {
        $tourInfo = $this->leagueRepository->showInfo($slug);
        $listLeague = $this->leagueRepository->index();
        $groupSchedule = [];

        foreach ($tourInfo->schedule as $schedule) {
            $groupSchedule[$schedule['match']][] = $schedule;
        }

        return view('page.league.show', compact('groupSchedule', 'tourInfo', 'listLeague'));
    }

    public function changeLocate($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
