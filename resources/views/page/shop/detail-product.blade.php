<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<header class="bg-[#0b2239] p-4 text-white text-center text-lg font-semibold">
    Chi Tiết Sản Phẩm
</header>

<main class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Hình ảnh sản phẩm -->
    <div class="bg-white p-4 shadow-lg rounded-lg">
        <img src="product.jpg" alt="Sản phẩm" class="w-full rounded-lg">
        <div class="flex space-x-2 mt-4">
            <img src="product1.jpg" alt="Thumbnail" class="w-1/4 cursor-pointer rounded-lg">
            <img src="product2.jpg" alt="Thumbnail" class="w-1/4 cursor-pointer rounded-lg">
            <img src="product3.jpg" alt="Thumbnail" class="w-1/4 cursor-pointer rounded-lg">
        </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold">Vợt Cầu Lông BladeX 900</h1>
        <p class="text-lg text-red-500 font-semibold mt-2">Giá: 3,500,000đ</p>
        <p class="mt-4 text-gray-700">Mô tả ngắn về sản phẩm, các tính năng nổi bật và chất liệu.</p>
        <button class="bg-yellow-500 text-black font-bold py-2 px-6 rounded-lg mt-4 w-full hover:bg-yellow-600">Mua Ngay</button>
    </div>
</main>

<!-- Thông tin chi tiết -->
<section class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-semibold">Thông Tin Chi Tiết</h2>
    <ul class="mt-4 space-y-2">
        <li>- Chất liệu: Carbon</li>
        <li>- Trọng lượng: 85g</li>
        <li>- Điểm cân bằng: 295mm</li>
    </ul>
</section>

<!-- Đánh giá sản phẩm -->
<section class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h2 class="text-xl font-semibold">Đánh Giá Sản Phẩm</h2>
    <p class="mt-4 text-gray-700">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</p>
</section>

<!-- Sản phẩm liên quan -->
<section class="container mx-auto p-6 mt-6">
    <h2 class="text-xl font-semibold">Sản Phẩm Liên Quan</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <img src="related1.jpg" alt="Sản phẩm liên quan" class="w-full rounded-lg">
            <h3 class="mt-2 text-center font-semibold">Vợt Yonex</h3>
        </div>
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <img src="related2.jpg" alt="Sản phẩm liên quan" class="w-full rounded-lg">
            <h3 class="mt-2 text-center font-semibold">Giày Mizuno</h3>
        </div>
        <div class="bg-white p-4 shadow-lg rounded-lg">
            <img src="related3.jpg" alt="Sản phẩm liên quan" class="w-full rounded-lg">
            <h3 class="mt-2 text-center font-semibold">Áo cầu lông</h3>
        </div>
    </div>
</section>
</body>
</html>
