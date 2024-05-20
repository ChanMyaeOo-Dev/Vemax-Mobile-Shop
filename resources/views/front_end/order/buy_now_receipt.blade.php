@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100">
        <div class="col-12">
            <div class="d-flex align-items-center gap-3 justify-content-between mb-3">
                <nav class="w-100" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order detail</li>
                    </ol>
                </nav>
                <button class="btn btn-outline-dark text-nowrap h-100">
                    <i class="fas fa-download fa-xs me-1"></i>
                    Download Invoice
                </button>
            </div>
            <div class="card mb-3 p-4 border-0 rounded-0">
                <div class="card-body">

                    <div class="d-flex gap-5 mb-3">
                        <img src="{{ asset('storage/' . $orders[0]->user->profile_image) }}"
                            class="img-2x object-fit-cover">
                        <div>
                            <p class="fw-bold text-black mb-3 h3 text-uppercase">Vemax Online Shop</p>
                            <p class="text-black-50 mb-2">Shipping and billing to:</p>
                            <p class="mb-1">
                                <i class="fas fa-user me-1"></i>
                                {{ $orders[0]->name }}
                            </p>

                            <p class="mb-1">
                                <i class="fas fa-map-marked-alt me-1"></i>
                                {{ $orders[0]->address }}
                            </p>

                            <p class="mb-0">
                                <i class="fas fa-phone-square me-1"></i>
                                {{ $orders[0]->phone }}
                            </p>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="w-50">
                                            <a href="{{ route('detail', $order->product->slug) }}"
                                                class="text-decoration-none">
                                                <div class="d-flex align-items-start gap-2">
                                                    <img src="{{ asset('storage/' . $order->product->featured_image) }}"
                                                        class="img-1 rounded me-2 mt-1">
                                                    <div class="">
                                                        <p class="mb-0 text-black">{{ $order->product->title }}</p>
                                                        <p class="mb-0 text-black-50">
                                                            {{ $order->product->price . ' MMK x ' . $order->qty }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        <td class="w-25 text-end">
                                            {{ $order->product->price * $order->qty . ' MMK' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Payment</th>
                                    <th class="text-end">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="w-50">
                                        <p class="mb-0 ms-2 text-black">Payment Type</p>
                                    </td>
                                    <td class="w-25 text-end">
                                        COD
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">
                                        <p class="mb-0 ms-2 text-black">Subtotal</p>
                                    </td>
                                    <td class="w-25 text-end">
                                        {{ $total_cost . ' MMK' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">
                                        <p class="mb-0 ms-2 text-black">Delivery Fee</p>
                                    </td>
                                    <td class="w-25 text-end">
                                        2500 MMK
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between h-100">
        <div class="col-md-8">
            {{-- Delivery Details --}}
            <div class="card border-0 h-100">
                <div class="card-body bg-white border border-1 rounded p-4">

                    <img src="{{ asset('storage/logo.png') }}" width="200px" class="mb-4">

                    <p class="mb-3 text-dark fw-bold fs-5 ps-2">Delivery</p>

                    <div class="card bg-white border border-1 mb-4">
                        <div class="card-body">

                            <p class="mb-2 text-secondary">
                                <i class="fas fa-user me-2"></i>
                                {{ $orderItem->name }}
                            </p>

                            <p class="mb-2 text-secondary">
                                <i class="fas fa-phone-alt me-2"></i>
                                {{ $orderItem->phone }}
                            </p>

                            <p class="mb-0 text-secondary">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                {{ $orderItem->address }}
                            </p>

                        </div>
                    </div>

                    <p class="mb-3 text-dark fw-bold fs-5 ps-2">Order Details</p>
                    <div class="card border-0 border-bottom mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $product->featured_image) }}" height="50px" width="50px"
                                    class=" object-fit-cover rounded shadow me-3">
                                <p class="mb-0 text-dark fs-5 me-auto">
                                    {{ $product->title . ' x ' . $qty }}
                                </p>
                                <p class="mb-0 text-dark fw-bold fs-5">
                                    {{ $product->price * $qty }}
                                    Kyats
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="d-flex align-items-center justify-content-between mt-4 mb-4 px-3 py-3 border-bottom border-top">
                        <p class="mb-0 fw-bold fs-4 text-dark">Total</p>
                        <p class="mb-0 fw-bold fs-4 text-dark">{{ $total_amount . ' Kyats' }}</p>
                    </div>
                    <a href="{{ route('/') }}" class="btn btn-primary w-100 py-2">
                        DOWNLOAD RECEIPT
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
