@extends('layouts.spmenu')


@section('content')
<section class="content">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row">
        @foreach($course as $item)
        <div class="col-md-6">
            <div class="card mb-3">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-header">
                    <h4 class="card-title">Course name: {{ $item->course_name }}</h4>
                    <div class="card-tools">
                        <a href="#" class="btn-link float-right" data-toggle="modal" data-target="#viewUnitsModal{{ $item->id }}">View units</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $item->course_description }}</p>
                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{auth()->user()->name}}">
                        <input type="hidden" name="course_id" value="{{ $item ->course_id }}">
                        <button type="submit" class="btn btn-primary">Enroll</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Units Modal -->
        <div class="modal fade" id="viewUnitsModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewUnitsModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewUnitsModalLabel{{ $item->id }}">View Units</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 10px">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection