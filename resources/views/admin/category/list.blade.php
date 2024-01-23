@extends('admin.layouts.master')
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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <form action="{{ route('category#list') }}" method="GET">
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
                            <div id="myAlert" class="alert alert-warning alert-dismissible fade show float-right col-3 "
                                role="alert">
                                <small>{{ session('DeleteSuccess') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    @if (count($category) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>category Name</th>
                                        <th>create Date</th>
                                        <th> Total - {{ $category->total() }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 0;
                                    @endphp
                                    @foreach ($category as $items)
                                        <tr class="shadow-sm">
                                            <td>@php
                                                $id = $id + 1;
                                            @endphp {{ $id }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    <a href="{{ route('category#edit', $items->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $items->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
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
                    @else
                        <h3 class=" text-secondary text-center mt-4">There is no category !!!</h3>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
