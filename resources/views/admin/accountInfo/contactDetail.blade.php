@extends('admin.layouts.master')
@section('title', 'Profile Detail Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Detail</h3>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-3 offset-1 image img-thumbnail shadow-sm">
                                    @if ($data->image == null)
                                        <img src="{{ asset('image/deafultProfile.jpg') }}" alt="{{ $data->name }}" />
                                    @else
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" />
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <h4 class=" mb-3"><i class="fa-solid fa-user mr-3"></i> {{ $data->name }}</h4>
                                    <h4 class=" mb-3"><i class="fa-solid fa-envelope mr-3"></i> {{ $data->email }}
                                    </h4>
                                    <p class="">{{ $data->message }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
