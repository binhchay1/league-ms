<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository extends BaseRepository
{
    public function model()
    {
        return League::class;
    }

    public function index($user)
    {
        if (\Auth::user()->role == 'admin') {
            return $this->model->with('schedule')->orderBy('created_at', 'desc')->get();
        }

        return $this->model->where('owner_id', $user)->with('schedule')->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function show($slug)
    {
        return $this->model->with('userLeagues', 'userLeagues.user')->where('slug', $slug)->first();
    }

    public function updateLeague($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($slug)
    {
        return $this->model->where('slug', $slug)->delete();
    }

    public function showInfo($slug)
    {
        return $this->model->with(
            'userLeagues',
            'schedule.player1Team1',
            'schedule.player2Team1',
            'schedule.player1Team2',
            'schedule.player2Team2'
        )->where('slug', $slug)->first();
    }

    public function getLeagueBySearch($search)
    {
        return $this->model->where('name', 'like', '%' . $search . '%')->paginate(5);
    }

    public function getLeagueForPre($date)
    {
        return $this->model->with('userLeagues')->whereDate('date', '>=', $date)->get();
    }

    public function listLeagueHomePage()
    {
        return $this->model->where('status', 1)->orderBy('created_at', 'desc')->take(1)->get();
    }

    public function getListLeagues()
    {
        return $this->model->where('status', 1)->orderBy('created_at', 'desc')->get();
    }


    public function getLeagueHome($getLeagueByState = null)
    {

        if ($getLeagueByState == 'all') {
            return $this->model->orderBy('created_at', 'desc')->get();
        } elseif ($getLeagueByState == 'next') {
            return $this->model->whereDate('start_date', '>',  date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        } elseif ($getLeagueByState == 'completed') {
            return $this->model->whereDate('end_date', '<',  date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        }

        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function getLeagueBySlug($slug)
    {
        return $this->model->with('userLeagues')->where('slug', $slug)->first();
    }

    public function getLeagueMath()
    {
        $currentDate = date('Y-m-d ');
        return $this->model->where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->orderBy('created_at', 'desc')->get();
    }

    public function getLiveLeague($slug)
    {
        return $this->model->with(
            'userLeagues',
            'schedule.player1Team1',
            'schedule.player2Team1',
            'schedule.player1Team2',
            'schedule.player2Team2'
        )->where('slug', $slug)->first();
    }

    public function getLeagueById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}
