<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryProductRequest;
use App\Http\Requests\CategoryProductUpdateRequest;
use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    protected $categoryProductRepository;

    public function __construct(CategoryProductRepository $categoryProductRepository,Utility $utility )
    {
        $this->categoryProductRepository = $categoryProductRepository;
        $this->utility = $utility;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCategoryProduct = $this->categoryProductRepository->index();
        return view('admin.category-product.index', compact('listCategoryProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category-product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryProductRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageCategory($input);
            if ($img) {
                $path = '/images/exchange/category/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }
        $this->categoryProductRepository->store($input);

        return redirect()->route('categoryProduct.index')->with('success', 'Category Product successfully created.');

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
        $categoryProduct = $this->categoryProductRepository->show($id);
        if (empty($categoryProduct)) {
            return redirect('/404');
        }
        return view('admin.category-product.edit', compact('categoryProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryProductUpdateRequest $request, string $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] =  Str::slug($input['name']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageCategory($input);
            if ($img) {
                $path = '/images/exchange/category/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }
        $input = $this->categoryProductRepository->update($input, $id);

        return redirect()->route('categoryProduct.index')->with('success',  __('Category Product updated success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->categoryProductRepository->destroy($id);
        return back()->with('success', __('CategoryProduct delete success'));
    }
}
