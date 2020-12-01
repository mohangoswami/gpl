@extends('layouts.admin_analytics-master')



@section('content')
@if (session('status'))
    <div class="alert alert-success b-round  mt-3 " >
        {{ session('status') }}
    </div>
@endif
@if (session('failed'))
<div class="alert alert-danger b-round  mt-3 ">
    {{ session('failed') }}
</div>
@endif
<div class="row">
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <h2>Create New Work</h2>
                       
                            <p class="text-muted mb-3">Basic example to demonstrate Bootstrap’s form styles.</p> 
                            <form method="POST" action="{{ route('admin.postFlashNews') }}" enctype="multipart/form-data">
                                @csrf
                           
                              <div >

                              
                                <div class="form-group">
                                    <label for="pdfUpload">Create flash news</label>
                                    <input name="inputNews" class="form-control" type="text" placeholder="Enter news here" id="inputNews" required>
                                </div>
                        
                                <button type="submit"  class="btn btn-gradient-primary">Submit</button>
                                <button type="button" class="btn btn-gradient-danger">Cancel</button>
                            </form> 
                           
                                  
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

        </div><!--end card-body-->
    </div><!--end card-->
</div><!--end col-->
</div><!--end row-->
@stop
