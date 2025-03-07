<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{

    private $productRepository;
    private $categoryProductRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryProductRepository $categoryProductRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryProductRepository = $categoryProductRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->index();
        $categories = $this->categoryProductRepository->index();
        return view('exchange.index', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product =  $this->productRepository->productDetail($slug);
        $relatedProducts = Product::where('category', $product->category)->where('slug', '!=', $slug)->limit(6)->get();

        return view('exchange.product.show', compact('product', 'relatedProducts'));
    }
    /**
     * Show the form for creating a new resource.
     */

    //category
    public function categoryDetail($slug)
    {
        $categories = $this->categoryProductRepository->index();
        $categoryProduct =  $this->categoryProductRepository->productCategory($slug);

        return view('exchange.product.category-product', compact('categoryProduct', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = $this->categoryProductRepository->index();

        $query = $request->input('q');

        // Tìm kiếm theo tên sản phẩm
        $products =  $this->productRepository->productSeach($query);
        return view('exchange.product.search', compact('products', 'query', 'categories'));
    }


}
