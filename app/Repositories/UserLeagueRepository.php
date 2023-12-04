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
}
