@extends('layouts.tpmenu')

@section('content')

<!-- Main content -->
<section class="content">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row">
        @foreach($course as $item)
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Marks </h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addGradesBackdrop{{ $item->course_id }}">
                            Add
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ADM </th>
                                <th>unit_id</th>
                                <th>cat 1 </th>
                                <th>cat 2 </th>
                                <th>Exam </th>
                                <th>Marks </th>
                                <th>Grade </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                            <tr>
                                <td>{{ $grade->admission_number }}</td>
                                <td>{{ $grade->unit_id }}</td>
                                <td>{{ $grade->cat1 }}</td>
                                <td>{{ $grade->cat2 }}</td>
                                <td>{{ $grade->exam }}</td>
                                <td>{{ $grade->marks }}</td>
                                <td>{{ $grade->grade }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- addUnit Modal -->
    <div class="modal fade" id="addGradesBackdrop{{ $item->course_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Grades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <!-- form -->
                        <form action="{{ route('grades.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="admission_number">Admission Number</label>
                                    <select name="admission_number" id="select-unit" class="form-control" required>
                                        <option value="">Select Admission Number</option>
                                        <!-- Add options dynamically based on your data -->
                                        @foreach($enrollments as $enrollment)
                                        @if($item->course_id == $enrollment->course_id)
                                        <option value="{{$enrollment->admission_number}}"> {{$enrollment->admission_number}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="unit_id">Unit ID</label>
                                    <select name="unit_id" id="select-unit" class="form-control" required>
                                        <option value="">Select Unit ID</option>
                                        @foreach($item->units as $unit)
                                        <option value="{{ $unit->unit_id }}">{{ $unit->unit_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cat1">CAT 1</label>
                                    <input type="text" class="form-control" name="cat1" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cat2">CAT 2</label>
                                    <input type="text" class="form-control" name="cat2" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exam">Exam</label>
                                    <input type="text" class="form-control" name="exam" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marks">Marks</label>
                                    <input type="hidden" class="form-control" name="marks" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="grade">Grade</label>
                                    <input type="hidden" class="form-control" name="grade" required>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>

                        <!-- /form -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endsection