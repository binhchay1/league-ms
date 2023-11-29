<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Str;
use App\Enums\Group;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productRepository;
    protected $utility;

    public function __construct(
        ProductRepository $productRepository,
        Utility $ultity
    ) {
        $this->productRepository = $productRepository;
        $this->utility = $ultity;
    }

    public function index()
    {
        $listProduct = $this->productRepository->get();
        return view('admin.product.index', compact('listProduct'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(ProductRequest $request)
    {
        $input = $request->except(['_token']);
        $input['product_owner'] = Auth::user()->id;
        $input['rate'] = Group::RATE_NEWLY_ESTABLISHED;

        $input['activity_time'] = $input['activity_time_start'];
        if ($input['activity_time_end'] != null) {
            $input['activity_time'] .= ' - ' . $input['activity_time_end'];
        }
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/product/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->productRepository->create($input);

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $dataGroup = $this->productRepository->getById($id);

        return view('admin.product.edit', compact('dataGroup'));
    }


    public function update(GroupRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/product/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->productRepository->updateById($id, $input);
        return redirect()->route('product.index');
    }
}
