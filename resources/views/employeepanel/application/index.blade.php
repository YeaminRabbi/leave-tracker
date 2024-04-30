@extends('layouts.adminpanel.master')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
       
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Leave Application /</span> list</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('leave-application.create') }}">
                    <button class="btn btn-info rounded-pill">Add Leave Application</button>
                </a>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">

            <div class="table-responsive text-nowrap p-4">
                <table class="table" id="DataTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Type</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($applications->isNotEmpty())
                            @foreach ($applications as $key => $data)
                               
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->type.' LEAVE' }}</td>
                                    <td>{{ date('d M, Y', strtotime($data->start_date)) }}</td>
                                    <td>{{ date('d M, Y', strtotime($data->end_date)) }}</td>
                                    <td>
                                        @if ($data->status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($data->status == 1)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($data->status == -1)
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('leave-application.show', $data->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->



    </div>
@endsection

@section('header_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('footer_js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#notificationAlert').delay(3000).fadeOut('slow');
        $(document).ready(function() {
            $('#DataTable').DataTable();
        });
    </script>
@endsection
