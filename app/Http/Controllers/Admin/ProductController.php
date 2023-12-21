<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Http\Request;

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

        if (isset($input['images'])) {
            $img = $this->utility->saveImageProduct($input);
            if ($img) {
                $path = '/images/upload/product/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->productRepository->create($input);

        return redirect()->route('product.index');
    }

    public function edit(Request $request)
    {
        $dataProduct = $this->productRepository->getById($request->get('id'));

        return view('admin.product.edit', compact('dataProduct'));
    }

    public function update(ProductRequest $request, $id)
    {
        $input = $request->except(['_token']);

        if (isset($input['images'])) {
            $img = $this->utility->saveImageProduct($input);
            if ($img) {
                $path = '/images/upload/product/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->productRepository->updateById($id, $input);
        return redirect()->route('product.index');
    }

    public function delete(Request $request)
    {
        $this->productRepository->deleteById($request->get('id'));

        return redirect()->route('product.index');
    }
}
