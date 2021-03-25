@extends('layouts.teacher_analytics-master')

@section('headerStyle')
 <!-- DataTables -->
<link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
@stop

@section('content')

<div class="row">

<div class="container-fluid mt-3">
    <!-- Page-Title -->
    <div class="row">
            <div class="col-lg-4">
                <div class="card">                                       
                    <div class="card-body"> 
                        <h4 class="header-title mt-0 mb-3">All Exams</h4>
                        <div class="slimscroll crm-dash-activity">
                            <div class="activity">
                                
                                @foreach($resultLists as $exam)
                                <a href="/teacher/result/{{$exam->id}}">
                                <div class="activity-info">
                                    <div class="activity-info-text">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 w-75">{{$exam->class}} - {{$exam->subject}}</h6>
                                            <span class="text-muted d-block">{{$exam->created_at->format('d/M')}}</span>
                                        </div>
                                        <div>
                                            <h7>{{$exam->title}}</h7>
                                        </div>
                                        @php
                                            $startTime = strtotime($exam->startExam);
                                            $endTime = strtotime($exam->endExam);
                                        @endphp
                                        <p class="text-muted mt-0">Start at - {{date('d/M h:ia',$startTime)}}
                                          <br>  End at - {{date('d/M h:ia',$endTime)}}
                                        </p>
                                    </div>
                                </div>
                                </a>
                                <hr> 
                                @endforeach
                                                                        
                            </div><!--end activity-->
                        </div><!--end crm-dash-activity-->
                    </div>  <!--end card-body-->                                     
                </div><!--end card--> 
            </div><!--end col-->  

        </div>
    </div>
</div>

    
@endsection


@section('footerScript')
  <!-- Required datatable js -->
        <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.analytics_customers.init.js') }}"></script>

@stop