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
        return $this->model->with('category', 'user')->orderBy('created_at', 'desc')->take(9)->get();
    }

    public function firstNew()
    {
        return $this->model->with('category', 'user')->orderBy('created_at', 'desc')->take(1)->get();

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
        return $this->model->with('category', 'user')->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function detailPost($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getNewsPopular()
    {
        return $this->model->with('category', 'user')->where('status','popular')->orderBy('created_at', 'desc')->get();
    }

    public function getNewsNormal()
    {
        return $this->model->with('category', 'user')->where('status','normal')->orderBy('created_at', 'desc')->get();

    }

    public function relatedPosts($currentPostId, $limit = 6)
    {
        return Post::where('id', '!=', $currentPostId)
            ->latest()
            ->take($limit)
            ->get();
    }


        public function searchNews($query, $sort)
    {
        $leagues = $this->model->query(); // Chắc chắn $leagues là Query Builder

        if ($query) {
            $leagues->where('name', 'like', "%$query%");
        }

// Sắp xếp kết quả
        if ($sort === 'newest') {
            $leagues->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $leagues->orderBy('created_at', 'asc');
        }

        return $leagues->get();
    }

}
