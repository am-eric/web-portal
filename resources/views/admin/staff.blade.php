@extends('layouts.apmenu')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    Staff
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addStaffBackdrop">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    <!-- table to show courses from database -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Staff Name</th>
                                <th>email</th>
                                <th>password</th>
                                <th>Staff role</th>
                                <th>phone</th>
                                <th>department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff as $staffMember)
                            <tr>
                                <th scope="row" style="color: #666666;">{{$staffMember->staff_id}}</th>
                                <td>{{$staffMember->name}}</td>
                                <td>{{$staffMember->email}}</td>
                                <td>*******</td>
                                <td>{{$staffMember->role}}</td>
                                <td>{{$staffMember->phone}}</td>
                                <td>{{$staffMember->department}}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#editStaffBackdrop{{$staffMember->staff_id}}">
                                        Edit
                                    </a>
                                    <form action="{{ route('staff.destroy', $staffMember->staff_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-rounded" onclick="return confirm('Are you sure you want to delete this staff?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit staff Modal  -->
                            <div class="modal fade" id="editStaffBackdrop{{ $staffMember->staff_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <!-- form -->
                                                <form action="{{route('staff.update', $staffMember->staff_id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Staff ID</label>
                                                            <input type="text" value="{{$staffMember->staff_id}}" class="form-control" name="staff_id" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Staff Name</label>
                                                            <input type="text" value="{{$staffMember->name}}" class="form-control" name="name">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">email</label>
                                                            <input type="email" value="{{$staffMember->email}}" class="form-control" name="email">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">password</label>
                                                            <input type="password" value="password" class="form-control" name="password">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Staff Role</label>
                                                            <input type="text" value="{{$staffMember->role}}" class="form-control" name="role">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Phone </label>
                                                            <input type="number" value="{{$staffMember->phone}}" class="form-control" name="phone">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Department </label>
                                                            <input type="text" value="{{$staffMember->department}}" class="form-control" name="department">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addStaffBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <!-- form -->
                    <form action="{{url('staff')}}" method="POST" enctype="multi-part/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Staff ID</label>
                                <input type="text" class="form-control" name="staff_id" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Staff Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Staff Role</label>
                                <input type="text" class="form-control" name="role">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone </label>
                                <input type="number" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Department </label>
                                <input type="text" class="form-control" name="department">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection