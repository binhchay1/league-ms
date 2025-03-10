<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function index()
    {
        return $this->model->with('categories', 'brands')->orderBy('created_at', 'desc')->get();
    }

    public function productDetail($slug)
    {
        return $this->model->with( 'categories', 'productImages')->where('slug', $slug)->first();
    }

    public function store($input)
    {
        return $this->model->create($input);
    }

    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($id, $input)
    {
        return $this->model->where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function productSearch($query)
    {
        return $this->model->where('name', 'LIKE', "%{$query}%")->paginate(12);
    }

    public function productNews()
    {
        return $this->model->with('categories', 'brands')->where('status', 'accepted')->orderBy('created_at', 'desc')->get();
    }

}
