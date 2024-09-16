<?php

namespace App\Repositories;

use App\Models\CategoryPost;

class CategoryPostRepository extends BaseRepository
{
    public function model()
    {
        return CategoryPost::class;
    }

    public function index()
    {
        return $this->model->with('posts')->orderBy('created_at', 'desc')->get();
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


    public function postCategory($slug)
    {
        return $this->model->with('posts')->where('slug', $slug)->first();
    }


}
