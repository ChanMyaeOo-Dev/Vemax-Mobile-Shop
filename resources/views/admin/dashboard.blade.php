@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <!-- Content Row -->
        <div class="row">

            <!-- Total Sale Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Total Sales
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalOrders . ' Orders' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Income Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Income
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalIncome . ' MMK' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Visitor -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Visitor
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Customer -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Customer
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customerCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content Row -->

        <div class="row mb-4">
            <!-- Pie Chart -->
            <div class="col-4">
                <div class="card shadow h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Recent Order
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="order_count_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card shadow h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Top Sold Products</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Top Sold Products</div>
                                <a class="dropdown-item" href="{{ route('products.index') }}">Show All</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @foreach ($topFiveProducts as $product)
                            <a href="{{ route('products.show', $product->id) }}" class=" text-decoration-none">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}"
                                        class="img-2 me-3 object-fit-cover">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <p class="mb-0 text-dark">{{ $product->title }}</p>
                                            <p class="mb-0 text-black-50 small">
                                                {{ $product->order_details_sum_qty . ' Sold' }}
                                            </p>
                                        </div>
                                        <p class="mb-0 text-black-50 small">{{ $product->category->title }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">New Orders</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">New Orders</div>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">Show All</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @foreach ($new_orders as $order)
                            <a href="{{ route('orders.show', $order->order_id) }}" class=" text-decoration-none">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/' . $order->product->featured_image) }}"
                                        class="img-2 me-3 object-fit-cover">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <p class="mb-0 text-dark">{{ $order->product->title }}</p>
                                            <p class="mb-0 text-black-50 small">{{ $order->qty . ' qty' }}
                                            </p>
                                        </div>
                                        <p class="mb-0 text-black-50 small">{{ $order->phone }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Product overview
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Products</div>
                                <a class="dropdown-item" href="{{ route('products.index') }}">Show All</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table_header">
                                    <th class=" fw-normal">PRODUCTS</th>
                                    <th class=" fw-normal">CATEGORY</th>
                                    <th class=" fw-normal">STOCK</th>
                                    <th class=" fw-normal">PRICE</th>
                                    <th class=" fw-normal">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="">
                                            <div class="d-flex align-items-center">
                                                <img src="
                                                {{ asset('storage/' . $product->featured_image) }}"
                                                    class="img-1 shadow rounded me-3 object-fit-cover">
                                                <div>
                                                    <p class="mb-0 text-dark">{{ $product->title }}</p>
                                                    <p class="mb-0 text-black-50 sm">{!! Str::words($product->description, 6, ' ...') !!}</p>
                                                </div>
                                            </div>
                                        </td>

                                        @isset($product->category->title)
                                            <td>{{ $product->category->title }}
                                            </td>
                                        @else
                                            <td class="small text-black-50">UNCATEGORIZE</td>
                                        @endisset

                                        <td>

                                            @if ($product->stock <= 0)
                                                <span class="text-danger">Out Of Stock</span>
                                            @else
                                                {{ $product->stock }}
                                            @endif
                                        </td>
                                        <td>{{ "$ " . $product->price }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-outline-dark border border-2">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-outline-dark border border-2">
                                                    <i class="fas fa-info-circle"></i>
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
        <!-- Content Row -->
    </div>
    <script type="module">
        showOrderCountChart({!! json_encode($orderCountsInLastSixMonth) !!});
    </script>
@endsection
