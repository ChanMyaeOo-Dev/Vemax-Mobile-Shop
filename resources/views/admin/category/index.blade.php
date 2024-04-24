@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class=" d-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 text-gray-800">Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Products</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Product Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('storage/' . $category->image) }}" class="img-1 rounded">
                                            <p class="mb-0">{{ $category->title }}</p>
                                        </div>
                                    </td>
                                    <td>1200</td>
                                    <td>
                                        <div class=" d-flex align-items-center gap-2">
                                            <a href="{{ route('categories.edit', $category->slug) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fas fa-regular fa-trash-can"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn btn-sm btn-outline-dark">
                                                    <i class="fas fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
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
