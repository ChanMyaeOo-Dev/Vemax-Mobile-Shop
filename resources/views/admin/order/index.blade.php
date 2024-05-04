@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class=" d-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 text-gray-800">Orders</h1>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Total Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($customer_orders) }} --}}

                            @foreach ($customer_orders as $order)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('storage/' . $order['customer_profile_image']) }}"
                                                class="img-1 rounded">
                                            <p class="mb-0">{{ $order['customer_name'] }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order['product_count'] . ' Orders' }}
                                    </td>

                                    <td>
                                        {{ $order['order_status'] }}
                                    </td>

                                    <td>
                                        <div class=" d-flex align-items-center gap-2">
                                            <a href="{{ route('orders.show', $order['id']) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                Detail
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
    <!-- Category Add Modal-->
    <div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
                        id="category_add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="category_name" name="title"
                                placeholder="Enter Category Title">
                        </div>

                        <div>
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button form="category_add_form" type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
