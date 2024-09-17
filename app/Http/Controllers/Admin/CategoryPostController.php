<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPostRequest;
use App\Repositories\CategoryPostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryPostController extends Controller
{
    protected $categoryPostRepository;

    public function __construct(CategoryPostRepository $categoryPostRepository )
    {
        $this->categoryPostRepository = $categoryPostRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCategoryPost = $this->categoryPostRepository->index();

        return view('admin.category-post.index', compact('listCategoryPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category-post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryPostRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);

        $this->categoryPostRepository->store($input);

        return redirect()->route('categoryPost.index')->with('success', 'Category Post successfully created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoryPost = $this->categoryPostRepository->show($id);
        if (empty($categoryPost)) {
            return redirect('/404');
        }
        return view('admin.category-post.edit', compact('categoryPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryPostRequest $request, string $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] =  Str::slug($input['name']);

        $input = $this->categoryPostRepository->update($input, $id);

        return redirect()->route('categoryPost.index')->with('success',  __('Category Post updated success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->categoryPostRepository->destroy($id);
        return back()->with('success', __('CategoryPost delete success'));
    }
}
