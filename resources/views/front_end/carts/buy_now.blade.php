 @extends('layouts.client_app')

 @section('content')
     <div class="row justify-content-between">
         <div class="col-md-8">
             <div class="bg-white rounded d-flex flex-column h-100 border border-1 p-4">
                 <div class="d-flex align-items-baseline mb-3 pb-3 border-bottom">
                     <p class="text-primary fw-bold fs-4 mb-0">
                         Pre-CheckOut Form
                     </p>
                 </div>
                 <div class="card border-0 flex-grow-1">
                     <div class="card-body">
                         <div class="d-flex justify-content-between">

                             <div class="d-flex">
                                 <img src="{{ asset('storage/' . $product->featured_image) }}" height="180px" width="180px"
                                     class="object-fit-cover rounded me-4">
                                 <div class="menu_info_box">
                                     <p class="mb-0 text-dark fw-bold fs-5">{{ $product->title }}</p>
                                     <div class="d-flex align-items-center small">
                                         <i class=" text-black-50 bi bi-star-fill"></i>
                                         <i class=" text-black-50 bi bi-star-fill"></i>
                                         <i class=" text-black-50 bi bi-star-fill"></i>
                                         <i class=" text-black-50 bi bi-star-fill"></i>
                                         <i class=" text-black-50 bi bi-star-half"></i>
                                     </div>
                                     <p class="mb-3 text-black-50">{{ Str::words($product->description, 10, '...') }}</p>
                                     <p class="mb-0 text-dark fw-bold fs-5">{{ $product->price }} Kyats</p>
                                     <p class="text-black-50 fs-6 mb-0">
                                         {{ $product->stock . ' items left.' }}
                                     </p>
                                     {{-- Qty Update --}}
                                     <div id="update_div" class="d-inline-flex border rounded mt-2" style="height: 40px;">
                                         <button id="qtyMinusBtn" onclick="qtyMinus()" type="button"
                                             class="btn btn-light h-100 rounded-end-0">
                                             <i class="fas fa-minus fa-xs text-black-50"></i>
                                         </button>
                                         <div class="d-flex align-items-center justify-content-center px-4">
                                             <p id="currentQty" class="mb-0 fw-bold">
                                                 1
                                             </p>
                                         </div>
                                         <button id="qtyAddBtn" onclick="qtyAdd()" type="button"
                                             class="btn btn-light h-100 rounded-start-0">
                                             <i class="fas fa-plus fa-xs text-black-50"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-md-4">
             {{-- Delivery Details --}}
             <div class="card border-0">
                 <div class="card-body bg-white border border-1 rounded p-4">
                     <p class="fs-5 fw-bold text-dark mb-3 pb-3 border-bottom">Delivery</p>
                     <div>

                         <div class="mb-3">
                             <label for="name" class="form-label">Name</label>
                             <input form="orderUploadForm" type="text"
                                 class="form-control
                                        @error('name')
                                        is-invalid
                                        @enderror"
                                 value="{{ Auth::user()->name }}" id="name" name="name" placeholder="name">
                             <div class=" invalid-feedback">
                                 @error('name')
                                     {{ $message }}
                                 @enderror"
                             </div>
                         </div>

                         <div class="mb-3">
                             <label for="phone" class="form-label">Phone Number</label>
                             <input form="orderUploadForm" type="text"
                                 class="form-control
                                        @error('phone')
                                        is-invalid
                                        @enderror"
                                 value="{{ Auth::user()->phone }}" id="phone" name="phone" placeholder="phone">
                             <div class=" invalid-feedback">
                                 @error('phone')
                                     {{ $message }}
                                 @enderror"
                             </div>
                         </div>

                         <div class="mb-3">
                             <label for="address" class="form-label">Address</label>
                             <textarea form="orderUploadForm" name="address"
                                 class="form-control
                                        @error('address')
                                        is-invalid
                                        @enderror"
                                 id="address" rows="3">{{ old('address') }}</textarea>
                             <div class=" invalid-feedback">
                                 @error('address')
                                     {{ $message }}
                                 @enderror"
                             </div>
                         </div>

                         <div class="d-flex align-items-center justify-content-between mb-3 py-3 border-bottom border-top">
                             <p class="text-dark mb-0">
                                 Total
                             </p>
                             <input type="hidden" id="price" class="hidden" value="{{ $product->price }}">
                             <p id="totalAmountShow" class="text-dark mb-0">
                                 {{ $product->price . ' Kyats' }}
                             </p>
                         </div>

                         <form id="orderUploadForm" action="{{ route('buyNowOrderUpload') }}" method="POST">
                             @csrf
                             <input type="hidden" name="product_id" value="{{ $product->id }}">
                             <input type="hidden" name="currentProductStock" id="currentProductStock"
                                 value="{{ $product->stock }}">
                             <input type="hidden" id="total_amount" name="total_amount" value="{{ $product->price }}">
                             <input type="hidden" name="qty" value="1" id="qtyInput">
                         </form>
                         <button form="orderUploadForm" class="w-100 btn btn-dark py-2">
                             PROCEED TO CHECKOUT
                         </button>

                     </div>
                 </div>
             </div>
         </div>
         @push('updateQty')
             @vite('resources/js/updateQty.js')
         @endpush
     </div>
 @endsection
