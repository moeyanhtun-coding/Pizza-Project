@extends('admin.layouts.master')
@section('title', 'Category Create Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class=" d-flex justify-content-end">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">Category
                                List</button></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('create#list') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="categoryName" type="text" class="form-control"
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('categoryName')
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
