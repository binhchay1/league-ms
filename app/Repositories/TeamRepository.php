<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository extends BaseRepository
{
    public function model()
    {
        return Team::class;
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function showTeamInfo($id)
    {
        return $this->model->with('players')->where('id', $id)->first();
    }

    public function updateTeam($input, $id)
    {
        return $this->model->with('players')->where('id', $id)->update($input);
    }

}
