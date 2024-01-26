<?php

namespace App\Repositories;

use App\Models\Ranking;

class RankingRepository extends BaseRepository
{
    public function model()
    {
        return Ranking::class;
    }

    public function getTop()
    {
        return $this->model->with('users')->limit(100)->get();
    }

    public function updatePointByUser($user_id, $data)
    {
        return $this->model->where('user_id', $user_id)->update($data);
    }

    public function getRankingOrderByPoint()
    {
        return $this->model->orderBy('points', 'DESC')->get();
    }

    public function listRankHomePage()
    {
        return $this->model->with('users')->orderBy('points', 'desc')->take(1)->get();
    }

    public function getRankingListUsers($listId)
    {
        return $this->model->whereIn('user_id', $listId)->orderBy('points', 'desc')->get();
    }
}
