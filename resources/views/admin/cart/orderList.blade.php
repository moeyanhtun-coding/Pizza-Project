@extends('admin.layouts.master')
@section('title', 'Products List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="row col-5">
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <h3>Order Info</h3>
                                    <small class=" text-success">Include Delivery Charges</small>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col"><i class="me-2 fa-solid fa-user"></i> Username</div>
                                        <div class="col">{{ strtoupper($order[0]->user_name) }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><i class="me-2 fa-solid fa-barcode"></i> Order Code</div>
                                        <div class="col">{{ $order[0]->order_code }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><i class="me-2 fa-solid fa-calendar-days"></i> Order Date</div>
                                        <div class="col">{{ $order[0]->created_at->format('F-j-y') }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col"><i class="me-2 fa-solid fa-money-bill"></i> Total Charges</div>
                                        <div class="col">{{ $totalPrice->total_price }} Kyats</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Imge</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="">
                                        <td></td>
                                        <td>{{ $o->id }}</td>
                                        <td><img style="width:100px" class="img img-thumbnail"
                                                src="{{ asset('storage/' . $o->productImage) }}" alt=""></td>
                                        <td>{{ $o->productName }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }} Kyats</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
