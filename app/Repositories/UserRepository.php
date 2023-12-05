<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function showInfo($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function updateSocialID($email, $data)
    {
        return $this->model->where('email', $email)->update($data);
    }

    public function getUserByGoogle($googleID)
    {
        return $this->model->where('google_id', $googleID)->first();
    }

    public function getUserByFacebook($facebookID)
    {
        return $this->model->where('facebook_id', $facebookID)->first();
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getUserWithRanking($user_id)
    {
        return $this->model->with('ranking')->where('id', $user_id)->first();
    }
}
