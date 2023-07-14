@extends('layouts.spmenu')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grades</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ADM</th>
                                    <th>Unit</th>
                                    <th>cat 1</th>
                                    <th>cat 2</th>
                                    <th>exam</th>
                                    <th>marks</th>
                                    <th>grade</th>
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
    </div>
</section>
@endsection