<?php

namespace App\Repositories;

use App\Models\Ranks;

class RankRepository extends BaseRepository
{
    public function model()
    {
        return Ranks::class;
    }

    public function getByLeagueAndTeam($leagueId, $teamId)
    {
        return $this->model->where('league_id', $leagueId)
            ->where('team_id', $teamId)
            ->first();
    }

//    public function updateById($id,  $data)
//    {
//        return $this->model->where('id', $id)->update($data);
//    }


// Lấy toàn bộ rank của một giải
    public function getRankingByLeague($leagueId)
    {
        return $this->model->where('league_id', $leagueId)->get();
    }
}
