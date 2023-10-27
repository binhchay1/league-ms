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

}
