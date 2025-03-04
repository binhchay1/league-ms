<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryProductRepository;
    protected $brandRepository;
    protected $utility;

    public function __construct(
        ProductRepository $productRepository,
        CategoryProductRepository $categoryProductRepository,
        BrandRepository $brandRepository,
        Utility $ultity
    ) {
        $this->productRepository = $productRepository;
        $this->categoryProductRepository = $categoryProductRepository;
        $this->brandRepository = $brandRepository;
        $this->utility = $ultity;
    }

    public function index()
    {
        $listProduct = $this->productRepository->index();
        return view('admin.product.index', compact('listProduct'));
    }

    public function create()
    {
        $listCategory = $this->categoryProductRepository->index();

        return view('admin.product.create', compact( 'listCategory'));
    }

    public function store(ProductRequest $request)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        $input['status'] = Product::IN_STOCK;
        if(empty($request->brand)) {
            $input['brand'] = null;
        }
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
        $listCategory = $this->categoryProductRepository->index();
        $brands = $this->brandRepository->index();
        $status = Product::STATUS;

        return view('admin.product.edit', compact('status','dataProduct', 'listCategory', 'brands'));
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
