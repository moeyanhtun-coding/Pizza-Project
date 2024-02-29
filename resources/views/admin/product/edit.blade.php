@extends('admin.layouts.master')
@section('title', 'Password Change Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <form action="{{ route('update#page', $product->id) }}" method="post" novalidate="novalidate"
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" row">
                        <div class="col-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header"><i class="fa-solid fa-left-long me-2"></i>
                                    <a class=" text-decoration-none text-dark" href="{{ route('product#list') }}">Back</a>
                                </div>
                                <div class="card-body">
                                    <!-- Profile picture image-->
                                    <div class="image img-thumbnail shadow-sm">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                    </div>
                                    <!-- Profile picture help block-->
                                    <div class="my-3">
                                        <h4>Pizza Image</h4>
                                    </div>
                                    <div class="form-group">
                                        <input id="cc-pament" name="productImage" type="file" class="form-control "
                                            aria-required="true" aria-invalid="false">
                                        @error('image')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Profile picture upload button-->
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-pizza-slice me-3 "></i>Pizza Name</label>
                                        <input id="cc-pament" name="productName" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Your productName"
                                            value="{{ old('productName', $product->name) }}">
                                        @error('productName')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-file me-3"></i>Description</label>
                                        <textarea class=" form-control" name="productDescription" id="" cols="30" rows="10">{{ old('productDescription', $product->description) }}</textarea>
                                        @error('productDescription')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-layer-group me-3 "></i>Category</label>
                                        <select name="productCategory" class="form-control">
                                            <option value="">Choose Category....
                                            </option>
                                            @foreach ($category as $c)
                                                <option
                                                    value="{{ $c->id }} "@if ($c->id == $product->category_id) selected @endif>
                                                    {{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('productCategory')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-money-bill-1-wave me-3 "></i>Price</label>
                                        <input id="cc-pament" name="productPrice" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Your productName"
                                            value="{{ old('productPrice', $product->price) }}">
                                        @error('productPrice')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-eye me-3 "></i>View Count</label>
                                        <input id="cc-pament" name="view_count" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" disabled
                                            value="{{ old('view_count', $product->view_count) }}">
                                        @error('view_count')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i
                                                class="fa-solid fa-clock me-3 "></i>Created Date</label>
                                        <input id="cc-pament" name="created_at" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" disabled
                                            value="{{ old('created_at', $product->created_at->format('j-F-Y')) }}">
                                        @error('created_at')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Save Change</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
