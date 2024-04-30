@extends('layouts.adminpanel.master')

@section('content')    
<div class="container-xxl flex-grow-1 container-p-y">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Leave Application / </span> Create</h4>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Leave Application Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('leave-application.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 form-label">Application Type <span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" id="type" name="type" required>
                                    <option selected disabled>--select type--</option>
                                    <option value="CASUAL">Casual Leave</option>
                                    <option value="SICK">Sick Leave</option>
                                    <option value="EMERGENCY">Emergency Leave</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-start_date">Start Date <span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="basic-default-start_date" name="start_date"/>
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-End_date">End Date <span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="basic-default-End_date" name="end_date"/>
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-Reason">Reason <span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>  
                        

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="{{ route('leave-application.index') }}" class="btn btn-dark btn-sm">Back to List</a>
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
        .create( document.querySelector( '#basic-default-editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    $('#notificationAlert').delay(3000).fadeOut('slow');
</script>
@endsection