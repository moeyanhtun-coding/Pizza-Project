@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">

        <div class="" style="margin-left: 50px;">
            <button onclick="history.back()" class="col-1 btn btn-primary text-dark mb-2">Back</button>
        </div>

        <div class="row px-xl-5">

            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-item active">

                        <img class="img img-thumbnail w-100 h-100" src="{{ asset('storage/' . $data->image) }}"
                            alt="Image">
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $data->name }}</h3>
                    <input type="text" id="pizzaId" value="{{ $data->id }}" hidden>
                    <input type="text" id="userId" value="{{ Auth::user()->id }}" hidden>

                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $data->price }} MMK</h3>
                    <p class="mb-4">{{ $data->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="productCount" class="form-control bg-secondary border-0 text-center"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="cartButton"><i class="fa fa-shopping-cart mr-1"></i>
                            Add To
                            Cart</button>

                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $d)
                        <div class="product-item bg-light">

                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 220px" src="{{ asset('storage/' . $d->image) }}"
                                    alt="">
                                {{-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" id="cartButton"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('item#detail', $d->id) }}"><i
                                            class="fa-solid fa-exclamation"></i></a>
                                </div> --}}
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $d->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $d->price }} MMK</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- Products End -->
@endsection
@section('ScriptSource')
    <script>
        $(document).ready(function() {
            $('#cartButton').click(function() {
                $data = {
                    'userID': $('#userId').val(),
                    'pizzaID': $('#pizzaId').val(),
                    'productCount': $('#productCount').val()
                }
                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/addToCart",
                    data: $data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = 'http://127.0.0.1:8000/user/home';
                        }
                    }
                });
            })

        });
    </script>
@endsection
