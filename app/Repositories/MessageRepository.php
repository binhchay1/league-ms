<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository extends BaseRepository
{
    public function model()
    {
        return Message::class;
    }

    public function getMessagesByGroupId($group_id)
    {
        return $this->model->with('users')->where('group_id', $group_id)->get();
    }
}
