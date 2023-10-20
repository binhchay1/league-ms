<?php

namespace App\Repositories;

use App\Models\Tournament;

class TournamentRepository extends BaseRepository
{
    public function model()
    {
        return Tournament::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

}
