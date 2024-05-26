@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class=" d-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 text-gray-800">
                Trash
            </h1>
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
                                            <button onclick="onRestoreBtnClick(event)" type="button"
                                                class="btn btn-sm btn-outline-dark border border-2" data-bs-toggle="modal"
                                                data-bs-target="#restoreModal" product_id={{ $product->id }}>
                                                <i class="fas fa-arrow-alt-circle-left me-1"></i>
                                                Restore
                                            </button>

                                            <button onclick="onDeleteBtnClick(event)" type="button"
                                                class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" product_id={{ $product->id }}>
                                                <i class="fas fa-trash-alt me-1"></i>
                                                Delete
                                            </button>

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
    <!--Restore Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="restoreModalLabel">Product Restore</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to restore this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('restore') }}" method="POST">
                        @csrf
                        <input id="inputRestoreProductId" type="hidden" name="id" value="0">
                        <button type="submit" class="btn btn-primary">Resotre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Force Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Permanent Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this product permanently?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('force_delete') }}" method="POST">
                        @csrf
                        @method('Delete')
                        <input id="inputDeleteProductId" type="hidden" name="id" value="0">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const inputRestoreProductId = document.getElementById("inputRestoreProductId");
        let onRestoreBtnClick = (event) => {
            let product_id = event.target.getAttribute("product_id");
            inputRestoreProductId.value = product_id;
        }
        //Delete function
        const inputDeleteProductId = document.getElementById("inputDeleteProductId");
        let onDeleteBtnClick = (event) => {
            let product_id = event.target.getAttribute("product_id");
            inputDeleteProductId.value = product_id;
        }
    </script>
@endsection
