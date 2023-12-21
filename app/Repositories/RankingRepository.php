<?php

namespace App\Repositories;

use App\Models\Ranking;

class RankingRepository extends BaseRepository
{
    public function model()
    {
        return Ranking::class;
    }

    public function getTopByType($type)
    {
        return $this->model->with('users')->where('type', $type)->limit(100)->get();
    }

    public function updatePointByUser($user_id, $data)
    {
        return $this->model->where('user_id', $user_id)->update($data);
    }

    public function getRankingOrderByPoint()
    {
        return $this->model->orderBy('points', 'DESC')->get();
    }
}
