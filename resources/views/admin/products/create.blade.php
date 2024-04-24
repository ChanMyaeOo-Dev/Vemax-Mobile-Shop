@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class=" d-flex align-items-center mb-2">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary me-2">
                <i class="fas fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="h3 text-gray-800 mb-0">Add Products</h1>
        </div>
        {{-- Form --}}

        {{-- <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-2">
                <div class="custom_photo_div d-inline-block">
                    <img src="{{ asset('storage/default_book_image.jpg') }}"
                        class="w-100 shadow-sm rounded-3 shadow output">

                    <div class="custom_photo_add_icon">
                        <label for="image"
                            class="photo_choose_icon btn btn-outline-dark image rounded shadow-sm w-100 text-center">
                            <i class="bi bi-camera fs-5"></i>
                        </label>
                        <input type="file" id="image" name="book_image" accept="image/*" onchange="loadFile(event)"
                            hidden>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="mb-1">Book Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Enter Book Title..." value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="mb-1">Book Description</label>
                <textarea class=" form-control @error('description') is-invalid @enderror" rows="6" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="mb-1">Author Name</label>
                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                    placeholder="Enter Author Name..." value="{{ old('author') }}">
                @error('author')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="mb-1">Choose Book Category</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="mb-1">Book Copies</label>
                <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror"
                    placeholder="Enter Book Copies..." value="{{ old('qty') }}">
                @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn lg_btn btn-primary float-end">Add Book</button>
        </form> --}}

        {{-- Form --}}
    </div>
    <script>
        let loadFile = function(event) {
            let output = document.querySelector(".output");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                let error_msg = document.querySelector(".alert-danger").remove();
            }
        };
    </script>
@endsection
