@extends('user.layouts.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <form action="{{ route('contactUs#send') }}" method="POST" novalidate="novalidate"
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" row">
                        <div class=" offset-2 col-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Contact Us</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Your Name"
                                            value="">
                                        @error('name')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control "
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Email"value="">
                                        @error('email')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Message</label>
                                        <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                                        @error('message')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <span id="payment-button-amount" class=" text-primary">Send</span>
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
