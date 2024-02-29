@extends('admin.layouts.master')
@section('title', 'Product Create Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class=" d-flex justify-content-end">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">Pizza
                                List</button></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="productName" type="text" class="form-control"
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('productName')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea class=" form-control" name="productDescription" id="" cols="30" rows="10"></textarea>
                                    @error('productDescription')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1"> Category</label>
                                    <select name="productCategory" class="form-control">
                                        <option value="">Choose Category....
                                        </option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="productImage" type="file" class="form-control"
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('productImage')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="productPrice" type="number" class="form-control"
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('productPrice')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
