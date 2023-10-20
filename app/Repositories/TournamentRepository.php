<?php

namespace App\Repositories;

use App\Models\Tournament;

class TournamentRepository extends BaseRepository
{
    public function model()
    {
        return Tournament::class;
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

}
