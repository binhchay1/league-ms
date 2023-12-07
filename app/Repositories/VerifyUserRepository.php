<?php

namespace App\Repositories;

use App\Models\VerifyUser;

class VerifyUserRepository extends BaseRepository
{
    public function model()
    {
        return VerifyUser::class;
    }

    public function getVerifyByUserId($id)
    {
        return $this->model->where('user_id', $id)->first();
    }

    public function updateStatusByToken($token)
    {
        return $this->model->where('token', $token)->update(['status' => 1]);
    }

    public function getVerifyByToken($token)
    {
        return $this->model->where('token', $token)->first();
    }

    public function updateTokenByUserId($user_id, $data)
    {
        return $this->model->where('user_id', $user_id)->update($data);
    }
}
