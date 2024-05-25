@extends('layouts.client_app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- Filter Section --}}
            <div class="col-3 min-vh-100 bg-white ps-0 p-4 rounded position-relative">
                <div class=" position-sticky" style="top: 100px">
                    <form id="search_form" action="{{ route('search') }}" method="GET">
                        @isset($search)
                            <input form="search_form" type="hidden" name="search" value="{{ $search }}">
                        @endisset

                        @isset($sortBy)
                            <input form="search_form" type="hidden" name="sort_by" value="{{ $sortBy }}">
                        @endisset

                        @isset($priceRange)
                            {{-- {{ dd($priceRange) }} --}}
                            <input form="search_form" type="hidden" name="priceRange" value="{{ $priceRange }}">
                        @endisset

                    </form>
                    <div class="mb-3 pb-3 border-bottom">
                        <p class="mb-3 border-bottom pb-3">
                            <i class="fas fa-shopping-bag me-1"></i>
                            Categories
                        </p>
                        <div class="form-check mb-3">
                            <input form="search_form" class="form-check-input" type="radio" name="category"
                                id="all_category" value="all_category"
                                @isset($category) {{ $category == 'all_category' ? 'checked' : '' }} @else {{ 'checked' }} @endisset>
                            <label class="form-check-label" for="all_category">
                                All Categories
                            </label>
                        </div>
                        {{-- @isset($category) {{$category=="all_category"?"checked":""}} @endisset --}}
                        @foreach ($categories as $cat)
                            <div class="form-check mb-3">
                                <input form="search_form" class="form-check-input" type="radio" name="category"
                                    value="{{ $cat->id }}" id="category_{{ $cat->id }}"
                                    @isset($category) {{ $category == $cat->id ? 'checked' : '' }} @endisset>
                                <label class="form-check-label" for="category_{{ $cat->id }}">
                                    {{ $cat->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-4 pb-3 border-bottom">
                        <p class="mb-3 border-bottom pb-3">
                            <i class="fas fa-tags me-1"></i>
                            Sort By Price
                        </p>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" form="search_form" name="sort_by"
                                value="best_match" id="best_match"
                                @isset($sortBy) {{ $sortBy == 'best_match' ? 'checked' : '' }}@else {{ 'checked' }} @endisset>
                            <label class="form-check-label" for="best_match">
                                Best Match
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" form="search_form" name="sort_by"
                                value="price_low_to_high" id="price_low_to_high"
                                @isset($sortBy) {{ $sortBy == 'price_low_to_high' ? 'checked' : '' }} @endisset>
                            <label class="form-check-label" for="price_low_to_high">
                                Price low to high
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" form="search_form" name="sort_by"
                                value="price_high_to_low" id="price_high_to_low"
                                @isset($sortBy) {{ $sortBy == 'price_high_to_low' ? 'checked' : '' }} @endisset>
                            <label class="form-check-label" for="price_high_to_low">
                                Price high to low
                            </label>
                        </div>
                    </div>
                    <div class="mb-4 pb-3 border-bottom">
                        <p class="mb-3 border-bottom pb-3">
                            <i class="fas fa-exchange-alt me-1"></i>
                            Price Range
                        </p>
                        <div class="form-check mb-3">
                            <label for="customRange1" class="form-label" id="priceRangeLabel">
                                5000 - {{ isset($priceRange) ? $priceRange : '1000000' }} MMK
                            </label>
                            <input form="search_form" type="range" min="5000" max="1000000" step="5000"
                                class="form-range" id="priceRange" name="priceRange"
                                value={{ isset($priceRange) ? $priceRange : '1000000' }}>
                        </div>
                    </div>

                    <div class="gap-2 d-flex align-items-center">
                        <button form="search_form" type="submit" class="btn btn-dark w-100">Apply Filter</button>
                        <a href="{{ route('shop') }}" class="btn btn-outline-dark w-100">Clear Filter</a>
                    </div>
                </div>
            </div>
            {{-- Main Card --}}
            <div class="col-9 d-flex flex-column ps-4 pe-0">
                @if (count($products) > 0)
                    <div class="search_item_container">
                        @foreach ($products as $product)
                            <div
                                class="product_card d-flex flex-column h-100 bg-white border border-1 rounded p-3 position-relative">
                                <span class="category_label badge text-bg-light">
                                    {{ $product->category->title }}
                                </span>

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
                                            class="btn btn-light w-100 mt-3">Add to Cart</button>
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
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="">
                        <p class="">Product Not Found!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>

    @push('addToCartScript')
        @vite('resources/js/addToCart.js')
    @endpush

    @push('priceRangeScript')
        @vite('resources/js/priceRangeScript.js')
    @endpush

@endsection
