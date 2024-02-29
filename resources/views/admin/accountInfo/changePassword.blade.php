@extends('admin.layouts.master')
@section('title', 'Password Change Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Your Password</h3>
                            </div>
                            @if (session('success'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show justify-center mt-4 "
                                        role="alert">
                                        <small>{{ session('success') }}</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @else
                                @if (session('notMatch'))
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show justify-center mt-4 "
                                            role="alert">
                                            <small>{{ session('notMatch') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <hr>
                            <form action="{{ route('change#password') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"
                                        class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Old Password">
                                    @error('oldPassword')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @if (session('notMatch')) is-invalid @endif @error('newPassword') is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="New Password">
                                    @error('newPassword')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password"
                                        class="form-control  @if (session('notMatch')) is-invalid @endif @error('confirmPassword') is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                    @error('confirmPassword')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Save Change</span>
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
