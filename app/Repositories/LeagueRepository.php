<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository extends BaseRepository
{
    public function model()
    {
        return League::class;
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function show($id)
    {
        return $this->model->with('userLeagues', 'userLeagues.user')->where('id', $id)->first();
    }

    public function updateLeague($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
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
        return $this->model->where('name', 'like', '%' . $search . '%')->get();
    }

    public function getLeagueForPre($date)
    {
        return $this->model->with('userLeagues')->whereDate('date', '>=', $date)->get();
    }

    public function listLeagueHomePage()
    {
        return $this->model->orderBy('created_at', 'desc')->take(1)->get();
    }
}
