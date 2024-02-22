<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Utility;
use App\Models\User;
use App\Enums\Title;
use App\Enums\Group;
use App\Jobs\SendMail;
use App\Events\MessageSent;
use App\Mail\VerifyEmail;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\ChangeStatusTokenVerify;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupUserRepository;
use App\Repositories\GroupRepository;
use App\Repositories\RankingRepository;
use App\Repositories\UserLeagueRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Session;

class  AuthController extends Controller
{
    protected $groupUserRepository;
    protected $groupRepository;
    protected $rankingRepository;
    protected $userLeagueRepository;
    protected $utility;

    public function __construct(
        GroupUserRepository $groupUserRepository,
        GroupRepository $groupRepository,
        RankingRepository $rankingRepository,
        UserLeagueRepository $userLeagueRepository,
        Utility $ultity
    ) {
        $this->groupUserRepository = $groupUserRepository;
        $this->groupRepository = $groupRepository;
        $this->rankingRepository = $rankingRepository;
        $this->userLeagueRepository = $userLeagueRepository;
        $this->utility = $ultity;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function customLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('email', $credentials['email']);
            if (Auth::user()->role == Role::ADMIN) {
                return redirect('dashboard');
            } else {
                if ($request->get('return_url')) {
                    $return_url = $request->get('return_url');
                    return redirect($return_url);
                }

                return redirect('/');
            }
        } else {
            return back()->withErrors([
                'custom' => __('Email or Password is wrong!')
            ]);
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('layouts.admin');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function registerUser()
    {
        return view('auth.registerUser');
    }

    public function storeUser(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => Role::USER,
            'title' => Title::USER,
        ]);

        $token = $this->regenerateToken();
        $carbonNow = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $timeEnd = $carbonNow->addMinutes(60)->format('Y-m-d H:i:s');
        $dataVerify = [
            'token' => $token,
            'user_id' => $user->id,
            'time_end' => $timeEnd,
            'status' => 0
        ];
        $this->verifyUserRepository->create($dataVerify);

        $dataRanking = [
            'user_id' => $user->id,
            'points' => 0,
            'places' => 0,
            'places_old' => 0
        ];
        $this->rankingRepository->create($dataRanking);

        Auth::loginUsingId($user->id);
        if ($user->role == 'user') {
            return \redirect()->route('home');
        } else {
            return \redirect()->route('dashboard');
        }
    }

    public function profile()
    {
        return view('page.user.profile');
    }

    public function viewMyGroup()
    {
        $getGroup = $this->groupUserRepository->getGroupByUserId(Auth::user()->id);
        $listGroup = $this->utility->paginate($getGroup, 30, '/my-group');

        return view('page.user.my-group', compact('listGroup'));
    }

    public function viewVerifyEmail()
    {
        $verify = $this->verifyUserRepository->getVerifyByUserId(Auth::user()->id);
        $timer = 0;
        if ($verify->status == 1) {
            $expired = 1;
            $message = __('Your email verification is expired! Please click button to resend your email');
        } else {
            $expired = 0;
            $message = __('Your email verification is sent! Please check your email');
            $timer = strtotime($verify->time_end) - strtotime(date('Y-m-d H:i:s'));
        }

        return view('auth.verify-email', compact('verify', 'message', 'expired', 'timer'));
    }

    public function viewVerifiedEmail()
    {
        return view('auth.verify-email-success');
    }

    public function joinGroup(Request $request)
    {
        $nameGroup = $request->get('g_i');
        if (empty($nameGroup)) {
            return 'fail';
        }

        $getGroup = $this->groupRepository->getGroupByName($nameGroup);
        if (empty($getGroup)) {
            return 'fail';
        }

        $user = Auth::user();
        if ($getGroup->status == Group::STATUS_PRIVATE) {
            $group_users = $this->groupUserRepository->checkJoinedGroupByName($user->id, $getGroup->id);
            if (empty($group_users)) {
                $data = [
                    'group_id' => $getGroup->id,
                    'user_id' => $user->id,
                    'status_request' => Group::STATUS_REQUESTED
                ];
                $this->groupUserRepository->create($data);

                return 'wait';
            } else {
                if ($group_users->status_request == Group::STATUS_REJECTED) {
                    return 'reject';
                }
            }
        } else {
            $data = [
                'group_id' => $getGroup->id,
                'user_id' => $user->id,
                'status_request' => Group::STATUS_ACCEPTED
            ];
            $this->groupUserRepository->create($data);
        }

        return 'success';
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $request->get('message');
        $group_id = $request->get('g_i');

        if ($message == null or $group_id == null) {
            abort(403);
        }

        $isJoined = $this->groupUserRepository->checkJoinedGroupByName($user->id, $group_id);
        if (empty($isJoined)) {
            abort(403);
        }

        $message = $user->messages()->create([
            'message' => $message,
            'group_id' => $group_id
        ]);

        broadcast(new MessageSent($user, $message, $group_id))->toOthers();

        return ['status' => 'sent'];
    }

    public function regenerateToken($old_token = null)
    {
        $token = Str::random(60);
        if ($old_token != null) {
            if ($token == $old_token) {
                $this->regenerateToken($old_token);
            }
        }
        $checkToken = $this->verifyUserRepository->getVerifyByToken($token);
        if (!empty($checkToken)) {
            $this->regenerateToken();
        } else {
            return $token;
        }
    }
}
