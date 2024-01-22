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

    public function create($input)
    {
        return $this->model->create($input);
    }

}
