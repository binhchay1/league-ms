<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\CategoryPostRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $postRepository;
    private $categoryPostRepository;
    private $utility;


    public function __construct(
        CategoryPostRepository $categoryPostRepository,
        PostRepository $postRepository,
        Utility $utility


    )
    {
        $this->categoryPostRepository = $categoryPostRepository;
        $this->postRepository = $postRepository;
        $this->utility = $utility;


    }

    public function index()
    {
        $listPosts = $this->postRepository->index();
        return view('admin.post.index',compact('listPosts'));
    }

    public function create()
    {
        $listCategories = $this->categoryPostRepository->index();
        return view('admin.post.create', compact('listCategories'));
    }

    public function store(PostRequest $request)
    {
        $input = $request->except(['_token']);
        $input = $request->all();
        $input['slug'] =  Str::slug($input['title']);
        $input['author'] = Auth::user()->id;

        if (isset($input['thumbnail'])) {
            $img = $this->utility->saveImagePost($input);
            if ($img) {
                $path = '/images/upload/post/' . $input['thumbnail']->getClientOriginalName();
                $input['thumbnail'] = $path;
            }
        }
        $this->postRepository->create($input);

        return redirect()->route('post.index')->with('success',  __('Post created success'));
    }

    public function edit($id)
    {
        $listCategories = $this->categoryPostRepository->index();
        $post = $this->postRepository->show($id);
        if (empty($post)) {
            return redirect('/404');
        }
        return view('admin.post.edit', compact('post','listCategories'));
    }

    public function update(PostUpdateRequest $request,  $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] =  Str::slug($input['title']);
        if (isset($input['thumbnail'])) {
            $input['thumbnail']->move(public_path('images/upload/post/'), $input['thumbnail']->getClientOriginalName());
            $path = '/images/upload/post/' . $input['thumbnail']->getClientOriginalName();
            $input['thumbnail'] = $path;
        }
        $input = $this->postRepository->update($input, $id);

        return redirect()->route('post.index')->with('success',  __(' Post updated success'));
    }


    public function destroy( $id)
    {
        $this->postRepository->destroy($id);
        return back()->with('success', __('Post delete success'));
    }

}
