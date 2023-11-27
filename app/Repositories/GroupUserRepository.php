<?php

namespace App\Repositories;

use App\Models\GroupUser;
use App\Enums\Group;

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
        return $this->model->where('group_id', $group_id)->where('user_id', $user_id)->where('status_request', Group::STATUS_ACCEPTED)->first();
    }

    public function getMembersByGroupId($group_id)
    {
        return $this->model->with('users')->where('group_id', $group_id)->get();
    }
}
