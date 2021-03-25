@extends('layouts.admin_analytics-master')



@section('content')
@if (session('status'))
    <div class="alert alert-success b-round mt-3 ">
        {{ session('status') }}
    </div>
@endif
@if (session('failed'))
<div class="alert alert-danger b-round  mt-3 ">
    {{ session('failed') }}
</div>
@endif
@if (session('delete'))
<div class="alert alert-warning b-round  mt-3">
    {{ session('delete') }}
</div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card m-5">
            <div class="card-body">
                <h4 class="mt-0 header-title">Create Class & Subject</h4>
                <p class="text-muted mb-3">Enter class and subject name <br>(class name type must be same for all same classes) </p> 
                <form action="create_subCodes" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="lable_class">Class</label>
                        <input class="form-control" type="text" placeholder="Enter Class" id="grade" name="grade" required>
                    </div>
                    <div class="form-group">
                        <label for="lable_subject">Subject</label>
                        <input class="form-control" type="text" placeholder="Enter subject" id="subject" name="subject" required>
                    </div>
                   
                    <button type="submit" class="btn btn-gradient-primary">Create</button>
                    <button type="button" class="btn btn-gradient-danger">Cancel</button>
                </form>                                           
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>
@endsection  