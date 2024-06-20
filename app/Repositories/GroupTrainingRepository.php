<?php

namespace App\Repositories;

use App\Models\GroupTraining;
use App\Enums\Group;

class GroupTrainingRepository extends BaseRepository
{
    public function model()
    {
        return GroupTraining::class;
    }

    public function getGroupTrainByName($nameGroupTraining)
    {
        return $this->model->with('groups')->where('name', $nameGroupTraining)->first();
    }

    public function index($user)
    {
        if (\Auth::user()->role == 'admin') {
            return $this->model->orderBy('created_at', 'desc')->get();
        }

        return $this->model->where('owner_user', $user)->orderBy('created_at', 'desc')->get();
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function editGroupTraining($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }


    public function getMembersById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateMembers($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }
}
