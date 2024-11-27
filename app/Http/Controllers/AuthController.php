<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Utility;
use App\Models\User;
use App\Enums\Title;
use App\Enums\Group;
use App\Events\MessageSent;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserLeagueRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use Session;

class  AuthController extends Controller
{
    protected $rankingRepository;
    protected $userLeagueRepository;
    protected $utility;

    public function __construct(

        UserLeagueRepository $userLeagueRepository,
        Utility $ultity
    ) {
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

    public function logout()
    {
        Session::flush();

        Auth::guard('web')->logout();
        return redirect('login');
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

        $carbonNow = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $timeEnd = $carbonNow->addMinutes(60)->format('Y-m-d H:i:s');


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




}
