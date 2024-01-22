<?php

namespace App\Repositories;

use App\Models\Group;
use App\Enums\Group as GroupEnum;

class GroupRepository extends BaseRepository
{
    public function model()
    {
        return Group::class;
    }

    public function getGroupWithStatus()
    {
        return $this->model->with('group_users')->with('users')->where('active', GroupEnum::STATUS_ACTIVE)->get();
    }

    public function getGroupByName($name)
    {
        return $this->model->with('group_users')->with('users')->with('group_trainings')->where('name', $name)->first();
    }
}
