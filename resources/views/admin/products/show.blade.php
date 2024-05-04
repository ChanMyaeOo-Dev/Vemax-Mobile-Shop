@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
                    </ol>
                </nav>
                {{-- Main Card --}}
                <div class="row">
                    {{-- Product Information --}}
                    <div class="col-12">
                        <div class="card border-0 shadow bg-white">
                            <div class="card-body d-flex gap-5 p-5">
                                <img src="{{ asset('storage/' . $product->featured_image) }}"
                                    class="shop_detail_image object-fit-cover rounded">
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
                                    <p class="mb-3 mt-4 text-black fw-bold fs-5">{{ $product->price . ' MMK' }}</p>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-outline-primary">Edit Product</a>

                                        <form class="addToCartForm" action="{{ route('products.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button id="cart_submit_btn{{ $product->id }}" type="submit"
                                                class="btn btn-outline-primary w-100">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-5 w-100 bg-white"></div>
            </div>
        </div>
    </div>
@endsection
