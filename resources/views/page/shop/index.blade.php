{{--@extends('layouts.page')--}}

{{--@section('title')--}}
{{--{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Shop') }}--}}
{{--@endsection--}}

{{--@section('css')--}}
{{--<link rel="stylesheet" href="{{ asset('css/jquery.menu.all.css') }}" />--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--<section id="heading">--}}
{{--    <div class="container">--}}
{{--        <h1 class="center">{{ __('Shop') }}</h1>--}}
{{--        <p class="center">{{ __('Our shop always serves the highest quality products') }}</p>--}}
{{--    </div>--}}
{{--</section>--}}

{{--<section id="shop" class="container-fluid collection-template">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <section class="main_container collection col-lg-9 col-md-9 col-sm-12 col-xs-12  col-lg-push-3 col-md-push-3 col-sm-12 col-xs-12">--}}
{{--                <h1 class="title-head collection-title">--}}
{{--                    Vợt cầu lông--}}
{{--                </h1>--}}

{{--                <div class="category-products products">--}}
{{--                    <div class="module-header margin-bottom-15">--}}
{{--                        <div class="sortPagiBar">--}}
{{--                            <div id="sort-by">--}}
{{--                                <div class="border_sort">--}}
{{--                                    <select onchange="sortby(this.value)">--}}
{{--                                        <option class="valued" value="default">Mặc định</option>--}}
{{--                                        <option value="price-asc">Giá tăng dần</option>--}}
{{--                                        <option value="price-desc">Giá giảm dần</option>--}}
{{--                                        <option value="alpha-asc">Từ A-Z</option>--}}
{{--                                        <option value="alpha-desc">Từ Z-A</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="module-content">--}}
{{--                        <section class="products-view products-view-grid">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 col-item">--}}
{{--                                    <div class="product-box">--}}
{{--                                        <div class="product-thumbnail">--}}
{{--                                            <a href="/products/vot-tap-co-tay-li-ning-traninig-140g" title="Vợt tập cổ tay Li-Ning TRANINIG 140G">--}}
{{--                                                <img class="product-image" src="//product.hstatic.net/200000099191/product/img20230803103516_1fdbf478d23145a083534620e3a03483_grande.jpg" alt="Vợt tập cổ tay Li-Ning TRANINIG 140G">--}}
{{--                                            </a>--}}
{{--                                            <div class="fw product-action hidden-xs">--}}
{{--                                                <form action="/cart/add" method="post" class="variants form-nut-grid" data-id="product-actions-1048753798" enctype="multipart/form-data">--}}

{{--                                                    <input type="hidden" name="Id" value="1110037880">--}}
{{--                                                    <button class="btn-buy btn-cart btn button-hover-3 left-to add_to_cart" title="Mua ngay">--}}
{{--                                                        <span><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>--}}
{{--                                                    </button>--}}

{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="product-info">--}}
{{--                                            <div class="fw product-review">--}}
{{--                                                <div class="bizweb-product-reviews-badge" data-id="1048753798"></div>--}}
{{--                                            </div>--}}
{{--                                            <h3 class="product-name a-center">--}}
{{--                                                <a href="/products/vot-tap-co-tay-li-ning-traninig-140g" title="Vợt tập cổ tay Li-Ning TRANINIG 140G">--}}
{{--                                                    Vợt tập cổ tay Li-Ning TRANINIG 140G--}}
{{--                                                </a>--}}
{{--                                            </h3>--}}
{{--                                            <div class="price-box price-loop-style res-item">--}}
{{--                                                <span class="special-price">--}}
{{--                                                    <span class="price">{{ 1212 }}</span>--}}
{{--                                                </span>--}}
{{--                                                <span class="old-price">--}}
{{--                                                    <span class="price">--}}
{{--                                                    </span>--}}
{{--                                                </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="text-xs-right">--}}
{{--                                <nav class="fw pagination-parent">--}}
{{--                                    <ul class="pagination clearfix">--}}
{{--                                        <li class="page-item hidden-xs disabled">--}}
{{--                                            <a class="page-link" href="#">«</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="active page-item disabled">--}}
{{--                                            <a class="page-link" href="javascript:;">1</a>--}}
{{--                                        </li>--}}

{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" onclick="doSearch(2)" href="javascript:;">2</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" onclick="doSearch(3)" href="javascript:;">3</a>--}}
{{--                                        </li>--}}

{{--                                        <li class="page-item hidden-xs"><a class="page-link" onclick="doSearch(2)" href="javascript:;">»</a></li>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}
{{--                            </div>--}}
{{--                        </section>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}

{{--            <aside class="dqdt-sidebar sidebar left left-content col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-pull-9 col-md-pull-9 col-sm-12 col-xs-12">--}}
{{--                <!-- DANH MỤC SẢN PHẨM -->--}}
{{--                <link href="//theme.hstatic.net/200000099191/1001041918/14/sidebar_menu.scss.css?v=80" rel="stylesheet" type="text/css" media="all">--}}

{{--                <div class="sidebar-item sidebar-menu sidebar-collection-menu">--}}
{{--                    <div class="module-header">--}}
{{--                        <h2 class="title-head module-title sidebar-title">--}}
{{--                            <a href="javascript:;">--}}
{{--                                <span>Danh mục sản phẩm</span>--}}
{{--                            </a>--}}
{{--                        </h2>--}}
{{--                    </div>--}}
{{--                    <div class="sidebar-menu-content module-content">--}}
{{--                        <div class="sidebar-linklists">--}}
{{--                            <ul>--}}
{{--                                <li class="sidebar-menu-list collection-sidebar-menu">--}}
{{--                                    <a class="ajaxLayer" href="/collections/san-pham-khuyen-mai" title="Sản phẩm khuyến mãi">--}}
{{--                                        <span>Sản phẩm khuyến mãi</span>--}}
{{--                                    </a>--}}

{{--                                </li>--}}
{{--                                <li class="sidebar-menu-list collection-sidebar-menu">--}}
{{--                                    <a class="ajaxLayer" href="/collections/san-pham-noi-bat" title="Sản phẩm nổi bật">--}}
{{--                                        <span>Sản phẩm nổi bật</span>--}}
{{--                                    </a>--}}

{{--                                </li>--}}

{{--                                <li class="sidebar-menu-list collection-sidebar-menu active">--}}
{{--                                    <a class="ajaxLayer" href="/collections/vot-cau-long" title="Vợt cầu lông">--}}
{{--                                        <span>Vợt cầu lông</span>--}}
{{--                                    </a><em><i class="fa fa-plus" aria-hidden="true"></i></em>--}}

{{--                                    <ul style="display: none" class="lv2">--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/calibar" title="Calibar">--}}
{{--                                                <span>Calibar</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/aerount" title="Aerount">--}}
{{--                                                <span>Aerount</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/turbo-charging" title="Turbo Charging">--}}
{{--                                                <span>Turbo Charging</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/3d-breakfree" title="3D BREAKFREE">--}}
{{--                                                <span>3D BREAKFREE</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/air-stream" title="AIR - STREAM">--}}
{{--                                                <span>AIR - STREAM</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/wstom" title="Wstom">--}}
{{--                                                <span>Wstom</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/carbon" title="Carbon">--}}
{{--                                                <span>Carbon</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/tf" title="Tf">--}}
{{--                                                <span>Tf</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/us" title="US">--}}
{{--                                                <span>US</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/nano-blade" title="Nano Blade">--}}
{{--                                                <span>Nano Blade</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/tectonic" title="TECTONIC">--}}
{{--                                                <span>TECTONIC</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                    </ul>--}}

{{--                                </li>--}}

{{--                                <li class="sidebar-menu-list collection-sidebar-menu">--}}
{{--                                    <a class="ajaxLayer" href="/collections/trang-phuc-cau-long" title="Trang phục cầu lông">--}}
{{--                                        <span>Trang phục cầu lông</span>--}}
{{--                                    </a><em><i class="fa fa-plus" aria-hidden="true"></i></em>--}}

{{--                                    <ul style="display: none" class="lv2">--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/ao-cau-long-nam" title="Áo cầu lông nam">--}}
{{--                                                <span>Áo cầu lông nam</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/quan-cau-long-nam" title="Quần cầu lông nam">--}}
{{--                                                <span>Quần cầu lông nam</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/ao-cau-long-nu" title="Áo cầu lông nữ">--}}
{{--                                                <span>Áo cầu lông nữ</span>--}}
{{--                                            </a>--}}

{{--                                        </li>--}}

{{--                                        <li>--}}
{{--                                            <a class="ajaxLayer a_lv2" href="/collections/quan-cau-long-nu" title="Quần cầu lông nữ">--}}
{{--                                                <span>Quần cầu lông nữ</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <!-- FILTERS -->--}}

{{--                <div class="aside-filter sidebar-item">--}}
{{--                    <div class="filter-container hidden">--}}
{{--                        <div class="filter-container__selected-filter" style="display: none;">--}}
{{--                            <div class="filter-container__selected-filter-header clearfix">--}}
{{--                                <span class="filter-container__selected-filter-header-title"><i class="fa fa-arrow-left hidden-sm-up"></i> Bạn chọn</span>--}}
{{--                                <a href="javascript:void(0)" onclick="clearAllFiltered()" class="filter-container__clear-all">Bỏ hết <i class="fa fa-angle-right"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="filter-container__selected-filter-list">--}}
{{--                                <ul></ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- LỌC GIÁ -->--}}

{{--                    <aside class="aside-item filter-price">--}}
{{--                        <div class="aside-title module-header">--}}
{{--                            <h2 class="title-head module-title sidebar-title">--}}
{{--                                <a href="javascript:;">--}}
{{--                                    <span>Giá thành</span>--}}
{{--                                </a>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <div class="module-content aside-content filter-group">--}}
{{--                            <ul>--}}
{{--                                <li class="filter-item filter-item--check-box filter-item--green">--}}
{{--                                    <span>--}}
{{--                                        <label for="filter-duoi-1-000-000d">--}}
{{--                                            <input type="checkbox" id="filter-duoi-1-000-000d" data-group="Khoảng giá" data-field="price_min" data-text="Dưới 1.000.000đ" value="(price:product<1000000)" data-operator="OR">--}}
{{--                                            <i class="fa"></i>--}}
{{--                                            Giá dưới 1.000.000đ--}}
{{--                                        </label>--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </aside>--}}

{{--                    <aside class="aside-item filter-type">--}}
{{--                        <div class="aside-title module-header">--}}
{{--                            <h2 class="title-head module-title sidebar-title">--}}
{{--                                <a href="javascript:;">--}}
{{--                                    <span>Loại</span>--}}
{{--                                </a>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <div class="module-content aside-content filter-group">--}}
{{--                            <ul>--}}
{{--                                <li class="filter-item filter-item--check-box filter-item--green">--}}
{{--                                    <span>--}}
{{--                                        <label for="filter-vot-cau-long">--}}
{{--                                            <input type="checkbox" id="filter-vot-cau-long" data-group="Loại" data-field="product_type" data-text="Vợt cầu lông" value="(product_type:product**Vợt cầu lông)" data-operator="OR">--}}
{{--                                            <i class="fa"></i>--}}
{{--                                            Vợt cầu lông--}}
{{--                                        </label>--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </aside>--}}

{{--                    <aside class="aside-item filter-vendor">--}}
{{--                        <div class="aside-title module-header">--}}
{{--                            <h2 class="title-head module-title sidebar-title">--}}
{{--                                <a href="javascript:;">--}}
{{--                                    <span>Nhà cung cấp</span>--}}
{{--                                </a>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <div class="module-content aside-content filter-group">--}}
{{--                            <ul>--}}
{{--                                <li class="filter-item filter-item--check-box filter-item--green" title="10.000.000đ">--}}
{{--                                    <span>--}}
{{--                                        <label for="filter-lining">--}}
{{--                                            <input type="checkbox" id="filter-lining" data-group="Hãng" data-field="vendor" data-text="Lining" value="(vendor:product**Lining)" data-operator="OR">--}}
{{--                                            <i class="fa"></i>--}}
{{--                                            Lining--}}
{{--                                        </label>--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </aside>--}}

{{--                    <aside class="aside-item filter-tag-style-1">--}}
{{--                        <div class="aside-title module-header">--}}
{{--                            <h2 class="title-head module-title sidebar-title">--}}
{{--                                <a href="javascript:;">--}}
{{--                                    <span>Màu sắc</span>--}}
{{--                                </a>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <div class="module-content aside-content filter-group">--}}
{{--                            <ul>--}}
{{--                                <li class="filter-item filter-item--check-box filter-item--green" title="Đen">--}}
{{--                                    <span>--}}
{{--                                        <label for="filter-den">--}}
{{--                                            <input type="checkbox" id="filter-den" data-group="tag1" data-field="variants.title" data-text="Đen" value="(variant:product**Đen)" data-operator="OR">--}}
{{--                                            <i class="fa"></i>--}}
{{--                                            Đen--}}
{{--                                        </label>--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </aside>--}}
{{--                </div>--}}

{{--                <div class="sidebar-item sidebar-menu sidebar-collection-menu">--}}
{{--                    <div class="module-header margin-bottom-15">--}}
{{--                        <h2 class="title-head module-title sidebar-title">--}}
{{--                            <a href="javascript:;">--}}
{{--                                <span>Sản phẩm bán chạy</span>--}}
{{--                            </a>--}}
{{--                        </h2>--}}
{{--                    </div>--}}
{{--                    <div class="sidebar-menu-content module-content padding-0">--}}
{{--                        <div class="collection-sidebar-items owl-carousel owl-theme owl-loaded owl-drag" data-lg-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xxs-items="1" data-margin="30">--}}
{{--                            <div class="owl-stage-outer">--}}
{{--                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 586px;">--}}
{{--                                    <div class="owl-item active" style="width: 263px; margin-right: 30px;">--}}
{{--                                        <div class="item">--}}
{{--                                            <div class="product-item product-sidebar">--}}
{{--                                                <a class="product-image" href="/products/qua-cau-long" title="Quả Cầu Lông AYQN024-3 TỐC ĐỘ 76">--}}
{{--                                                    <img class="img-responsive" src="//theme.hstatic.net/200000099191/1001041918/14/swing.svg?v=80" data-lazyload="https://product.hstatic.net/200000099191/product/thiet_ke_chua_co_ten__5__01734df5c8f3431b8ee805520061b5b6.jpg" alt="Quả Cầu Lông AYQN024-3 TỐC ĐỘ 76">--}}
{{--                                                </a>--}}
{{--                                                <div class="product-info">--}}
{{--                                                    <h3 class="product-name">--}}
{{--                                                        <a href="/products/qua-cau-long" title="Quả Cầu Lông AYQN024-3 TỐC ĐỘ 76">--}}
{{--                                                            <span>Quả Cầu Lông AYQN024-3 TỐC ĐỘ 76</span>--}}
{{--                                                        </a>--}}
{{--                                                    </h3>--}}
{{--                                                    <div class="price-box price-loop-style res-item">--}}
{{--                                                        <span class="special-price">--}}
{{--                                                            <span class="price">235,000₫</span>--}}
{{--                                                        </span>--}}
{{--                                                        <span class="old-price">--}}
{{--                                                            <span class="price">--}}

{{--                                                            </span>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </aside>--}}
{{--            <div id="open-filters" class="open-filters hidden-lg hidden-md">--}}
{{--                <i class="fa fa-filter"></i>--}}
{{--                <span>Lọc</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--@endsection--}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Cầu Lông</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            border-radius: 8px;
            width: 100vw;
            left: 0;
            top: 100%;
            display: flex;
            flex-wrap: wrap;
            max-height: 400px;
            overflow-y: auto;
        }
        .group:hover .dropdown-menu {
            display: flex;
        }
        .dropdown-category {
            flex: 1 1 calc(25% - 1rem);
            padding: 1rem;
            min-width: 200px;
        }
        .dropdown-category h3 {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .dropdown-item {
            padding: 0.5rem;
            cursor: pointer;
            white-space: nowrap;
        }
        .dropdown-item:hover {
            background: #f1f1f1;
        }

        .module-title {
            margin: 15px 0 30px;
            font-size: 1em;
            position: relative;
            background: #f5f5f5;
            border-top: #ed3b05 3px solid;
        }
        .product:hover .cart-icon {
            opacity: 1;
            transform: translateY(0);
        }
        .product:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-100">
<header class="bg-[#0b2239] p-4">
    <div class="container mx-auto flex flex-wrap items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="logo.png" alt="Logo" class="h-10">
            <nav>
                <ul class="flex space-x-6 text-white font-semibold">
                    <li class="hover:text-yellow-400 cursor-pointer">Mượn vợt thử</li>
                    <li class="hover:text-yellow-400 cursor-pointer">Tin tức</li>
                    <li class="hover:text-yellow-400 cursor-pointer">Đặt lịch đánh vợt</li>
                    <li class="hover:text-yellow-400 cursor-pointer">Hàng cũ</li>
                </ul>
            </nav>
        </div>
        <div class="flex items-center space-x-3 mt-3 md:mt-0">
            <input type="text" placeholder="🔍 Tìm kiếm..." class="p-2 w-72 rounded-lg text-black">
            <button class="bg-yellow-500 px-4 py-2 rounded-lg text-black font-bold">🔍</button>
            <div class="bg-yellow-500 px-4 py-2 rounded-lg font-bold text-black">📞 0824.01.01.88</div>
        </div>
    </div>
</header>

<nav class="w-full bg-white shadow-lg rounded-lg p-4 relative">
    <ul class="flex space-x-6 text-black font-semibold">
        <li class="group relative">
            <button class="p-3 hover:bg-gray-200 rounded-lg">🏸 Sản phẩm</button>
            <div class="dropdown-menu hidden group-hover:flex">
                <div class="dropdown-category">
                    <h3>Vợt cầu lông</h3>
                    <div class="dropdown-item">Yonex</div>
                    <div class="dropdown-item">Lining</div>
                    <div class="dropdown-item">Victor</div>
                    <div class="dropdown-item">Mizuno</div>
                </div>
                <div class="dropdown-category">
                    <h3>Giày cầu lông</h3>
                    <div class="dropdown-item">Mizuno</div>
                    <div class="dropdown-item">Yonex</div>
                    <div class="dropdown-item">Victor</div>
                    <div class="dropdown-item">Lining</div>
                </div>
                <div class="dropdown-category">
                    <h3>Áo cầu lông</h3>
                    <div class="dropdown-item">Yonex</div>
                    <div class="dropdown-item">Lining</div>
                    <div class="dropdown-item">Victor</div>
                    <div class="dropdown-item">Kamito</div>
                </div>
                <div class="dropdown-category">
                    <h3>Quần cầu lông</h3>
                    <div class="dropdown-item">Victor</div>
                    <div class="dropdown-item">Yonex</div>
                    <div class="dropdown-item">Lining</div>
                    <div class="dropdown-item">Kamito</div>
                </div>
                <div class="dropdown-category">
                    <h3>Phụ kiện</h3>
                    <div class="dropdown-item">Balo</div>
                    <div class="dropdown-item">Túi vợt</div>
                    <div class="dropdown-item">Grip vợt</div>
                    <div class="dropdown-item">Băng cổ tay</div>
                </div>
            </div>
        </li>
    </ul>
</nav>
</body>


<section class="relative w-full max-w-6xl mx-auto mt-6">
    <div class="relative w-full h-64 overflow-hidden rounded-lg">
        <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out" id="bannerSlider">
            <img src="https://theme.hstatic.net/200000099191/1001041918/14/slider_2_image.png?v=240" class="w-full object-cover">
            <img src="https://theme.hstatic.net/200000099191/1001041918/14/slider_2_image.png?v=240" class="w-full object-cover">
            <img src="https://theme.hstatic.net/200000099191/1001041918/14/slider_2_image.png?v=240" class="w-full object-cover">
        </div>
        <button id="prevSlide" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2">❮</button>
        <button id="nextSlide" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2">❯</button>
    </div>
</section>

<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll("#bannerSlider img");
    function showSlide(index) {
        if (index >= slides.length) currentIndex = 0;
        else if (index < 0) currentIndex = slides.length - 1;
        else currentIndex = index;
        document.querySelector("#bannerSlider").style.transform = `translateX(-${currentIndex * 100}%)`;
    }
    document.getElementById("nextSlide").addEventListener("click", () => showSlide(currentIndex + 1));
    document.getElementById("prevSlide").addEventListener("click", () => showSlide(currentIndex - 1));
    setInterval(() => showSlide(currentIndex + 1), 5000);
</script>

<!-- Danh mục sản phẩm -->
<section class="max-w-6xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 module-title">Áo thể thao</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class=" product bg-white p-4 rounded shadow">
            <img src="//product.hstatic.net/200000099191/product/img20230803103516_1fdbf478d23145a083534620e3a03483_grande.jpg" alt="Áo thể thao" class="w-full rounded">
            <div class="cart-icon absolute top-2 right-2 bg-yellow-500 p-2 rounded-full opacity-0 transform translate-y-2 transition-all duration-300">
                🛒
            </div>
            <p class="mt-2 font-semibold text-center ">Áo Wika Alpha</p>
            <p class="text-red-600 font-bold text-center">189.000 VNĐ</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <img src="shirt2.jpg" alt="Áo thể thao" class="w-full rounded">
            <p class="mt-2 font-semibold">Áo Wika Alpha Đỏ</p>
            <p class="text-red-600 font-bold">189.000 VNĐ</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <img src="shirt2.jpg" alt="Áo thể thao" class="w-full rounded">
            <p class="mt-2 font-semibold">Áo Wika Alpha Đỏ</p>
            <p class="text-red-600 font-bold">189.000 VNĐ</p>
        </div>
        <div class="product relative bg-white p-4 rounded-lg shadow-lg cursor-pointer overflow-hidden">
            <img src="product3.jpg" alt="Product 3" class="w-full transition-transform duration-300">
            <div class="cart-icon absolute top-2 right-2 bg-yellow-500 p-2 rounded-full opacity-0 transform translate-y-2 transition-all duration-300">
                🛒
            </div>
            <h3 class="text-center font-semibold mt-2">Áo cầu lông</h3>
        </div>




    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center p-4 mt-6">
    &copy; 2025 MyLeague.vn - All rights reserved.
</footer>
</body>
</html>

<style>

    /* Định dạng tổng thể */
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .widget-header h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    /* Lưới sản phẩm */
    .list-product-slide1 {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .product {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .product:hover {
        transform: scale(1.05);
    }

    .product img {
        width: 100%;
        height: auto;
        border-bottom: 2px solid #eee;
    }

    .inner-prod {
        padding: 10px;
        text-align: center;
    }

    .product-title a {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .product-title a:hover {
        color: #d32f2f;
    }

    .product-price {
        font-size: 16px;
        font-weight: bold;
        color: #d32f2f;
    }

    /* Nút thao tác */
    .product-action {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
    }

    .product-action a {
        padding: 8px 12px;
        background: #0288d1;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .product-action a:hover {
        background: #01579b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .list-product-slide1 {
            flex-direction: column;
            align-items: center;
        }

        .product {
            width: 90%;
        }
    }
</style>

