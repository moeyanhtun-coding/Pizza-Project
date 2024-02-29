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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('create#page') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <form action="{{ route('product#list') }}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-between align-items-center row">
                                <div class=" col-6">Search Key : <small class="text-danger">{{ request('key') }}</small>
                                </div>
                                <div class="d-flex col-4 offset-2">
                                    <input class="form-control " type="text" name="key" id=""
                                        value="{{ request('key') }}">
                                    <button class="btn btn-dark">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        @if (session('DeleteSuccess'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show justify-center mt-4 "
                                    role="alert">
                                    <small>{{ session('DeleteSuccess') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Pizza Name</th>
                                    <th>Pizza Category</th>
                                    <th>View Count</th>
                                    <th>Price</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData as $d)
                                    <tr class="">
                                        <td class="">
                                            <img class=" image img-thumbnail" width="120px"
                                                src="{{ asset('storage/' . $d->image) }}" alt="" srcset="">
                                        </td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->category_name }}</td>
                                        <td><i class="fa-solid fa-eye"></i> {{ $d->view_count }}</td>
                                        <td>{{ $d->price }} MMK</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('detail#page', $d->id) }}"><button class="item me-1"
                                                        data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button></a>
                                                <a href="{{ route('edit#page', $d->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete', $d->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $productData->links() }}</div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
