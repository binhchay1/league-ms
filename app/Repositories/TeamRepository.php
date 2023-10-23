<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository extends BaseRepository
{
    public function model()
    {
        return Team::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

}
