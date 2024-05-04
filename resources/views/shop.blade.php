@extends('layouts.client_app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- Main Card --}}
            <div class="col-12 d-flex flex-column px-1">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="filter_lists d-flex align-items-center gap-2">
                        @if (isset($search))
                            <a href="{{ route('shop') }}" class="btn btn-light shadow">
                                Search: {{ $search }}
                                <i class="fas fa-xs fa-times text-black-50 ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('shop') }}" class="btn btn-light shadow">
                                All Products
                            </a>
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light shadow dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (request()->sort_by == null || request()->sort_by == 'best_match')
                                Sort By : Best Match
                            @elseif (request()->sort_by == 'price_low_to_high')
                                Sort By : Price low to high
                            @elseif (request()->sort_by == 'price_high_to_low')
                                Sort By : Price high to low
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('search') }}" method="GET">
                                    @isset($search)
                                        <input type="hidden" name="search" value="{{ $search }}">
                                    @endisset

                                    @isset($category)
                                        <input type="hidden" name="category" value="{{ $category }}">
                                    @endisset
                                    <input type="hidden" name="sort_by" value="best_match">
                                    <button type="submit" class="dropdown-item" href="{{ route('search') }}">
                                        Best Match
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form action="{{ route('search') }}" method="GET">
                                    @isset($search)
                                        <input type="hidden" name="search" value="{{ $search }}">
                                    @endisset

                                    @isset($category)
                                        <input type="hidden" name="category" value="{{ $category }}">
                                    @endisset
                                    <input type="hidden" name="sort_by" value="price_low_to_high">
                                    <button type="submit" class="dropdown-item" href="{{ route('search') }}">
                                        Price low to high
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form action="{{ route('search') }}" method="GET">
                                    @isset($search)
                                        <input type="hidden" name="search" value="{{ $search }}">
                                    @endisset

                                    @isset($category)
                                        <input type="hidden" name="category" value="{{ $category }}">
                                    @endisset

                                    <input type="hidden" name="sort_by" value="price_high_to_low">
                                    <button type="submit" class="dropdown-item" href="{{ route('search') }}">
                                        Price high to low
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-light shadow dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @isset($category)
                                Filter By : {{ $category_title }}
                            @else
                                Filter
                            @endisset
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('search') }}" method="GET">
                                    @isset($search)
                                        <input type="hidden" name="search" value="{{ $search }}">
                                    @endisset

                                    @isset($sortBy)
                                        <input type="hidden" name="sort_by" value="{{ $sortBy }}">
                                    @endisset
                                    <button type="submit" class="dropdown-item">
                                        All Category
                                    </button>
                                </form>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <form action="{{ route('search') }}" method="GET">
                                        @isset($search)
                                            <input type="hidden" name="search" value="{{ $search }}">
                                        @endisset

                                        @isset($sortBy)
                                            <input type="hidden" name="sort_by" value="{{ $sortBy }}">
                                        @endisset

                                        <input type="hidden" name="category" value="{{ $category->id }}">
                                        <button type="submit" class="dropdown-item" href="{{ route('shop') }}">
                                            {{ $category->title }}
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>

                <div class="shop_item_container">
                    @foreach ($products as $product)
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

                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('addToCartScript')
        @vite('resources/js/addToCart.js')
    @endpush
@endsection
