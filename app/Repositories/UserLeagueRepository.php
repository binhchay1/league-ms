<?php

namespace App\Repositories;

use App\Models\UserLeague;

class UserLeagueRepository extends BaseRepository
{
    public function model()
    {
        return UserLeague::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function getLeagueByUserId($userId)
    {
        return $this->model->with('league')->where('user_id', $userId)->get();
    }
}
