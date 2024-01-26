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
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>
                    @if (count($data) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $items)
                                        <tr class="shadow-sm">
                                            <td></td>
                                            <td>{{ $items->id }}</td>
                                            <td>
                                                @if ($items->image == null)
                                                    <img width="100px" class=" image img-thumbnail"
                                                        src="{{ asset('image/deafultProfile.jpg') }}" alt=""
                                                        srcset="">
                                                @else
                                                    <img width="100px" class=" image img-thumbnail"
                                                        src="{{ asset('storage/' . $items->image) }}" alt=""
                                                        srcset="">
                                                @endif
                                            </td>
                                            <input class="adminId" type="hidden" value="{{ $items->id }}">
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->email }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if ($items->id == Auth::User()->id)
                                                    @else
                                                        <select name="roleChange" class="role form-control text-dark"
                                                            id="">
                                                            <option value="user"
                                                                @if ($items->role == 'user') selected @endif>User
                                                            </option>
                                                            <option value="admin"
                                                                @if ($items->role == 'admin') selected @endif>
                                                                Admin</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('userList#view', $items->id) }}"><button
                                                            class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button></a>
                                                    <a href="{{ route('userList#edit', $items->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('userList#delete', $items->id) }}">
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
                        <div class=" mt-3">
                            {{ $data->links() }}
                        </div>
                    @else
                        <h3 class=" text-secondary text-center mt-4">There is no User !!!</h3>
                    @endif
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
            $('.role').change(function() {
                $parentNote = $(this).parents('tbody tr');
                $adminId = $parentNote.find('.adminId').val();
                $role = $parentNote.find('.role').val();
                $.ajax({
                    type: "get",
                    url: "/admin/role/change",
                    data: {
                        'id': $adminId,
                        'role': $role,
                    },
                    dataType: "json",
                });
                location.reload();
            })
        })
    </script>
@endsection
