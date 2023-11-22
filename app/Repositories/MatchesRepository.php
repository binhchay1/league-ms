<?php

namespace App\Repositories;

use App\Models\Matches;

class MatchesRepository extends BaseRepository
{
    public function model()
    {
        return Matches::class;
    }
}
