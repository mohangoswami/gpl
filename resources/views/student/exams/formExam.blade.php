@extends('layouts.student_master')

@section('headerStyle')
<link href="{{ URL::asset('plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
@stop

@section('content')
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
@if (session('delete'))
<div class="alert alert-warning b-round  mt-3">
    {{ session('delete') }}
</div>
@endif    
@foreach ($exams as $exam)
    
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header bg-warning text-white mt-0">{{$exam->subject}}</h5>
                    <div class="card-body">
                        <h4 class="card-title mt-0 ">Topic- {{$exam->title}}</h4>
                        <div >
                            <div>@if($finalSubmit==true)
                                <h3 class="bg-success text-danger b-round"><center><i class="mdi mdi-check-all mr-1"></i>Submitted Done</center></h3>
                                 @else
                                <a onclick="return confirm('Are you sure want to final submit?')"  href="{{$exam->id}}/submittedDone"  class="btn btn-danger b-round btn-lg btn-block mt-1" ><i class="mdi mdi-send mr-2"></i>Final Submit</a>
                                @endif
                            </div>
                        </div>
                       
                    </div><!--end card-body--> 
                </div><!--end card-->
            </div>
        </div>
        {!! $exam->examUrl !!}
        @endforeach

@stop

@section('footerScript')

<script src="{{ URL::asset('assets/pages/jquery.form-upload.init.js')}}"></script>
<script src="{{ URL::asset('plugins/dropify/js/dropify.min.js')}}"></script>
@stop