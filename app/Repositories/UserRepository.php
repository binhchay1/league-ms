<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function showInfo($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($input, $id) {
        return $this->model->where('id', $id)->update($input);
    }
}
