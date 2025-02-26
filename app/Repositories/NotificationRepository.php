<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function model()
    {
        return Notification::class;
    }

    public function getNotificationByUserAndLeague($league_id, $user_id, $match)
    {
        return $this->model->where('league_id', $league_id)->where('user_id', $user_id)->where('match', $match)->first();
    }

    public function getNotificationByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function updateReadNotification($user_id)
    {
        return $this->model->where('user_id', $user_id)->update(['status' => 1]);
    }
}
