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
                    Courses
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addBackdrop">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    <!-- table to show courses from database -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Description</th>
                                <th>Lecturer ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course as $item)
                            <tr>
                                <th scope="row" style="color: #666666;">{{$item->course_id}}</th>
                                <td>{{$item->course_name}}</td>
                                <td>{{$item->course_description}}</td>
                                <td>{{$item->lecturer_id}}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#editBackdrop{{ $item->id }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('courses.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-rounded" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- edit Modal -->
                            <div class="modal fade" id="editBackdrop{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <!-- form -->
                                                <form action="{{route('courses.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Course ID</label>
                                                            <input type="text" value="{{ $item->course_id }}" class="form-control" name="course_id" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Course Name</label>
                                                            <input type="text" value="{{ $item->course_name }}" class="form-control" name="course_name">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="">Course description</label>
                                                            <textarea name="course_description" rows="3" class="form-control">{{ $item->course_description }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="" class="form-label">Lecturer Name</label>
                                                            <select class="form-select" name="name">
                                                                <option>Select</option>
                                                                @foreach($teachers as $teacher)
                                                                <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                                                @endforeach
                                                            </select>
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
                            <!-- end modal -->
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- form -->
                        <form action="{{route('courses.store')}}" method="POST" enctype="multi-part/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Course ID</label>
                                    <input type="text" class="form-control" name="course_id" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Course Name</label>
                                    <input type="text" class="form-control" name="course_name">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Course description</label>
                                    <textarea name="course_description" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Lecturer Name</label>
                                    <select class="form-select" name="name">
                                        <option>Select</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection