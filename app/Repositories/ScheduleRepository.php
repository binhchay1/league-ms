<?php

namespace App\Repositories;
use App\Models\Schedule;

class ScheduleRepository extends BaseRepository
{
    public function model()
    {
        return Schedule::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function index()
    {
        return $this->model->with('tournament', 'team1', 'team2')->orderBy('created_at', 'desc')->get();
    }

    public function showInfo($id)
    {
        return $this->model->with('tournament', 'team1.players', 'team2.players')->where('id', $id)->first();
    }

    public function update($input, $id)
    {
        return $this->model->with('tournament', 'team1', 'team2')->where('id', $id)->update($input);
    }

}
