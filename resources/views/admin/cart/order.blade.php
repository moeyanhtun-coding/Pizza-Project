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
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <form action="{{ route('status#search') }}" method="post">
                                @csrf
                                <div class=" d-flex justify-content-between align-items-center row">
                                    <div class="col-3 align-center mb-3">Status :
                                    </div>
                                    <div class="col-9 input-group mb-3 ">
                                        <select class="form-select" name="status" id="inputGroupSelect02">
                                            <option value="">All
                                            </option>
                                            <option value="0" @if (request('status') == '0') selected @endif>Pending
                                            </option>
                                            <option value="1" @if (request('status') == '1') selected @endif>Accept
                                            </option>
                                            <option value="2" @if (request('status') == '2') selected @endif>Reject
                                            </option>
                                        </select>
                                        <button type="submit" class="input-group-text btn btn-dark">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('product#list') }}" method="post">
                                @csrf
                                <div class=" d-flex justify-content-between align-items-center row">
                                    <div class="col-3">Search Key : <small class="text-danger">{{ request('key') }}</small>
                                    </div>
                                    <div class=" col-9 d-flex">
                                        <input class="form-control " type="text" name="key" id=""
                                            value="{{ request('key') }}">
                                        <button class="btn btn-dark">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="">
                                        <input type="hidden" class="orderID" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td><a
                                                href="{{ route('product#orderList', $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td class="total">{{ $o->total_price }} MMK</td>
                                        <td>
                                            <select name="status" id="" class="statusChange form-control">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                $data = $('#status').val();
                $.ajax({
                    type: "get",
                    url: "/order/list/status",
                    data: {
                        'status': $data
                    },
                    dataType: "json",
                    success: function(response) {

                        $list = ``
                        for ($i = 0; $i < response.length; $i++) {
                            $months = ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August',
                                'September', 'October', 'November', 'December'
                            ];
                            $dbDate = new Date(response[$i].created_at);
                            $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
                                "-" + $dbDate.getFullYear();

                            if (response[$i].status == 0) {
                                $statusMessage = `<select name="status" id="" class="statusChange form-control">
                                                <option value="0" selected >
                                                    Pending</option>
                                                <option value="1">
                                                    Accept</option>
                                                <option value="2">
                                                    Reject</option>
                                            </select>`
                            } else if (response[$i].status == 1) {
                                $statusMessage = `<select name="status" id="" class="statusChange form-control">
                                                <option value="0">
                                                    Pending</option>
                                                <option value="1" selected>
                                                    Accept</option>
                                                <option value="2">
                                                    Reject</option>
                                            </select>`
                            } else if (response[$i].status == 2) {
                                $statusMessage = `<select name="status" id="" class="statusChange form-control">
                                                <option value="0">
                                                    Pending</option>
                                                <option value="1" >
                                                    Accept</option>
                                                <option value="2" selected>
                                                    Reject</option>
                                            </select>`
                            }
                            $list += `<tr class="">
                                        <input type="hidden" class="orderID" value="${response[$i].id}">
                                        <td> ${response[$i].user_id }</td>
                                        <td> ${response[$i].user_name }</td>
                                        <td> ${response[$i].order_code }</td>
                                        <td> ${$finalDate} </td>
                                        <td class="total"> ${response[$i].total_price } MMK</td>
                                        <td> ${$statusMessage}</td>
                                    </tr>`;
                        }
                        $('#dataList').html($list)

                    }
                });
            });
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentId = $(this).parents('tr');
                $orderId = $parentId.find('.orderID').val();
                $data = {
                    'orderID': $orderId,
                    'status': $currentStatus
                }
                $.ajax({
                    type: "get",
                    url: "/order/status/change",
                    data: $data,
                    dataType: "json",
                });
            })
        })
    </script>
@endsection
