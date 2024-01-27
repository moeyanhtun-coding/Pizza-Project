@extends('user.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" bg-dark px-3 py-1 d-flex align-items-center justify-content-between">
                            <label class=" text-primary mt-2" for="size-all">Pizza Categories</label>
                            <span
                                class="badge border border-primary  text-primary mt-1 text-primary">{{ count($categoryCounts) }}</span>
                        </div>
                        <hr>
                        <div class="custom-control  d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#home') }}" class=" text-dark"><label class=""
                                    for="size-1">All</label></a>

                        </div>
                        @foreach ($categoryCounts as $c)
                            <div class="custom-control  d-flex align-items-center justify-content-between mb-3">

                                <a href="{{ route('pizza#filter', $c->id) }}" class=" text-dark"><label class=""
                                        for="size-1">{{ $c->name }}</label></a>

                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('item#cart') }}">
                                    <button type="button" class=" rounded btn btn-primary position-relative">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('history#order') }}">
                                    <button type="button" class=" ms-4 rounded btn btn-dark position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History

                                    </button>
                                </a>

                            </div>
                            <div class="ml-2">
                                <div class=" btn-group">
                                    <select class=" rounded bg-dark text-primary form-control bg-" name="sorting"
                                        id="sortingOption">
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if (count($product) != 0)
                        <span class=" row" id="dataList">
                            @foreach ($product as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <a id="viewCount" href="{{ route('item#detail', $item->id) }}">
                                        <div class="product-item bg-light mb-4" id="myForm">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height: 220px"
                                                    src="{{ asset('storage/' . $item->image) }}" alt="">
                                            </div>
                                            <div class="text-center py-4">
                                                <h4>{{ $item->name }}</h4>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>{{ $item->price }} MMK</h5>
                                                </div>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </span>
                    @else
                        <div class=" text-center text-dark"> There is no Product !! </div>
                    @endif

                </div>
            </div>
            <div class="mt-3">
                {{ $product->links() }}
            </div>

            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection



@section('ScriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                if ($eventOption == 'asc') {

                    $.ajax({
                        type: "get",
                        url: "/user/ajax/pizza/list",
                        data: {
                            'status': 'asc'
                        },
                        dataType: "json",

                        success: function(response) {
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <a href="http://127.0.0.1:8000/user/pizza/detail/${response[$i] . id}">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 220px"
                                            src="{{ asset('storage/${response[$i].image}') }}" alt="">

                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} MMK</h5>
                                        </div>

                                    </div>
                                </div>
                                </a>
                            </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {

                    $.ajax({
                        type: "get",
                        url: "/user/ajax/pizza/list",
                        data: {
                            'status': 'desc'
                        },
                        dataType: "json",
                        success: function(response) {
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                      <a href="http://127.0.0.1:8000/user/pizza/detail/${response[$i] . id}">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 220px"
                                            src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} MMK</h5>
                                        </div>

                                    </div>
                                </div>
                                </a>
                            </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    });
                }
            })
        });
    </script>
@endsection
