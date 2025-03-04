<?php

namespace App\Http\Controllers;

use App\Enums\Group;
use App\Enums\Utility;
use App\Repositories\CategoryPostRepository;
use App\Repositories\GroupRepository;
use App\Repositories\GroupTrainingRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserLeagueRepository;
use App\Repositories\UserRepository;
use App\Repositories\GroupUserRepository;
use App\Repositories\MessageRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RankingRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\RefereeRepository;
use App\Repositories\ResultRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Config;
use Illuminate\Support\Facades\DB;
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
    protected $scheduleRepository;
    protected $utility;
    protected $groupTraining;
    protected $refereeRepository;
    protected $resultRepository;
    protected $postRepository;
    protected $categoryPostRepository;

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
        ScheduleRepository $scheduleRepository,
        Utility $ultity,
        GroupTrainingRepository $groupTraining,
        RefereeRepository $refereeRepository,
        ResultRepository $resultRepository,
        PostRepository $postRepository,
        CategoryPostRepository $categoryPostRepository
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
        $this->scheduleRepository = $scheduleRepository;
        $this->utility = $ultity;
        $this->groupTraining = $groupTraining;
        $this->refereeRepository = $refereeRepository;
        $this->resultRepository = $resultRepository;
        $this->postRepository = $postRepository;
        $this->categoryPostRepository = $categoryPostRepository;
    }

    public function viewHome()
    {
        $totalGroup = $this->groupRepository->count();
        $totalLeague = $this->leagueRepository->count();
        $totalView = strtotime(date('Y-m-d H:i:s')) / 1242222;
        $listLeague = $this->leagueRepository->listLeagueHomePage();
        $listRank = $this->rankingRepository->listRankHomePage();
        $listPosts = $this->postRepository->listPostLimit();


        return view('page.homepage', compact('totalGroup', 'totalLeague', 'totalView', 'listLeague', 'listRank', 'listPosts'));
    }

    public function viewSearch(Request $request)
    {
        $search = $request->get('search');
        $isList = false;
        $listLeagues = [];
        if ($search) {
            $listLeagues = $this->leagueRepository->getLeagueBySearch($search);
            if (count($listLeagues) > 0) {
                $isList = true;
            }
        }

        return view('page.search', compact('listLeagues', 'search', 'isList'));
    }

    public function viewShop()
    {
        $products = $this->productRepository->get();
        return view('page.shop.index', compact('products'));
    }

    public function viewAbout()
    {
        $listPosts = $this->postRepository->listPostLimit();
        return view('page.about', compact('listPosts'));
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
        $listRankings = $this->utility->paginate($ranking, 15);
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

    public function listLeague(Request $request)
    {
        $getLeagueByState = $request->get('state');
        $getLeague = $this->leagueRepository->getLeagueHome($getLeagueByState);
        $listLeagues = $this->utility->paginate($getLeague, 5);

        return view('page.league.index', compact('listLeagues'));
    }

    public function listGroup()
    {
        $getGroup = $this->groupRepository->getGroupWithStatus();
        $listGroup = $this->utility->paginate($getGroup, 5);

        return view('page.group.index', compact('listGroup'));
    }

    public function showInfo($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $getListLeagues = $this->leagueRepository->getListLeagues();
        $dataLeague = $this->leagueRepository->show($slug);

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }
        return view('page.league.show', compact('leagueInfor', 'getListLeagues', 'groupSchedule','dataLeague'));
    }

    public function changeLocate($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    public function checkGroupJoin(Request $request)
    {
        $nameGroup = $request->input('group');
        if (empty($nameGroup)) {
            abort(404);
        }

        $getGroup = $this->groupRepository->getGroupByName($nameGroup);

        if (empty($getGroup)) {
            abort(404);
        }

        $userId = Auth::id(); // Lấy user đang đăng nhập

        $isJoined = DB::table('group_users')
            ->where('group_id', $getGroup->id)
            ->where('user_id', $userId)
            ->where('status_request', Group::STATUS_ACCEPTED)
            ->exists(); // Kiểm tra user có trong nhóm không
        return response()->json(['joined' => $isJoined]);
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
        $listId = [];
        foreach ($members as $member) {
            $listId[] = $member->user_id;
        }

        $listRankings = $this->rankingRepository->getRankingListUsers($listId);

        if (Auth::check()) {
            $user = Auth::user();

            $checkJoined = $this->groupUserRepository->checkJoinedGroup($user->id, $getGroup->id);
            if (!empty($checkJoined)) {
                $isJoined = true;
            }
            $messages = $this->messageRepository->getMessagesByGroupId($getGroup->id);

            return view('page.group.detail', compact('getGroup', 'messages', 'members', 'isJoined', 'listRankings'));
        }

        return view('page.group.detail', compact('getGroup', 'members', 'isJoined', 'listRankings'));
    }

    public function showPlayer($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->getLeagueHome();
        $getListLeagues = $this->leagueRepository->getListLeagues();

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'getListLeagues'));
    }

    public function showResult($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->getLeagueHome();
        $getListLeagues = $this->leagueRepository->getListLeagues();

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule', 'getListLeagues'));
    }

    public function showBracket($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->getLeagueHome();
        $listSchedules = $this->scheduleRepository->getScheduleByLeagueOrderByMatch($leagueInfor->id);
        $totalMembers = $this->userLeagueRepository->countTotalMembersInLeague($leagueInfor->id);
        $getListLeagues = $this->leagueRepository->getListLeagues();
        $groupRound = $listSchedules->groupBy('round');

        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule', 'listSchedules', 'groupRound', 'getListLeagues'));
    }

    public function showSchedule($slug)
    {
        $leagueInfor = $this->leagueRepository->showInfo($slug);
        $listLeagues = $this->leagueRepository->getLeagueHome();
        $getListLeagues = $this->leagueRepository->getListLeagues();
        $groupSchedule = [];
        foreach ($leagueInfor->schedule as $schedule) {
            $groupSchedule[$schedule['round']][] = $schedule;
        }

        return view('page.league.show', compact('leagueInfor', 'listLeagues', 'groupSchedule', 'getListLeagues'));
    }

    public function saveRegisterLeague(Request $request)
    {
        $startDate = strtotime($request['start_date']);
        $dateCurrent =  strtotime(date("Y-m-d"));

        if ($dateCurrent >= $startDate) {
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

    public function groupTraining(Request $request)
    {
        $nameGroup = $request->get('g_i');
        if (empty($nameGroup)) {
            abort(404);
        }

        $listTrainings = $this->groupRepository->getGroupByName($nameGroup);

        if (empty($listTrainings)) {
            abort(404);
        }

        foreach ($listTrainings->group_trainings as $trainings) {
            $listId = json_decode($trainings->members);
            $trainings->isJoin = false;
            $trainings->totalMembers = 0;
            if (!empty($listId)) {
                if (in_array(Auth::user()->id, $listId)) {
                    $trainings->isJoin = true;
                }
                $trainings->totalMembers = count($listId);
            }
        }

        return view('page.group.group-training', compact('listTrainings'));
    }

    public function detailGroupTraining(Request $request)
    {
        $nameGroupTraining = $request->get('g_t');
        if (empty($nameGroupTraining)) {
            abort(404);
        }

        $groupTrainingDetail = $this->groupTraining->getGroupTrainByName($nameGroupTraining);
        if (empty($groupTrainingDetail)) {
            abort(404);
        }

        $listId = json_decode($groupTrainingDetail->members);
        if (!empty($listId)) {
            $listMembers = $this->userRepository->getListMembers($listId);
        } else {
            $listMembers = [];
        }

        return view('page.group.detail-group-train', compact('groupTrainingDetail', 'listMembers'));
    }

    public function joinGroupTraining(Request $request)
    {
        $idTraining = $request->get('g_t');
        if (empty($idTraining)) {
            abort(404);
        }

        $getMembers = $this->groupTraining->getMembersById($idTraining);

        if (empty($getMembers->members)) {
            $dataMembers = [
                'members' => json_encode([Auth::user()->id])
            ];

            $this->groupTraining->updateMembers($idTraining, $dataMembers);
        } else {
            $members = json_decode($getMembers->members, true);
            if (!in_array(Auth::user()->id, $members)) {
                $members[] = Auth::user()->id;
            }

            $dataMembers = [
                'members' => json_encode($members)
            ];

            $this->groupTraining->updateMembers($idTraining, $dataMembers);
        }

        return redirect('training?g_t=' . $getMembers->name);
    }

    public function viewMatch()
    {
        $getLeaguesMatch = $this->leagueRepository->getLeagueMath();
        $listMatches = $this->utility->paginate($getLeaguesMatch, 5);

        return view('page.match-center.index', compact('listMatches'));
    }

    public function live($slug)
    {
        $league = $this->leagueRepository->getLiveLeague($slug);
        $hours = date('H:i');
        $date = date('Y-m-d');
        $listSchedules = [];
        foreach ($league->schedule as $schedule) {
            if (strtotime($schedule->date) == strtotime($date)) {
                $listSchedules[] = $schedule;
            }
        }

        $listSchedules = collect($listSchedules)->sortBy('match');
        return view('page.match-center.show-live', compact('league', 'listSchedules'));
    }

    public function liveScore(Request $request)
    {
        $scheduleId = $request->get('s_i');
        if (empty($scheduleId)) {
            abort(404);
        }

        $decode = $this->utility->decode_hash_id($scheduleId);
        $getSchedule = $this->scheduleRepository->getScheduleById($decode);

        if (empty($getSchedule)) {
            abort(404);
        }

        $getReferee = $this->refereeRepository->getRefereeByUserId($getSchedule->id, Auth::user()->id);
        if (empty($getReferee)) {
            $listTitle = explode(',', Auth::user()->title);
            if (in_array('referee', $listTitle)) {
                $dataReferee = [
                    'user_id' => Auth::user()->id,
                    'schedule_id' => $getSchedule->id,
                ];
                $this->refereeRepository->create($dataReferee);
            } else {
                abort(403);
            }
        }

        if ($getSchedule->result_team_1 == 2 or $getSchedule->result_team_2 == 2) {
            $typeLive = 'end';
        } else {
            $typeLive = 'live';
        }

        $result = $getSchedule->result_team_1 . '-' . $getSchedule->result_team_2;

        switch ($result) {
            case '1-0':
                $setLive = 2;
                $scoreT1Live = $getSchedule->set_2_team_1;
                $scoreT2Live = $getSchedule->set_3_team_2;
                break;
            case '0-1':
                $setLive = 2;
                $scoreT1Live = $getSchedule->set_2_team_1;
                $scoreT2Live = $getSchedule->set_2_team_2;
                break;
            case '1-1':
                $setLive = 3;
                $scoreT1Live = $getSchedule->set_3_team_1;
                $scoreT2Live = $getSchedule->set_3_team_2;
                break;
            default:
                $setLive = 1;
                $scoreT1Live = $getSchedule->set_1_team_1;
                $scoreT2Live = $getSchedule->set_1_team_2;
        }

        if (!empty($getSchedule->player2_team_1) and !empty($getSchedule->player2_team_2)) {

            $getResult = $this->resultRepository->getResultByScheduleId($getSchedule->id);
            $arrScore = [
                'player_1' => 0,
                'player_2' => 0,
                'player_3' => 0,
                'player_4' => 0
            ];

            if ($getResult) {
                $strPerResult = 'result_round_' . $setLive;
                $getPerResult = json_decode($getResult->$strPerResult, true);

                foreach ($getPerResult as $player => $scorePerPlayer) {
                    $resultPerPlayer = json_decode($scorePerPlayer, true);
                    $arrScore[$player] = count($resultPerPlayer);
                }
            }

            return view('admin.live-score.live-score-double', compact('getSchedule', 'typeLive', 'setLive', 'scoreT1Live', 'scoreT2Live', 'arrScore'));
        } else {
            return view('admin.live-score.live-score', compact('getSchedule', 'typeLive', 'setLive', 'scoreT1Live', 'scoreT2Live'));
        }
    }

    public function news()
    {
        $listNews = $this->postRepository->index();
        $firstNews = $this->postRepository->firstNew();
        $categories = $this->categoryPostRepository->index();
        $listNewsPopulars = $this->postRepository->getNewsPopular();
        return view('page.post.list', compact('listNews', 'listNewsPopulars', 'categories','firstNews'));
    }

    public function newsDetail($slug)
    {
        $newData = $this->postRepository->detailPost($slug);
        $listNewsPopulars = $this->postRepository->getNewsPopular();
        $listNewsNormals = $this->postRepository->getNewsNormal();
        return view('page.post.detail', compact('newData', 'listNewsNormals','listNewsPopulars'));
    }

    public function newsCategory($slug)
    {
        $postCategory = $this->categoryPostRepository->postCategory($slug);
        $categories = $this->categoryPostRepository->index();
        $listNewsPopulars = $this->postRepository->getNewsPopular();
        $listNewsNormals = $this->postRepository->getNewsNormal();
        return view('page.post.category-post', compact('postCategory', 'categories', 'listNewsPopulars', 'listNewsNormals'));

    }


}
