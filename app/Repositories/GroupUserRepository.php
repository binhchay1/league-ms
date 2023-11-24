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

    public function checkJoinedGroupByName($user_id, $group_id)
    {
        return $this->model->where('group_id', $group_id)->where('user_id', $user_id)->first();
    }
}
