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

    public function index($user)
    {
        if (\Auth::user()->role == 'admin') {
            return $this->model->orderBy('created_at', 'desc')->get();
        }
        return $this->model->where('group_owner', $user)->orderBy('created_at', 'desc')->get();
    }

    public function getGroupWithStatus()
    {
        return $this->model->with('group_users')->with('users')->where('active', GroupEnum::STATUS_ACTIVE)->get();
    }

    public function getGroupById($dataGroup)
    {
        return $this->model->with('group_users')->with('group_users.users')->with('group_trainings')->where('id', $dataGroup)->first();
    }

    public function getGroupByName($name)
    {
        return $this->model->with('group_users')->with('users')->with('group_trainings')->where('name', $name)->first();
    }

    public function deleteGroup($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
