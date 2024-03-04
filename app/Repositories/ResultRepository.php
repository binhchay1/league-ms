<?php

namespace App\Repositories;

use App\Models\Result;

class ResultRepository extends BaseRepository
{
    public function model()
    {
        return Result::class;
    }

    public function getResultByScheduleId($schedule_id)
    {
        return $this->model->where('schedule_id', $schedule_id)->first();
    }
}
