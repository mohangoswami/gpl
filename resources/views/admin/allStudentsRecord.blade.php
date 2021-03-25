@extends('layouts.admin_analytics-master')

@section('headerStyle')
<link href="{{ URL::asset('plugins/footable/css/footable.bootstrap.css')}}" rel="stylesheet" type="text/css">

<!-- DataTables -->
<link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
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
                    <table id="datatable" class="table">
                        <thead class="thead-light">
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Class</th>
                            <th>App Permission</th>
                            <th>Exam Permission</th>
                            
                           
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($users as $user)
                      
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->grade}}</td>
                            <td>{{$user->app_permission}}</td>
                            <td>{{$user->exam_permission}}</td>
                           
                           
                            <td>
                            <a href="editStudentRecord/{{$user->id}}"><i class="fas fa-edit text-info font-16"></i></a>/
                            <a onclick="return confirm('Are you sure want to delete?')" href="deleteStudentRecord/{{$user->id}}"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                              
                            </td>
                        </tr>
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
         <!-- Required datatable js -->
         <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
         <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
         <script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
         <script src="{{ URL::asset('assets/pages/jquery.analytics_customers.init.js') }}"></script>
@stop
