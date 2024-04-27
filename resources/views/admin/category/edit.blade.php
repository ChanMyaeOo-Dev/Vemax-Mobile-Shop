@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary me-2">
                <i class="fas fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="h3 text-gray-800 mb-0">Edit Category</h1>
        </div>
        <div class="card bg-white w-50">
            <div class="card-body">

                <p class="mb-3">
                    Cover Image
                </p>

                {{-- Form --}}
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mt-2">
                        <div class="custom_photo_div d-inline-block">
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-100 shadow-sm rounded-3 shadow output">
                            <div class="custom_photo_add_icon">
                                <label for="image"
                                    class="photo_choose_icon btn btn-outline-dark image rounded shadow-sm w-100 text-center">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="image" name="image" accept="image/*"
                                    onchange="loadFile(event)" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="category_name"
                            name="title" value="{{ $category->title }}" placeholder="Enter Category Title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100">Update Category</button>
                </form>
                {{-- Form --}}

            </div>
        </div>
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
