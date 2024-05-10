@extends('layouts.client_app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                {{-- Banner Card --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-white h-100">
                            <div class="card-body d-flex flex-column">
                                <p class="text-primary fw-bold fs-5 mb-3 pb-3 border-bottom">
                                    <i class="bi bi-fire me-2"></i> Popular Items
                                </p>
                                <div class="mb-auto">
                                    @foreach ($get_6_products as $product)
                                        <div class="mb-3 pb-3 border-bottom">
                                            <a href="{{ route('detail', $product->slug) }}"
                                                class="text-secondary text-decoration-none">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $product->featured_image) }}"
                                                        class="img-1 rounded me-3">
                                                    <p class="mb-0 text-secondary me-auto">
                                                        {{ $product->title }}
                                                    </p>
                                                    <i class="bi bi-chevron-right"></i>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('shop') }}" class="btn btn-primary w-100">See All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card bg-white">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/banner_1.png') }}" height="520px"
                                            class="w-100 object-fit-cover rounded">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/banner_2.png') }}" height="520px"
                                            class="w-100 object-fit-cover rounded">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/banner_3.png') }}" height="520px"
                                            class="w-100 object-fit-cover rounded">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Category Card --}}
                <div class="card bg-white mb-4">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-baseline mb-3 pb-3 border-bottom">
                            <p class="text-primary fw-bold fs-5 mb-0 me-auto">
                                <i class="bi bi-fire me-2"></i> Categories
                            </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            @foreach ($get_6_categories as $category)
                                <form action="{{ route('search') }}" method="GET" class="w-100">
                                    <input type="hidden" name="category" value="{{ $category->id }}">
                                    <button class="text-secondary text-decoration-none p-3 w-100 bg-white border-0">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('storage/' . $category->image) }}" width="90px"
                                                height="90px" class="rounded me-3">
                                            <p class="mb-0 text-secondary me-auto">{{ $category->title }}</p>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Card --}}
            <div class="card bg-white mb-4">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-baseline mb-3 pb-3 border-bottom">
                        <p class="text-primary fw-bold fs-5 mb-0 me-auto">
                            <i class="bi bi-shop me-2"></i> Just for you
                        </p>
                        <a href="{{ route('shop') }}" class="btn btn-primary px-4">See All</a>
                    </div>
                    <div class="shop_item_container">
                        @foreach ($get_12_products as $product)
                            <div class="product_card d-flex flex-column h-100 p-2">
                                <a href="{{ route('detail', $product->slug) }}"
                                    class="text-secondary text-decoration-none w-100 mb-auto">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" height="180px"
                                        class="product_image rounded bg-white w-100 object-fit-cover mb-3">
                                    <p class="mb-0 text-center text-secondary">{{ $product->title }}</p>
                                    <p class="mb-auto text-center text-dark">{{ $product->price }} <span
                                            class="small">MMK</span></p>
                                </a>
                                @auth
                                    <form class="addToCartForm" action="{{ route('carts.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button id="cart_submit_btn{{ $product->id }}" type="submit"
                                            class="cart_submit_btn rounded-0 btn btn-light shadow w-100 mt-3">
                                            <i class="fas fa-cart-plus text-secondary me-1"></i>
                                            Add to Cart</button>
                                        <button id="loading_btn{{ $product->id }}"
                                            class=" rounded-0 btn btn-light shadow w-100 mt-3 d-none align-items-center justify-content-center gap-1"
                                            type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <span role="status">Loading...</span>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="w-100 btn btn-outline-primary mt-3">Add to cart</a>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('addToCartScript')
        @vite('resources/js/addToCart.js')
    @endpush
@endsection
