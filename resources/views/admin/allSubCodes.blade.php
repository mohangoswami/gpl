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
<div class="row m-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">All Classes</h4>
                <p class="text-muted mb-3">You can view or edit live classes and their schedule.
                </p>

                <div class="table-responsive">
                    <table class="table mb-0 table-centered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject Code</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Action</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($subCodes as $subCode)
                      
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$subCode->id}}</td>
                            <td>{{$subCode->class}}</td>
                            <td>{{$subCode->subject}}</td>
                            
                            <td>
                            <a onclick="return confirm('Are you sure want to delete?')" href="deleteSubCode/{{$subCode->id}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                              
                            </td>
                        </tr>
                        @php
                            $i=$i+1;
                        @endphp
                        @endforeach

                        </tbody>
                    </table><!--end /table-->
                </div><!--end /tableresponsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!-- end col -->
</div>

@endsection  


@section('footerScript')

<script src="{{ URL::asset('plugins/footable/js/footable.js')}}"></script>
        <script src="{{ URL::asset('plugins/moment/moment.js')}}"></script> 
        <script src="{{ URL::asset('assets/pages/jquery.footable.init.js')}}"></script> 
        
@stop