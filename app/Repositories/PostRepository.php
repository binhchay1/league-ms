<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }

    public function index()
    {
        return $this->model->with('category', 'user')->orderBy('created_at', 'desc')->get();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($input, $id)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function listPostLimit()
    {
        return $this->model->with('category', 'user')->orderBy('created_at', 'desc')->take(3)->get();
    }


}
