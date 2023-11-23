<?php

namespace App\Repositories;

use App\Models\GroupUser;

class GroupUserRepository extends BaseRepository
{
    public function model()
    {
        return GroupUser::class;
    }

    public function getGroupByUserId($userId)
    {
        return $this->model->with('groups')->where('user_id', $userId)->get();
    }
}
