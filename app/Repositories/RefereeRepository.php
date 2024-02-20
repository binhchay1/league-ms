<?php

namespace App\Repositories;

use App\Models\Referee;

class RefereeRepository extends BaseRepository
{
    public function model()
    {
        return Referee::class;
    }

    public function getRefereeByUserId($user_id, $schedule_id)
    {
        return $this->model->where('user_id', $user_id)->where('schedule_id', $schedule_id)->first();
    }
}
