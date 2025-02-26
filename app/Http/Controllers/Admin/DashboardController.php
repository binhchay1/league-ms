<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use App\Repositories\LeagueRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $userRepository;
    protected $leagueRepository;
    protected $postRepository;

    public function __construct(
        UserRepository $userRepository,
        PostRepository $postRepository,
        LeagueRepository $leagueRepository
    ) {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->leagueRepository = $leagueRepository;
    }

    public function dashboard()
    {
        if (Auth::check()) {

            $lisUser = $this->userRepository->index();
            $countQueryUser = clone $lisUser;
            $countUser = $countQueryUser->count();

            $lisLeague = $this->leagueRepository->countLeague();
            $countQueryLeague = clone $lisLeague;
            $countLeague = $countQueryLeague->count();

            $lisPost = $this->postRepository->index();
            $countQueryPost = clone $lisPost;
            $countPost = $countQueryPost->count();
//
//            $lisUser = $this->userRepository->index();
//            $countQuery = clone $lisUser;
//            $countUser = $countQuery->count();


            return view('layouts.dashboard', compact('countUser', 'countLeague', 'countPost'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
