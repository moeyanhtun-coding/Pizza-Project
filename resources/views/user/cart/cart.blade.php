@extends('user.layouts.master')

@section('content')

    <body>
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="#">Home</a>
                        <a class="breadcrumb-item text-dark" href="#">Shop</a>
                        <span class="breadcrumb-item active">Shopping Cart</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->


        <!-- Cart Start -->

        @if (count($cartList) != 0)
            <div class="container-fluid">
                <div class="row px-xl-5">
                    <div class="col-lg-8 table-responsive mb-5">
                        <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($cartList as $c)
                                    <tr>
                                        <td><img class=" img img-thumbnail me-3" src="{{ asset('storage/' . $c->image) }}"
                                                alt="" style="width: 50px;"></td>
                                        <td class="align-middle">{{ $c->pizzaName }}
                                            <input type="text" value="{{ $c->product_id }}" hidden class="productID">
                                            <input type="text" value="{{ $c->user_id }} " hidden class="userID">
                                            <input type="text" value="{{ $c->id }}" hidden class="orderID">
                                        </td>
                                        <td id="price" class="align-middle">{{ $c->pizzaPrice }} Kyats</td>
                                        <td class="align-middle">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" id="itemQty"
                                                    class="form-control form-control-sm bg-secondary border-0 text-center"
                                                    value="{{ $c->qty }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle" id="total">{{ $c->pizzaPrice * $c->qty }} Kyats</td>
                                        <td class="align-middle"><button class="btn btn-danger deleteBtn"><i
                                                    class="fa fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                                Summary</span></h5>
                        <div class="bg-light p-30 mb-5">
                            <div class="border-bottom pb-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6>Subtotal</h6>
                                    <h6 id="subTotal">{{ $totalPrice }} Kyats</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Delivery</h6>
                                    <h6 class="font-weight-medium">3000 Kyats</h6>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    <h5 id="totalPrice">{{ $totalPrice + 3000 }} Kyats</h5>
                                </div>
                                <button type="button" id="checkout"
                                    class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed
                                    To
                                    Checkout</button>
                                <button type="button" id="orderCancel"
                                    class="btn btn-block btn-danger text-primary font-weight-bold my-3 py-3">Order
                                    Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h6 class=" text-center text-dark">There're no products at cart list !!</h6>
        @endif
        <!-- Cart End -->
    @endsection

    @section('ScriptSource')
        <script>
            $(document).ready(function() {
                // plus button
                $('.btn-plus').click(function() {
                    $parentNote = $(this).parents("tbody tr");
                    $price = Number($parentNote.find('#price').text().replace('Kyats', ''));
                    $qty = $parentNote.find('#itemQty').val();

                    $total = $price * $qty;
                    $parentNote.find('#total').html($total + " Kyats");
                    summaryCalculation()
                })
                // minus button
                $('.btn-minus').click(function() {
                    $parentNote = $(this).parents("tbody tr");
                    $price = Number($parentNote.find('#price').text().replace('Kyats', ''));
                    $qty = $parentNote.find('#itemQty').val();
                    $total = $price * $qty;
                    $parentNote.find('#total').html($total + " Kyats");
                    summaryCalculation()
                })

                // delete Button do delete row of card list
                $('.deleteBtn').click(function() {

                    $parentNote = $(this).parents('tbody tr');
                    $orderId = $parentNote.find('.orderID').val();
                    $productId = $parentNote.find('.productID').val();

                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/user/ajax/row/delete",
                        data: {
                            'orderID': $orderId,
                            'productID': $productId,
                        },
                        dataType: "json",
                        success: function(response) {

                        }
                    });
                    $parentNote.remove()
                    summaryCalculation()
                })

                // summary calculation of totalPrice method
                function summaryCalculation() {
                    $totalPrice = 0;
                    $('#dataTable tbody tr').each(function(index, row) {
                        $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));
                    });
                    $('#subTotal').html($totalPrice + ' Kyats')
                    $('#totalPrice').html(($totalPrice + 3000) + ' Kyats')
                }

                // check out button to order confirm
                $('#checkout').click(function() {
                    $orderList = []
                    $orderCode = Math.floor(Math.random() * 100000001)
                    $('#dataTable tbody tr').each(function(index, row) {
                        $orderList.push({
                            'product_id': $(row).find('.productID').val(),
                            'user_id': $(row).find('.userID').val(),
                            'qty': $(row).find('#itemQty').val(),
                            'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                            'order_code': '0' + 'POS' + $orderCode
                        })
                    })
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/user/ajax/order",
                        data: Object.assign({}, $orderList),
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 'true') {
                                window.location.href = 'http://127.0.0.1:8000/user/home';
                            }
                        }
                    });
                })

                // order cancel button
                $('#orderCancel').click(function() {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/user/ajax/order/cancel",
                        dataType: "json"

                    });
                    $('#dataTable tbody tr').remove()
                    $('#subTotal').html('0 Kyats')
                    $('#totalPrice').html('3000 Kyats')
                })
            })
        </script>
    @endsection
