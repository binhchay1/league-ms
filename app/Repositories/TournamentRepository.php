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
        return $this->model->orderBy('created_at', 'desc')->paginate(env('PAGINATION_PER_PAGE', 10));
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateTour($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

}
