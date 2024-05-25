@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary me-2">
                <i class="fas fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="h3 text-gray-800 mb-0">Add Products</h1>
        </div>
        {{-- Form --}}
        <form id="product_upload_form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        </form>
        <div class="row">
            <div class="col-8 pe-2">
                <div class="card bg-white">
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="" class="mb-1">Product Title</label>
                            <input form="product_upload_form" type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Enter Product Title..." value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">Product Description</label>
                            <textarea form="product_upload_form" class=" form-control @error('description') is-invalid @enderror" rows="6"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-1">Price</label>
                            <input form="product_upload_form" type="number" name="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price..."
                                value="{{ old('price') }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-1">Choose Product Category</label>
                            <select form="product_upload_form" class="form-select" aria-label="Default select example"
                                name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-1">Stock</label>
                            <input form="product_upload_form" type="number" name="stock"
                                class="form-control @error('stock') is-invalid @enderror" placeholder="Enter Stock..."
                                value="{{ old('stock') }}">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-white">
                    <div class="card-body">

                        <p class="mb-4">
                            Product Images
                        </p>

                        <div class="mb-2">
                            <label for="featured_image" class="form-label">Feature Image</label>
                            <input form="product_upload_form" type="file" class="form-control" id="featured_image"
                                name="featured_image" placeholder="feature_image" accept="image/*"
                                onchange="loadFeatureImage(event)">
                        </div>

                        <div class="mb-3 d-flex align-items-center gap-2" id="featureImageContainer">
                        </div>

                        <div class="mb-2">
                            <label for="images" class="form-label">Product Images</label>
                            <input form="product_upload_form" type="file" class="form-control" id="images"
                                name="images[]" placeholder="images" accept="image/*" onchange="loadFile(event)" multiple>
                        </div>
                        <div class="d-flex align-items-center gap-2" id="imgContainer">
                        </div>
                        <button type="submit" form="product_upload_form"
                            class="btn lg_btn btn-primary float-end mt-3 w-100">Add
                            Product</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form --}}
    </div>

    <script>
        let loadFeatureImage = function(event) {
            document.getElementById('featureImageContainer').innerHTML =
                `<div class="img_box"><img src="${URL.createObjectURL(event.target.files[0])}" class="w-100 h-100 output object-fit-cover rounded"></div>`;
        };
        let loadFile = function(event) {
            const imgContainer = document.getElementById('imgContainer');
            imgContainer.innerHTML = ''; // Clear previous content
            [...event.target.files].forEach((file, index) => {
                const imgBox = document.createElement('div');
                imgBox.classList.add('img_box');

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('w-100', 'h-100', 'output', 'object-fit-cover', 'rounded');

                const deleteBtn = document.createElement('button');
                deleteBtn.innerHTML = `<i class="fas fa-trash-alt"></i>`;
                deleteBtn.id = index;
                deleteBtn.classList.add('img_delete_btn');
                deleteBtn.addEventListener('click', (event) => {
                    btnOnClick(event);
                });

                imgBox.appendChild(img);
                imgBox.appendChild(deleteBtn);
                imgContainer.appendChild(imgBox);
            });
        };


        function btnOnClick(event) {
            event.preventDefault();
            removeFileFromFileList(event.currentTarget.id);
        }

        function removeFileFromFileList(index) {
            let dt = new DataTransfer();
            let files = document.getElementById('images').files;

            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                if (index != i) {
                    dt.items.add(file);
                }
            }
            document.getElementById('images').files = dt.files;
            updateImageList(dt.files);
        }

        function updateImageList(files) {
            const imgContainer = document.getElementById('imgContainer');
            imgContainer.innerHTML = ''; // Clear previous content
            [...files].forEach((file, index) => {
                const imgBox = document.createElement('div');
                imgBox.classList.add('img_box');

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('w-100', 'h-100', 'output', 'object-fit-cover', 'rounded');

                const deleteBtn = document.createElement('button');
                deleteBtn.innerHTML = `<i class="fas fa-trash-alt"></i>`;
                deleteBtn.id = index;
                deleteBtn.classList.add('img_delete_btn');
                deleteBtn.addEventListener('click', (event) => {
                    btnOnClick(event);
                });

                imgBox.appendChild(img);
                imgBox.appendChild(deleteBtn);
                imgContainer.appendChild(imgBox);
            });
        }
    </script>
@endsection
