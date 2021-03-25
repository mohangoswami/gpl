@extends('layouts.admin_analytics-master')

@section('headerStyle')
<link href="{{ URL::asset('plugins/footable/css/footable.bootstrap.css')}}" rel="stylesheet" type="text/css">
@stop



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
                <h3>Edit Live Class</h3>
                @foreach ($users as $user)
                <h4 class="mt-0 header-title">Name- {{$user->name}} Class- {{$user->class}}</h4>
                <p class="text-muted mb-3">Enter class and subject name <br>(class name type must be same for all same classes) </p> 
                <form action={{ route('editStudentRecord') }} method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{$id}}">
                    <div class="">
                        <label class="my-3">Edit Name</label>
                    <input class="form-control" type="text"  id="editName" name="editName"  value="{{$user->name}}" required>
                    </div><!-- end col -->  
                    <div class="">
                        <label class="my-3">Edit email</label>
                        <input class="form-control" type="text"  id="editEmail" name="editEmail"  value="{{$user->email}}" required>
                    </div><!-- end col -->  
                    
                    <div class="col-md-6">
                        <label class="mb-3">Select Class</label>
                       @isset($grades)
                        <select id="editClass" name="editClass" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" required>
                            <option value="{{$user->grade}}">{{$user->grade}}</option>
                            @foreach($grades as $class)   
                            <option value="{{$class}}">{{$class}}</option>
                           @endforeach
                        </select>
                        @endisset
                    </div><!-- end col --> 
                    <div class="col-md-6">
                        <label class="my-3">Edit App Permission</label>
                        <select id="editAppPermission" name="editAppPermission" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" required>
                            @if($user->app_permission==1)
                            <option value="1" active>Yes</option>
                            <option value="0">No</option>
                            @endif
                            @if($user->app_permission==0)
                            <option value="0" active>No</option>
                            <option value="1">Yes</option>
                            @endif
                        </select>
                    </div><!-- end col --> 
                    <div class="col-md-6">
                        <label class="my-3">Edit Exam Permission</label>
                        <select id="editExamPermission" name="editExamPermission" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" required>
                            @if($user->exam_permission==1)
                            <option value="1" active>Yes</option>
                            <option value="0">No</option>
                            @endif
                            @if($user->exam_permission==0)
                            <option value="0" active>No</option>
                            <option value="1">Yes</option>
                            @endif
                        </select>                    </div><!-- end col --> 
                </div><!--end row-->   

                  
                   
                    <button type="submit" class="btn btn-gradient-primary">Save Changes</button>
                    <button type="button" onclick="window.location='/admin/create_liveClass'" class="btn btn-gradient-danger">Cancel</button>
                </form>  
                @endforeach                                         
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>

@endsection  


@section('footerScript')


<script src="{{ URL::asset('plugins/footable/js/footable.js')}}"></script>
        <script src="{{ URL::asset('plugins/moment/moment.js')}}"></script> 
        <script src="{{ URL::asset('assets/pages/jquery.footable.init.js')}}"></script> 
        
@stop