@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100">
        <div class="col-12">
            <div class="alert alert-success w-100" role="alert">
                Your order has been placed successfully
            </div>
            <div class="card mb-3 p-4 border-0 rounded-0">
                <div class="card-body">

                    <div class="d-flex flex-row-reverse align-items-start justify-content-between mb-3">
                        <div class="d-flex flex-column">
                            <img src="{{ asset('storage/logo.png') }}" class="mb-2" style="width:100px;">
                            <div class="visible-print text-center">
                                {!! QrCode::size(100)->generate('Download Link') !!}
                            </div>
                        </div>
                        <div class="">
                            <p class="fw-bold text-black mb-3 h1 text-uppercase">Invoice</p>
                            <p class="text-black-50 mb-2">Shipping and billing to:</p>
                            <p class="mb-1">
                                <i class="fas fa-user me-1"></i>
                                {{ $orderItem->name }}
                            </p>

                            <p class="mb-1">
                                <i class="fas fa-map-marked-alt me-1"></i>
                                {{ $orderItem->address }}
                            </p>

                            <p class="mb-0">
                                <i class="fas fa-phone-square me-1"></i>
                                {{ $orderItem->phone }}
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
                                @foreach ($orderProducts as $product)
                                    <tr>
                                        <td class="w-50">
                                            <a href="{{ route('detail', $product['product']->slug) }}"
                                                class="text-decoration-none">
                                                <div class="d-flex align-items-start gap-2">
                                                    <img src="{{ asset('storage/' . $product['product']->featured_image) }}"
                                                        class="img-1 rounded me-2 mt-1">
                                                    <div class="">
                                                        <p class="mb-0 text-black">{{ $product['product']->title }}</p>
                                                        <p class="mb-0 text-black-50">
                                                            {{ $product['product']->price . ' MMK x ' . $product['qty'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        <td class="w-25 text-end">
                                            {{ $product['product']->price * $product['qty'] . ' MMK' }}
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
                                    <th colspan="2">Payment</th>
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
                                        {{ $total_amount . ' MMK' }}
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

                    <button class="btn btn-outline-dark text-nowrap float-end mt-3">
                        <i class="fas fa-download fa-xs me-1"></i>
                        Download Invoice
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
