<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository extends BaseRepository
{
    public function model()
    {
        return League::class;
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

    public function updateLeague($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function showInfo($slug)
    {
        return $this->model->with('schedule')->where('slug', $slug)->first();
    }
}
