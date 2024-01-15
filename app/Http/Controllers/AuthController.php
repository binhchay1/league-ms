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
use App\Repositories\VerifyUserRepository;
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
    protected $verifyUserRepository;
    protected $utility;

    public function __construct(
        GroupUserRepository $groupUserRepository,
        GroupRepository $groupRepository,
        RankingRepository $rankingRepository,
        UserLeagueRepository $userLeagueRepository,
        VerifyUserRepository $verifyUserRepository,
        Utility $ultity
    ) {
        $this->groupUserRepository = $groupUserRepository;
        $this->groupRepository = $groupRepository;
        $this->rankingRepository = $rankingRepository;
        $this->userLeagueRepository = $userLeagueRepository;
        $this->verifyUserRepository = $verifyUserRepository;
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
            'email_verified_at' => date('Y-m-d H:i:s')
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

        // $urlVerify = route('user.verify', ['token' => $token]);
        // $urlVerify = '';
        // $urlHome = route('home');
        // $dataEmail = [
        //     'urlVerify' => $urlVerify,
        //     'urlHome' => $urlHome,
        //     'user_name' => $user->name,
        //     'logo' => asset('/images/logo-no-background.png'),
        //     'text-1' => __('Complete register for your account'),
        //     'text-2' => __('Confirm Your Email Address'),
        //     'text-3' => __('Thank you for your attention. Welcome to Badminton.io. Tap the button below to confirm your email address.'),
        //     'text-4' => __('Verify Your Email'),
        //     'text-5' => __("If that doesn't work, copy and paste the following link in your browser:"),
        //     'text-6' => __('Cheers,'),
        //     'text-7' => __("You received this email because we received a request for register for your account. If you didn't request register, you can safely delete this email."),
        // ];

        // $verifyEmail = new VerifyEmail($dataEmail);
        // SendMail::dispatch($request['email'], $verifyEmail)->onQueue('send_email_verify');
        // ChangeStatusTokenVerify::dispatch($this->verifyUserRepository, $token)->delay(now()->addMinutes(60))->onQueue('change_verify_token');

        Auth::loginUsingId($user->id);

        // return \redirect()->route('verify.email');
        if ($user->role == 'user') {
            return \redirect()->route('home');
        } else {
            return \redirect()->route('dashboard');
        }
    }

    // public function verifyEmail($token)
    // {
    //     if (empty($token)) {
    //         abort(404);
    //     }

    //     $verifyUser = $this->verifyUserRepository->getVerifyByToken($token);

    //     if (empty($verifyUser)) {
    //         abort(404);
    //     }

    //     if ($verifyUser->status == 0) {
    //         return redirect()->route('verify.email');
    //     }

    //     return redirect()->route('login')->with('message', $message);
    // }

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

    // public function resendVerify(Request $request)
    // {
    //     $token = $request->get('token_verify');
    //     if ($token == null) {
    //         abort(404);
    //     }
    //     $isTokenVerified = $this->verifyUserRepository->getVerifyByToken($token);

    //     if (empty($isTokenVerified)) {
    //         abort(404);
    //     }

    //     $new_token = $this->regenerateToken();
    //     $carbonNow = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    //     $timeEnd = $carbonNow->addMinutes(60)->format('Y-m-d H:i:s');
    //     $url = route('user.verify', ['token' => $token]);

    //     $dataUpdate = [
    //         'token' => $new_token,
    //         'time_end' => $timeEnd,
    //         'status' => 0
    //     ];
    //     $dataEmail = [
    //         'url' => $url,
    //         'user_name' => Auth::user()->name
    //     ];

    //     $this->verifyUserRepository->updateTokenByUserId(Auth::user()->id, $dataUpdate);
    //     ChangeStatusTokenVerify::dispatch($this->verifyUserRepository, $new_token)->delay(now()->addMinutes(60))->onQueue('change_verify_token');

    //     $verifyEmail = new VerifyEmail($dataEmail);
    //     SendMail::dispatch(Auth::user()->email, $verifyEmail)->onQueue('send_email_verify');

    //     return redirect()->route('verify.email');
    // }

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
