@extends('layouts.client_app')

@section('content')
    <div class="row justify-content-between h-100 g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex gap-4 p-4">
                    <img src="{{ asset('storage/' . $user->profile_image) }}"
                        class="profile_image object-fit-cover border rounded">
                    <div class="d-flex flex-column justify-content-between py-2">
                        <div class="">
                            <p class="fw-bold text-black mb-3 h3">{{ $user->name }}</p>
                            <p class="mb-1">{{ $user->phone }}</p>
                            <p class="mb-1">{{ $user->email }}</p>
                        </div>
                        <button class="btn btn-sm btn-outline-primary w-100 float-end">
                            <i class="fas fa-pencil-alt me-1"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <p class="fw-bold text-dark mb-3">
                        <i class="fas fa-truck me-1"></i>
                        To Receive
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Cost</th>
                                    <th class=" text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer_orders as $order)
                                    <tr>
                                        <td class="w-50">
                                            <div class="d-flex align-items-start gap-2">
                                                <img src="{{ asset('storage/' . $order['product_image']) }}"
                                                    class="img-1 rounded me-2 mt-1">
                                                <div class="">
                                                    <p class="mb-0">{{ $order['product_title'] }}</p>
                                                    <p class="mb-0 text-black-50">
                                                        {{ $order['product_price'] . ' MMK x ' . $order['qty'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="w-25 text-end">
                                            {{ $order['cost'] . ' MMK' }}
                                        </td>

                                        <td class="w-25">
                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                <a href="{{ route('order-detail', $order['order_id']) }}"
                                                    class="btn btn-sm btn-outline-dark">
                                                    Order Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <p class="fw-bold text-dark mb-3">
                        <i class="fas fa-paper-plane  me-1"></i>
                        To Review
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Cost</th>
                                    <th class=" text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($delivered_orders as $order)
                                    <tr>
                                        <td class="w-50">
                                            <div class="d-flex align-items-start gap-2">
                                                <img src="{{ asset('storage/' . $order['product_image']) }}"
                                                    class="img-1 rounded me-2 mt-1">
                                                <div class="">
                                                    <p class="mb-0">{{ $order['product_title'] }}</p>
                                                    <p class="mb-0 text-black-50">
                                                        {{ $order['product_price'] . ' MMK x ' . $order['qty'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="w-25 text-end">
                                            {{ $order['cost'] . ' MMK' }}
                                        </td>

                                        <td class="w-25">
                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                <a href="{{ route('order-detail', $order['order_id']) }}"
                                                    class="btn btn-sm btn-outline-dark">
                                                    Review
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
