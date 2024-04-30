@extends('layouts.adminpanel.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
       
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Leave Application / </span> Show</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Leave Application Information</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Employee Name </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-name" name="user_name"
                                    value="{{ $leaveApplication->user->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-type">Application Type </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-type" name="type"
                                    value="{{ $leaveApplication->type.' LEAVE' }}" disabled />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-start_date">Start Date </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="basic-default-start_date" name="start_date"
                                    value="{{ $leaveApplication->start_date }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-End_date">End Date </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="basic-default-End_date" name="end_date"
                                    value="{{ $leaveApplication->end_date }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-Reason">Reason </label>
                            <div class="col-sm-10">
                                <textarea name="reason" class="form-control" cols="30" rows="10" disabled>{{ $leaveApplication->reason }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-status">Application Status </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-status" name="status"
                                @if ($leaveApplication->status == 0)
                                    value="Pending"
                                @elseif ($leaveApplication->status == 1)
                                    value="Approved"
                                @elseif ($leaveApplication->status == -1)
                                    value="Rejected"
                                @endif    
                                
                                
                                 disabled />
                            </div>
                        </div>

                        @if ($leaveApplication->comment)
                            <hr>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-comment">Comment <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="comment" class="form-control" cols="30" rows="10" disabled>{{ $leaveApplication->comment }}</textarea>
                                </div>
                            </div>

                        @else
                            <hr>
                            <form action="{{ route('admin.applications.edit.form', $leaveApplication->id) }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-2 form-label">Application Status <span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="" selected disabled>--select status--</option>
                                            <option value="1">Approved</option>
                                            <option value="-1">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-comment">Comment </label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" class="form-control" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                            
                        @endif


                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-success">Update Status</button>
                                <a href="{{ route('admin.applications') }}" class="btn btn-dark btn-sm">Back to
                                    List</a>
                            </div>
                        </div>
                    </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection

@section('footer_js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#basic-default-editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $('#notificationAlert').delay(3000).fadeOut('slow');
    </script>
@endsection
