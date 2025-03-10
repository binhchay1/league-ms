<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
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
        $status = \App\Enums\Product::STATUS;
        return view('admin.product.create', compact( 'listCategory', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_images.*' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Tạo sản phẩm mới
        $input = $request->except(['_token']);
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->name);

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

        return redirect()->route('product.index');
    }

    public function edit(Request $request)
    {
        $dataProduct = $this->productRepository->getById($request->get('id'));
        $listCategory = $this->categoryProductRepository->index();
        $brands = $this->brandRepository->index();
        $status = \App\Enums\Product::STATUS;

        return view('admin.product.edit', compact('status','dataProduct', 'listCategory', 'brands'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/images/upload/product/'), $imageName);
            $input['images'] = '/images/upload/product/' . $imageName; // Lưu đường dẫn

        }
        $product = $this->productRepository->update($id, $input);
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/images/upload/product/'), $imageName);

                // Thêm ảnh mới vào bảng `product_images`
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => '/images/upload/product/' . $imageName
                ]);
            }
        }
        return redirect()->route('product.index');
    }

    public function delete(Request $request)
    {
        $this->productRepository->deleteById($request->get('id'));

        return redirect()->route('product.index');
    }

    public function deleteProductImage($id)
    {
        $image = ProductImage::find($id);
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Ảnh không tồn tại!']);
        }

        // Xóa file ảnh vật lý
        if (file_exists(public_path($image->image_url))) {
            unlink(public_path($image->image_url));
        }

        // Xóa ảnh khỏi database
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Xóa ảnh thành công!']);
    }

}
