@extends('admin.layouts.master')
@section('title', 'Password Change Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class=" row">
                    <div class="col-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header" onclick="history.back()"><i class="fa-solid fa-left-long me-2"></i> Back
                            </div>
                            <div class="card-body">
                                <!-- Profile picture image-->
                                <div class="image img-thumbnail shadow-sm">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Pizza Details</div>
                            <div class="card-body">
                                <span class="btn btn-dark mb-2 me-1"><i class="fa-solid fa-pizza-slice me-3 "></i>
                                    {{ $product->name }}</span>
                                <span class="btn btn-dark mb-2 me-1"><i class="fa-solid fa-money-bill-1-wave me-3 "></i>
                                    {{ $product->price }} Kyats</span>
                                <span class="btn btn-dark mb-2 me-1"><i class="fa-solid fa-eye me-3 "></i>
                                    {{ $product->view_count }}</span>
                                <span class="btn btn-dark mb-2 me-1"><i class="fa-solid fa-layer-group me-3 "></i>
                                    {{ $product->category_name }}</span>
                                <span class="btn btn-dark mb-2 me-1"><i class="fa-solid fa-clock me-3 "></i>
                                    {{ $product->created_at->format('j-F-Y') }}</span>
                                <div class=""><i class="fa-solid fa-file me-3"></i> Details</div>
                                <div>{{ $product->description }}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
