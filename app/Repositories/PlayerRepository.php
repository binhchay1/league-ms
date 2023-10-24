<?php

namespace App\Repositories;
use App\Models\Player;

class PlayerRepository extends BaseRepository
{
    public function model()
    {
        return Player::class;
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

}
