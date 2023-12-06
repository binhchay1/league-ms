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
<<<<<<< HEAD
=======
>>>>>>> cd44485d281ce03d9e4ee915a0864b6fab5fd7b1
    public function updatePlayer($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
<<<<<<< HEAD
=======
    public function getLeagueByUserId($userId)
    {
        return $this->model->with('league')->where('user_id', $userId)->get();
>>>>>>> e4a074c07bb3e00eff31d789573e3490536a181b
=======
    }
  
    public function getLeagueByUserId($userId)
    {
        return $this->model->with('league')->where('user_id', $userId)->get();
>>>>>>> cd44485d281ce03d9e4ee915a0864b6fab5fd7b1
    }
}
