<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerPostRepository extends BaseRepository
{
    public function model()
    {
        return Player::class;
    }

    public function goalkeeper()
    {
        return $this->model->where('playing_position', \App\Enums\Player::Goalkeeper)->orderBy('created_at', 'desc')->get();
    }

    public function defender()
    {
        return $this->model->where('playing_position', \App\Enums\Player::Defender)->orderBy('created_at', 'desc')->get();
    }

    public function midfielder()
    {
        return $this->model->where('playing_position', \App\Enums\Player::Midfielder)->orderBy('created_at', 'desc')->get();
    }

    public function forward()
    {
        return $this->model->where('playing_position', \App\Enums\Player::Forward)->orderBy('created_at', 'desc')->get();
    }

}
