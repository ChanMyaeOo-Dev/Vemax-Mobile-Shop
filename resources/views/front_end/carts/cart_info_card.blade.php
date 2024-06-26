 <div class="col-md-8">
     <div class="bg-white border border-1 rounded p-4 h-100">
         <div class="d-flex align-items-baseline mb-3 pb-3 border-bottom">
             <p class="text-primary fw-bold fs-4 mb-0">
                 My Cart
             </p>
         </div>
         @foreach ($carts as $cart)
             <div class="card border-0 border-bottom mb-4">
                 <div class="card-body">
                     <div class="d-flex justify-content-between">

                         <div class="d-flex">
                             <img src="{{ asset('storage/' . $cart->product->featured_image) }}" height="180px"
                                 width="180px" class=" object-fit-cover rounded me-4">
                             <div class="menu_info_box">
                                 <p class="mb-0 text-dark fw-bold fs-5">{{ $cart->product->title }}</p>
                                 <div class="d-flex align-items-center small">
                                     <i class=" text-black-50 bi bi-star-fill"></i>
                                     <i class=" text-black-50 bi bi-star-fill"></i>
                                     <i class=" text-black-50 bi bi-star-fill"></i>
                                     <i class=" text-black-50 bi bi-star-fill"></i>
                                     <i class=" text-black-50 bi bi-star-half"></i>
                                 </div>
                                 <p class="mb-3 text-black-50">{{ Str::words($cart->product->description, 10, '...') }}
                                 </p>
                                 <p class="mb-0 text-dark fw-bold fs-5">{{ $cart->product->price }} Kyats</p>
                                 <p class="text-black-50 fs-6 mb-0">
                                     {{ $cart->product->stock . ' items left.' }}
                                 </p>
                                 {{-- Qty Update --}}
                                 <button id="loading_btn{{ $cart->id }}"
                                     class="btn btn-light mt-2 d-none align-items-center justify-content-center gap-1"
                                     type="button" disabled>
                                     <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                     <span role="status">Loading...</span>
                                 </button>
                                 <div id="update_div{{ $cart->id }}" class="d-inline-flex border rounded mt-2"
                                     style="height: 40px;">
                                     <form id="cart_form{{ $cart->id }}" class="cartUpdateForm"
                                         action="{{ route('carts.update', $cart->id) }}" method="POST">
                                         @csrf
                                         @method('PUT')
                                         <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                         <input type="hidden" name="updateAction"
                                             id="updateAction{{ $cart->id }}">
                                         <!-- No initial value set -->
                                     </form>
                                     <button id="btnUpdateCartMinus{{ $cart->id }}" type="button"
                                         onclick="updateCart('{{ $cart->id }}', 'minus')"
                                         class="btn btn-light h-100 rounded-end-0">
                                         <i class="fas fa-minus fa-xs text-black-50"></i>
                                     </button>
                                     <div class="d-flex align-items-center justify-content-center px-4">
                                         <p id="currentCartCount{{ $cart->id }}" class="mb-0 fw-bold">
                                             {{ $cart->qty }}
                                         </p>
                                     </div>
                                     <button id="btnUpdateCartPlus{{ $cart->id }}" type="button"
                                         onclick="updateCart('{{ $cart->id }}', 'plus')"
                                         class="btn btn-light h-100 rounded-start-0">
                                         <i class="fas fa-plus fa-xs text-black-50"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>

                         <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                             @csrf
                             @method('DELETE')
                             <button class="btn btn-light text-black-50">
                                 <i class="fas fa-times"></i>
                             </button>
                         </form>

                     </div>
                 </div>
             </div>
         @endforeach
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

                 <div class="mb-3 d-flex flex-column">
                     <label class="form-label">City</label>
                     <select
                         class="w-100 my_select form-control
                                @error('address')
                                is-invalid
                                @enderror"
                         name="city">
                         <option value="1">Yangon</option>
                         <option value="2">Mandalay</option>
                         <option value="3">Ayeyarwady</option>
                     </select>
                     <div class=" invalid-feedback">
                         @error('address')
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
                         Total Cost
                     </p>
                     <p id="totalAmount" class="text-dark mb-0">
                         {{ $totalCost . ' Kyats' }}
                     </p>
                 </div>

                 <form id="orderUploadForm" action="{{ route('orders.store') }}" method="POST">
                     @csrf
                     <input type="hidden" name="total_amount" id="fromTotalAmount" value="{{ $totalCost }}">
                 </form>
                 <button form="orderUploadForm" class="w-100 btn btn-dark py-2">
                     PROCEED TO CHECKOUT
                 </button>

             </div>
         </div>
     </div>
 </div>
 @push('editCart')
     @vite('resources/js/editCart.js')
 @endpush
