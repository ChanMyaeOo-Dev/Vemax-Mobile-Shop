@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100">
        <div class="col-md-4">
            <div class="card border-0" style="height: 720px;">
                <div class="card-body bg-white border border-1 rounded p-5">
                    <div class="d-flex flex-column align-items-center h-100">
                        <div class="d-flex flex-column mb-auto">

                            <h3 class="mb-2 fw-bold text-center text-secondary">Thanks you</h3>
                            <h3 class="mb-4 fw-bold text-center text-secondary">Your Order is Confirmed.</h3>

                        </div>
                        <img src="{{ asset('src_images/success_order.png') }}" class="mb-auto" height="120px">
                        <a href="{{ route('/') }}" class="btn btn-primary w-100 py-2">
                            CONTINUE SHOPPING
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                                {{ $customer->name }}
                            </p>

                            <p class="mb-2 text-secondary">
                                <i class="fas fa-phone-alt me-2"></i>
                                {{ $customer->phone }}
                            </p>

                            <p class="mb-0 text-secondary">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                {{ $customer->address }}
                            </p>

                        </div>
                    </div>

                    <p class="mb-3 text-dark fw-bold fs-5 ps-2">Order Details</p>
                    @foreach ($orderProducts as $product)
                        <div class="card border-0 border-bottom mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $product['product']->featured_image) }}" height="50px"
                                        width="50px" class=" object-fit-cover rounded shadow me-3">
                                    <p class="mb-0 text-dark fs-5 me-auto">
                                        {{ $product['product']->title . ' x ' . $product['qty'] }}
                                    </p>
                                    <p class="mb-0 text-dark fw-bold fs-5">
                                        {{ $product['product']->price * $product['qty'] }}
                                        Kyats
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
