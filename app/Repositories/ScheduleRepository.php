<?php

namespace App\Repositories;

use App\Models\Schedule;

class ScheduleRepository extends BaseRepository
{
    public function model()
    {
        return Schedule::class;
    }

    public function store($dataSchedule)
    {
        return $this->model->create($dataSchedule);
    }

    public function index()
    {
        return $this->model->with('league')->orderBy('created_at', 'desc')->get();
    }

    public function showInfo($id)
    {
        return $this->model->with('league', 'player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('id', $id)->first();
    }

    public function updateLeague($input, $id)
    {
        return $this->model->with('league', 'player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('id', $id)->update($input);
    }


    public function updateResult($input, $id)
    {
        return $this->model->with('league', 'player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('id', $id)->update($input);
    }

    public function getScheduleByDate($date)
    {
        return $this->model->with('player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->whereDate('date', $date)->get();
    }

    public function getScheduleByLeagueAndMatch($league_id, $match)
    {
        return $this->model->with('player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('league_id', $league_id)->where('match', $match)->first();
    }

    public function getScheduleByLeagueOrderByMatch($league_id)
    {
        return $this->model->with('player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('league_id', $league_id)->get();
    }

    public function getScheduleById($id)
    {
        return $this->model->with('player1Team1', 'player2Team1', 'player1Team2', 'player2Team2')->where('id', $id)->first();
    }
}
