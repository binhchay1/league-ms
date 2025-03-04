<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    protected $brandRepository;
    protected $categoryProductRepository;

    public function __construct(
        BrandRepository $brandRepository,
        CategoryProductRepository $categoryProductRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryProductRepository = $categoryProductRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBrand = $this->brandRepository->index();
        return view('admin.brand.index', compact('listBrand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listCategory = $this->categoryProductRepository->index();
        return view('admin.brand.create', compact('listCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        dd($input);
        $this->brandRepository->store($input);

        return redirect()->route('brand.index')->with('success', 'Brand successfully created.');

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
        $brand = $this->brandRepository->show($id);
        $listCategory = $this->categoryProductRepository->index();
        if (empty($brand)) {
            return redirect('/404');
        }
        return view('admin.brand.edit', compact('brand', 'listCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] =  Str::slug($input['name']);

        $input = $this->brandRepository->update($input, $id);

        return redirect()->route('brand.index')->with('success',  __('Brand updated success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->brandRepository->destroy($id);
        return back()->with('success', __('Brand delete success'));
    }

    public function getBrandsByCategory($category_id)
    {
        $brands = $this->brandRepository->getBrandByCategory($category_id);

        return response()->json($brands);
    }

}
