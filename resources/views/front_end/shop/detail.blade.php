@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100 g-3">

        <div class="col-12">
            <div class="card bg-white">
                <div class="card-body d-flex gap-5 p-5">
                    <div class="shop_detail_image_container d-flex flex-column gap-2">
                        <div class="swiper swiperMainImage">
                            <div class="swiper-wrapper">
                                @foreach ($photos as $photo)
                                    <div class="swiper-slide">
                                        <img class="object-fit-cover" src="{{ asset('storage/' . $photo) }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <div class="swiper swiperThumbnail">
                            <div class="swiper-wrapper">
                                @foreach ($photos as $photo)
                                    <div class="swiper-slide">
                                        <img class="object-fit-cover" src="{{ asset('storage/' . $photo) }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div>
                        <p class="fw-bold text-black mb-4 h3">{{ $product->title }}</p>
                        <p class="mb-1 text-black">Description</p>
                        <p class="mb-3">{{ $product->description }}</p>
                        <p class="bg-warning text-dark shadow-sm rounded fs-6 px-2 py-1 d-inline">
                            @isset($product->category->title)
                                {{ $product->category->title }}
                            @else
                                <span class="small">UNCATEGORIZE</span>
                            @endisset
                        </p>
                        <p class="mb-0 mt-4 text-black fw-bold fs-5">{{ $product->price . ' MMK' }}</p>
                        <p class="text-black-50 fs-6 mb-3">
                            {{ $product->stock . ' items left.' }}
                        </p>

                        <div class="d-flex gap-2">
                            @auth
                                <form class="addToCartForm" action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button id="cart_submit_btn{{ $product->id }}" type="submit"
                                        class="btn btn-primary w-100">Add to
                                        Cart</button>
                                    <button id="loading_btn{{ $product->id }}"
                                        class="btn btn-light w-100 d-none align-items-center justify-content-center gap-1"
                                        type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Loading...</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary">Add to cart</a>
                            @endauth
                            <a href="{{ route('buy-now', $product->slug) }}" class="btn btn-outline-dark">Buy Now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card bg-white mb-4">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-baseline mb-3 pb-3 border-bottom">
                        <p class="text-primary fw-bold fs-5 mb-0 me-auto">
                            <i class="bi bi-shop me-2"></i> You May Also Like
                        </p>
                        <a href="#" class="btn btn-primary px-4">See All</a>
                    </div>
                    <div class="shop_item_container">
                        @foreach ($related_products as $product)
                            <div class="d-flex flex-column h-100 bg-white border border-1 rounded p-3">
                                <a href="{{ route('detail', $product->slug) }}"
                                    class="text-secondary text-decoration-none w-100 mb-auto">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" height="150px"
                                        class="rounded bg-white w-100 object-fit-cover mb-3">
                                    <p class="mb-0 text-center text-secondary">{{ $product->title }}</p>
                                    <p class="mb-auto text-center text-primary">{{ $product->price }} <span
                                            class="small">MMK</span></p>
                                </a>
                                @auth
                                    <form class="addToCartForm" action="{{ route('carts.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button id="cart_submit_btn{{ $product->id }}" type="submit"
                                            class="btn btn-light w-100 mt-3">Add to
                                            Cart</button>
                                        <button id="loading_btn{{ $product->id }}"
                                            class="btn btn-light w-100 mt-3 d-none align-items-center justify-content-center gap-1"
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
    @push('addToCartScript')
        @vite('resources/js/addToCart.js')
    @endpush

    @push('imageSwiperScript')
        @vite('resources/js/imageSwiper.js')
    @endpush
@endsection
