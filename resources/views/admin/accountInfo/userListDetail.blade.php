@extends('admin.layouts.master')
@section('title', 'User Detail Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"> User Account Detail</h3>
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
                                    <h4 class=" mb-3"><i class="fa-solid fa-phone mr-3"></i> {{ $data->phone }}</h4>
                                    <h4 class="mb-3"><i class="fa-solid fa-venus-mars mr-3"></i>
                                        {{ $data->gender }}
                                    </h4>
                                    <h4 class=" mb-3"><i class="fa-solid fa-map-location-dot mr-3"></i>
                                        {{ $data->address }}</h4>
                                    <h4 class=" "><i class="fa-solid fa-calendar-days mr-3"></i>
                                        {{ $data->created_at->format('j-F-Y') }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-4 offset-1 mt-3">
                                        <a href="{{ route('userList#edit', $data->id) }}"><button
                                                class="float-start btn btn-dark text-white"> Edit
                                                Profile</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
