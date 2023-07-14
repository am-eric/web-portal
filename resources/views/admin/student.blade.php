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
                    Students
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
                                <th>Admission number</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        @foreach ($students as $student)
                        <tr>
                                <th scope="row" style="color: #666666;">{{$student->admission_number}}</th>
                                <td>{{$student->name}}</td>
                            </tr>
                        @endforeach
                        <tbody>
                </div>

@endsection