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
                        <div class="card bg-white">
                            <div class="card-body row">
                                <div class="col-4 d-flex flex-column gap-2">
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
                                <div class="col">
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
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-outline-primary">Edit Product</a>
                                        <form id="product_delete_form"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            data-redirect="{{ route('products.index') }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete Product</button>
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
    @push('imageSwiperScript')
        @vite('resources/js/imageSwiper.js')
    @endpush
    @push('confirmDialogScript')
        @vite('resources/js/confirmDialogScript.js')
    @endpush
    <script>
        document.getElementById('delete-button').addEventListener('click', function() {
            showConfirmDialog("Hello");
        });
    </script>
@endsection
