<?php

namespace App\Repositories;
use App\Models\Sport;

class SportRepository extends BaseRepository
{
    public function model()
    {
        return Sport::class;
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function showData($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateData($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

}
