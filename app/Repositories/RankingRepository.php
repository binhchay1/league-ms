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

    public function getRankingByTypeForUpdatePlaces($type)
    {
        return $this->model->select('id', 'places', 'points')->where('type', $type)->orderBy('points', 'desc')->get();
    }
}
