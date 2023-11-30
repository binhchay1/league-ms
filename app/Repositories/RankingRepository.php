<?php

namespace App\Repositories;

use App\Models\Ranking;

class RankingRepository extends BaseRepository
{
    public function model()
    {
        return Ranking::class;
    }

    public function getRankingByType($type) {
        return $this->model->where();
    }
}
