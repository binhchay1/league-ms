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
        return $this->model->with('group_users')->with('group_users.users')->with('users')->where('active', GroupEnum::STATUS_ACTIVE)->get();
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

    public function searchGroup($query, $sort, $status)
    {
        $group = $this->model->query(); // Chắc chắn $leagues là Query Builder

        if ($query) {
            $group->where('name', 'like', "%$query%");
        }

// Sắp xếp kết quả
        if ($sort === 'newest') {
            $group->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $group->orderBy('created_at', 'asc');
        }

        if ($status === 'private') {
            $group->where('status', 'private');
        } elseif ($status === 'public') {
            $group->where('status', 'public');
        }

        return $group->where('active', GroupEnum::STATUS_ACTIVE)->get();
    }
}
