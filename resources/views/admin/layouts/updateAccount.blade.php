@extends('user.layouts.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <form action="{{ route('update#detail', $data->id) }}" method="post" novalidate="novalidate"
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
                                        @if ($data->image == null)
                                            <img class="w-100" src="{{ asset('image/deafultProfile.jpg') }}"
                                                alt="{{ $data->name }}" />
                                        @else
                                            <img class="w-100" src="{{ asset('storage/' . $data->image) }}"
                                                alt="{{ $data->name }}" />
                                        @endif
                                    </div>
                                    <!-- Profile picture help block-->
                                    <div class="my-3">
                                        <h4>Choose Profile Picture</h4>
                                    </div>
                                    <div class="form-group">
                                        <input id="cc-pament" name="image" type="file" class="form-control "
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
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Your Name"
                                            value="{{ old('name', $data->name) }}">
                                        @error('name')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Email"value="{{ old('email', $data->email) }}">
                                        @error('email')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Phone Number"value="{{ old('phone', $data->phone) }}">
                                        @error('phone')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="Male" @if ($data->gender == 'Male') selected @endif>Male
                                            </option>
                                            <option value="Female" @if ($data->gender == 'Female') selected @endif>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ old('address', $data->address) }}</textarea>
                                        @error('address')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="phone" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Phone Number"value="{{ old('role', $data->role) }}"
                                            disabled>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <span id="payment-button-amount" class=" text-primary">Save Change</span>
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
