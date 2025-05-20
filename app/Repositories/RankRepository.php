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

    public function getAll()
    {
        return $this->model->get();
    }

    public function getOrCreate($leagueId, $teamId)
    {
        return $this->model->firstOrCreate(
            ['league_id' => $leagueId, 'team_id' => $teamId],
            ['match_played' => 0, 'win' => 0, 'lose' => 0, 'point' => 0]
        );
    }

// Lấy toàn bộ rank của một giải
    public function getRankingByLeague($leagueId)
    {
        return $this->model->where('league_id', $leagueId)->get();
    }
}
