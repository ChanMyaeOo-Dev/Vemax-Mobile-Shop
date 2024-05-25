@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class=" d-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 text-gray-800">Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Products</a>
        </div>
        <!-- DataTale -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
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
@endsection
