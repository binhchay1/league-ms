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

<<<<<<< HEAD
    public function updatePlayer($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
=======
    public function getLeagueByUserId($userId)
    {
        return $this->model->with('league')->where('user_id', $userId)->get();
>>>>>>> e4a074c07bb3e00eff31d789573e3490536a181b
    }
}
