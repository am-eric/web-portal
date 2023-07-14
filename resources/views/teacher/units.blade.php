@extends('layouts.tpmenu')

@section('content')
<!-- Main content -->
<section class="content">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @foreach($course as $item)
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Course name: {{ $item->course_name }}</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addUnitBackdrop{{ $item->course_id }}">
                            Add
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->units as $key => $unit)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $unit->unit_id }}</td>
                                <td>{{ $unit->unit_name }}</td>
                                <td>{{ $unit->unit_description }}</td>
                                <!-- Action dropdown -->
                                <td>
                                    <div class="col mb-3">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item " data-bs-toggle="modal" data-bs-target="#editUnitBackdrop{{ $unit->id }}" type="button">Edit</button>
                                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- <button type="submit" class="btn btn-danger btn-sm dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="return confirm('Are you sure you want to delete this course?')">
                                                        Delete
                                                    </button> -->
                                                    <button class="dropdown-item btn-danger" onclick="return confirm('Are you sure you want to delete this course?')" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- Add more columns as needed -->
                            </tr>

                            <!-- editUnit Modal -->
                            <div class="modal fade" id="editUnitBackdrop{{ $unit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <!-- form -->
                                                <form action="{{route('units.update', $unit->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method ('PUT')
                                                    <div class="row">
                                                    <input type="text" value="{{ $unit->id }}" id="idU" name="id">
                                                    <input type="text" value="{{ $unit->course_id }}" id name="course_id">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Unit ID</label>
                                                            <input type="text" value="{{ $unit->unit_id }}" class="form-control" name="unit_id" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Unit Name</label>
                                                            <input type="text" value="{{ $unit->unit_name }}" class="form-control" name="unit_name">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Unit description</label>
                                                            <textarea name="unit_description" rows="3" class="form-control">{{ $unit->unit_description }}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
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
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- addUnit Modal -->
    <div class="modal fade" id="addUnitBackdrop{{ $item->course_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- form -->
                        <form action="{{ route('units.store') }}" method="POST" enctype="multi-part/form-data">
                            @csrf
                            <div class="row">
                                <input type="text" value="{{ $item->course_id }}" name="course_id">
                                <div class="col-md-6 mb-3">
                                    <label for="">Unit ID</label>
                                    <input type="text" class="form-control" name="unit_id" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Unit Name</label>
                                    <input type="text" class="form-control" name="unit_name">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Unit description</label>
                                    <textarea name="unit_description" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Available slots</label>
                                    <input type="text" class="form-control" name="available_slots">
                                </div>
                            </div>
                            <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                    <!-- /form -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.addUnit Modal -->
    @endforeach
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection