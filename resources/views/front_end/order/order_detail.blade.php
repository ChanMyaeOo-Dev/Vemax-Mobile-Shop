@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100">

        <div class="col-12">
            <div class="card border-0 shadow bg-white mb-3">
                <div class="card-body d-flex gap-5 p-5">
                    <img src="{{ asset('storage/' . $order->product->featured_image) }}"
                        class="profile_image object-fit-cover rounded">
                    <div>
                        <p class="fw-bold text-black mb-4 h3">{{ $order->product->title }}</p>
                        <p class="mb-1 text-black">Description</p>
                        <p class="mb-3">{{ $order->product->description }}</p>
                        <p class="bg-warning text-dark shadow-sm rounded fs-6 px-2 py-1 d-inline">
                            @isset($order->product->category->title)
                                {{ $order->product->category->title }}
                            @else
                                <span class="small">UNCATEGORIZE</span>
                            @endisset
                        </p>
                        <p class="mb-3 mt-4 text-black fw-bold fs-5">
                            {{ $order->product->price . ' MMK x ' . $order->qty }}</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($orders as $order)
            <div class="col-12">
                <div class="card border-0 shadow bg-white mb-3">
                    <div class="card-body d-flex gap-5 p-5">
                        <img src="{{ asset('storage/' . $order->product->featured_image) }}"
                            class="shop_detail_image object-fit-cover rounded">
                        <div>
                            <p class="fw-bold text-black mb-4 h3">{{ $order->product->title }}</p>
                            <p class="mb-1 text-black">Description</p>
                            <p class="mb-3">{{ $order->product->description }}</p>
                            <p class="bg-warning text-dark shadow-sm rounded fs-6 px-2 py-1 d-inline">
                                @isset($order->product->category->title)
                                    {{ $order->product->category->title }}
                                @else
                                    <span class="small">UNCATEGORIZE</span>
                                @endisset
                            </p>
                            <p class="mb-3 mt-4 text-black fw-bold fs-5">
                                {{ $order->product->price . ' MMK x ' . $order->qty }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
