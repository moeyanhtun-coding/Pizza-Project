@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-12 ">
            <div class="col-lg-10 offset-1 table-responsive mb-5" style = "height: 60vh">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Product Order Code</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($historyData as $c)
                            <tr>
                                <td>{{ $c->created_at->format('F-j-Y') }}</td>
                                <td>{{ $c->order_code }}</td>
                                <td>{{ $c->total_price }} Kyats</td>
                                <td>
                                    @if ($c->status == 0)
                                        <div class="text-info">Pending</div>
                                    @elseif($c->status == 1)
                                        <div class="text-success">Success</div>
                                    @elseif($c->status == 2)
                                        <div class="text-danger">Reject</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $historyData->links() }}
                </div>
            </div>

        </div>

    </div>
@endsection
