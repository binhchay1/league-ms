<?php

namespace App\Http\Controllers;

use App\Enums\Utility;
use App\Repositories\GroupRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\UserLeagueRepository;
use App\Repositories\UserRepository;
use App\Repositories\GroupUserRepository;
use App\Repositories\MessageRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RankingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Config;
use Session;

class HomeController extends Controller
{
    protected $userLeagueRepository;
    protected $leagueRepository;
    protected $userRepository;
    protected $groupRepository;
    protected $groupUserRepository;
    protected $messageRepository;
    protected $rankingRepository;
    protected $productRepository;
    protected $notificationRepository;
    protected $utility;

    public function __construct(
        UserLeagueRepository $userLeagueRepository,
        LeagueRepository $leagueRepository,
        UserRepository $userRepository,
        GroupRepository $groupRepository,
        GroupUserRepository $groupUserRepository,
        MessageRepository $messageRepository,
        RankingRepository $rankingRepository,
        ProductRepository $productRepository,
        NotificationRepository $notificationRepository,
        Utility $ultity
    ) {
        $this->userLeagueRepository = $userLeagueRepository;
        $this->leagueRepository = $leagueRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->groupUserRepository = $groupUserRepository;
        $this->messageRepository = $messageRepository;
        $this->rankingRepository = $rankingRepository;
        $this->productRepository = $productRepository;
        $this->notificationRepository = $notificationRepository;
        $this->utility = $ultity;
    }

    public function viewHome()
    {
        $totalGroup = $this->groupRepository->count();
        $totalLeague = $this->leagueRepository->count();
        $totalView = strtotime(date('Y-m-d H:i:s')) / 1242222;
        $listLeague = $this->leagueRepository->listLeagueHomePage();
        $listRank = $this->rankingRepository->listRankHomePage();

        return view('page.homepage', compact('totalGroup', 'totalLeague', 'totalView', 'listLeague', 'listRank'));
    }

    public function viewSearch(Request $request)
    {
        $search = $request->get('search');
        $isList = false;
        if ($search) {
            $listLeagueBySearch = $this->leagueRepository->getLeagueBySearch($search);
            if ($listLeagueBySearch->count() > 0) {
                $isList = true;
            }

            return view('page.search', compact('listLeagueBySearch', 'search', 'isList'));
        }

        return view('page.search', compact('search', 'isList'));
    }

    public function viewShop()
    {
        $products = $this->productRepository->get();
        return view('page.shop.index', compact('products'));
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

    public function viewRanking(Request $request)
    {
        $ranking = $this->rankingRepository->getTop();
        $listRankings = $this->utility->paginate($ranking, 20);
        $listRank = $this->rankingRepository->listRankHomePage();
        return view('page.ranking.index', compact('ranking', 'listRankings', 'listRank'));
    }

    public function viewInforPlayer($id)
    {
        $user_id = $this->utility->decode_hash_id($id);
        $users = $this->userRepository->getById($user_id);

        if (empty($users)) {
            abort(404);
        }

        $user = $this->userRepository->getInformationUser($user_id);
        $groups = $this->groupUserRepository->getGroupByUserId($user_id);
        $leagues = $this->userLeagueRepository->getLeagueByUserId($user_id);

        foreach ($groups as $group) {
            $totalMembers = $this->groupUserRepository->countMembers($group->id);
            $group->totalMembers = $totalMembers;
        }

        return view('page.user.player', compact('user', 'groups', 'leagues'));
    }

    public function listLeague()
    {
        $listLeague = $this->leagueRepository->index();
        $listLeagues = $this->utility->paginate($listLeague, 10);

        return view('page.league.index', compact('listLeague', 'listLeagues'));
    }

    public function listGroup()
    {
        $getGroup = $this->groupRepository->getGroupWithStatus();
        $listGroup = $this->utility->paginate($getGroup, 30);

        return view('page.group.index', compact('listGroup'));
    }

    public function showInfo($slug)
    {

        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->index();
        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule'));
    }

    public function changeLocate($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    public function detailGroup(Request $request)
    {
        $nameGroup = $request->get('g_i');
        if (empty($nameGroup)) {
            abort(404);
        }

        $getGroup = $this->groupRepository->getGroupByName($nameGroup);
        if (empty($getGroup)) {
            abort(404);
        }

        $isJoined = false;
        $members = $this->groupUserRepository->getMembersByGroupId($getGroup->id);

        if (Auth::check()) {
            $user = Auth::user();

            $checkJoined = $this->groupUserRepository->checkJoinedGroupByName($user->id, $getGroup->id);
            if (!empty($checkJoined)) {
                $isJoined = true;
            }
            $messages = $this->messageRepository->getMessagesByGroupId($getGroup->id);

            return view('page.group.detail', compact('getGroup', 'messages', 'members', 'isJoined'));
        }

        return view('page.group.detail', compact('getGroup', 'members', 'isJoined'));
    }

    public function showPlayer($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->index();

        return view('page.league.show', compact('leagueInfor', 'listLeagues'));
    }

    public function showResult($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->index();
        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule'));
    }

    public function showFightBranch($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->index();
        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        dd($leagueInfor);

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule'));
    }

    public function showSchedule($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->index();
        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule'));
    }

    public function saveRegisterLeague(Request $request)
    {
        $dateRegister = strtotime($request['end_date_register']);
        $dateCurrent = strtotime($request['start_date']);

        if ($dateRegister > $dateCurrent) {
            abort(404);
        }
        $userRegisterLeague = $request->except(['_token']);
        $this->userLeagueRepository->store($userRegisterLeague);

        return back()->with('message', 'You are allowed to access');
    }

    public function readNotification()
    {
        if (!Auth::check()) {
            abort(405);
        }

        $user_id = Auth::user()->id;
        $this->notificationRepository->updateReadNotification($user_id);
        $key = 'notification_next_match_' . $user_id;
        $getNotification = $this->notificationRepository->getNotificationByUser($user_id);
        Cache::set($key, $getNotification);
    }
}
