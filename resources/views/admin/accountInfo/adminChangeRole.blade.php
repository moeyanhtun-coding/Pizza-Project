@extends('admin.layouts.master')
@section('title', 'Password Change Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="">
                    <a class=" text-dark" href="{{ route('account#list') }}">
                        <i class="fa-solid fa-left-long me-2"></i> back
                    </a>
                </div>
                <form action="{{ route('change#role', $accountInfo->id) }}" method="post" novalidate="novalidate"
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" row">
                        <div class="col-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body">
                                    <!-- Profile picture image-->
                                    <div class="image img-thumbnail shadow-sm">
                                        @if ($accountInfo->image == null)
                                            <img src="{{ asset('image/deafultProfile.jpg') }}"
                                                alt="{{ $accountInfo->name }}" />
                                        @else
                                            <img src="{{ asset('storage/' . $accountInfo->image) }}"
                                                alt="{{ $accountInfo->name }}" />
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <input id="cc-pament" name="id" type="text" class="form-control "
                                        aria-required="true" aria-invalid="false" placeholder="Enter Your Name"
                                        value="{{ old('id', $accountInfo->id) }}" hidden>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Your Name"
                                            value="{{ old('name', $accountInfo->name) }}" disabled>
                                        @error('name')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Email"value="{{ old('email', $accountInfo->email) }}"
                                            disabled>
                                        @error('email')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Phone Number"value="{{ old('phone', $accountInfo->phone) }}"
                                            disabled>
                                        @error('phone')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control" disabled>
                                            <option value="Male" @if ($accountInfo->gender == 'Male') selected @endif>Male
                                            </option>
                                            <option value="Female" @if ($accountInfo->gender == 'Female') selected @endif>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea class="form-control" name="address" id="" cols="30" rows="10" disabled>{{ old('address', $accountInfo->address) }}</textarea>
                                        @error('address')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="Admin" @if ($accountInfo->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="User" @if ($accountInfo->role == 'user') selected @endif>User
                                            </option>
                                        </select>
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
