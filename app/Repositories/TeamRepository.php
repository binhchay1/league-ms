<?php

namespace App\Repositories;

use App\Models\UserLeague;

class UserLeagueRepository extends BaseRepository
{
    public function model()
    {
        return UserLeague::class;
    }

    public function index()
    {
        return $this->model->with('players', 'players.')->orderBy('created_at', 'desc') ->paginate(env('PAGINATION_PER_PAGE', 4));
    }



}
