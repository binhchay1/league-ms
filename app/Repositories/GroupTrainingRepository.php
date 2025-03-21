<?php

namespace App\Repositories;

use App\Enums\Group as GroupEnum;
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

    public function searchGroup($query, $sort)
    {
        $group = $this->model->query(); // Chắc chắn $leagues là Query Builder

        if ($query) {
            $group->where('name', 'like', "%$query%");
        }

// Sắp xếp kết quả
        // Xử lý sắp xếp
        switch ($sort) {
            case 'newest':
                $group->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $group->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $group->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $group->orderBy('name', 'desc');
                break;
        }

        return $group->get();
    }
}
