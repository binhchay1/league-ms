<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Utility;
use App\Models\User;
use App\Enums\Title;
use App\Enums\Group;
use App\Enums\Ranking;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupUserRepository;
use App\Events\MessageSent;
use App\Jobs\SendMail;
use App\Mail\VerifyEmail;
use App\Repositories\GroupRepository;
use App\Repositories\RankingRepository;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Hash;
use Session;

class  AuthController extends Controller
{
    protected $groupUserRepository;
    protected $groupRepository;
    protected $rankingRepository;
    protected $utility;

    public function __construct(
        GroupUserRepository $groupUserRepository,
        GroupRepository $groupRepository,
        RankingRepository $rankingRepository,
        Utility $ultity
    ) {
        $this->groupUserRepository = $groupUserRepository;
        $this->groupRepository = $groupRepository;
        $this->rankingRepository = $rankingRepository;
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
                'custom' => 'Email or Password is wrong!'
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
            'title' => Title::USER
        ]);

        $token = Str::random(60);
        $carbonNow = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $timeEnd = $carbonNow->addMinutes(60)->format('Y-m-d H:i:s');
        VerifyUser::create([
            'token' => $token,
            'user_id' => $user->id,
            'time_end' => $timeEnd
        ]);

        $listType = Ranking::RANKING_ARRAY_TYPE;
        foreach ($listType as $type) {
            $data = [
                'user_id' => $user->id,
                'points' => 0,
                'type' => $type,
                'places' => 0,
                'places_old' => 0
            ];

            $this->rankingRepository->create($data);
        }

        $url = route('user.verify', ['token' => $token]);
        $dataEmail = [
            'url' => $url,
            'user_name' => $user->name,
        ];

        $verifyEmail = new VerifyEmail($dataEmail);
        SendMail::dispatch($request['email'], $verifyEmail)->onQueue('send_email_verify');

        return \redirect()->route('verify.email');
    }

    public function verifyEmail($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        $currentDateTime = date('Y-m-d H:i:s');
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $dataUser = $verifyUser->user;

            if (!$dataUser->email_verified_at) {

                $dataUser->email_verified_at = $currentDateTime;
                $dataUser->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
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
        dd(Auth::user());
        return view('auth.verify-email');
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
        try {
            Redis::connect(env('REDIS_HOST', '127.0.0.1'), 3306);
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
        } catch (\Predis\Connection\ConnectionException $e) {
            return response('error connection redis');
        }
    }
}
