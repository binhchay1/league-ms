<?php

namespace App\Repositories;

use App\Models\Referee;

class RefereeRepository extends BaseRepository
{
    public function model()
    {
        return Referee::class;
    }
}
