<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $products = $this->productRepository->homeExchange();
        $categories = $this->categoryProductRepository->index();
        return view('exchange.index', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $categories = $this->categoryProductRepository->index();
        $product =  $this->productRepository->productDetail($slug);
        $relatedProducts = Product::where('category', $product->category)->where('slug', '!=', $slug)->limit(6)->get();

        return view('exchange.product.show', compact('product', 'relatedProducts', 'categories'));
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
        $products =  $this->productRepository->productSearch($query);
        return view('exchange.product.search', compact('products', 'query', 'categories'));
    }

    public function productSale()
    {
        $categories = $this->categoryProductRepository->index();
        return view('exchange.product.post-product', compact( 'categories'));
    }

    public function storeProductSale(Request $request)
    {
        $request->validate([
            'product_images.*' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Tạo sản phẩm mới
        $input = $request->except(['_token']);
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);
        $input['status'] = \App\Enums\Product::STATUS_POST_NEWS;
        $input['user_id'] = Auth::user()->id;
        $input['start_date'] = now();
        $input['expires_at'] = now()->addDays(30);
        // Xử lý ảnh chính (image)
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/images/upload/product/'), $imageName);
            $input['images'] = '/images/upload/product/' . $imageName; // Lưu đường dẫn

        }
        $product = $this->productRepository->create($input);
        // Xử lý ảnh phụ (images)
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/images/upload/product/'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => '/images/upload/product/' . $imageName
                ]);
            }
        }

        return redirect()->route('exchange.managerNews')->with('success', 'Post news created success!');
    }

    public function managerNews(Request $request)
    {
        $user = Auth::user();
        $categories = $this->categoryProductRepository->index();
        $getNewsByStatus = $request->get('status');
        $productNews = $this->productRepository->productNews($getNewsByStatus, $user->id);
        $countProductByStatus = $this->productRepository->countProduct($user->id);

        return view('exchange.manager-news.index', compact('categories', 'productNews', 'countProductByStatus'));
    }


}
