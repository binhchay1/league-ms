<?php

namespace App\Repositories;

use App\Models\UserLeague;

class UserLeagueRepository extends BaseRepository
{
    public function model()
    {
        return UserLeague::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function updatePlayer($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getLeagueByUserId($userId)
    {
        return $this->model->with('league')->where('user_id', $userId)->get();
    }

    public function countTotalMembersInLeague($league_id)
    {
        return $this->model->where('league_id', $league_id)->count();
    }

    public function getLeagueByUserIdAndLeagueId($user_id, $league_id)
    {
        return $this->model->with('league')->where('user_id', $user_id)->where('league_id', $league_id)->first();
    }

    public function checkRegister($league, $userId)
    {
        return $this->model->where('league_id', $league)
        ->where('user_id', $userId)
        ->exists();
    }

    public function hasPartnerInThisLeague($user, $league)
    {
        return $this->model->where('user_id', $user)
            ->where('league_id', $league)
            ->whereNotNull('partner_id')
            ->exists();
    }

}
