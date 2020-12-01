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
                        <h4 class="header-title mt-0 mb-3">Latest Classwork</h4>
                        <div class="slimscroll crm-dash-activity">
                            <div class="activity">
                                @foreach($classworks as $classwork)
                                <div class="activity-info">
                                    <div class="icon-info-activity">
                                        @if($classwork->type=='IMG')
                                        <i class=" ti-image bg-soft-pink"></i>
                                        @elseif($classwork->type=='PDF')
                                        <i class=" fas fa-file-pdf bg-soft-warning"></i>
                                        @elseif($classwork->type=='DOCS')
                                        <i class="fas fa-file-word bg-soft-primary"></i>
                                        @elseif($classwork->type=='YOUTUBE')
                                        <i class=" ti-youtube bg-soft-danger"></i>
                                       @else
                                        <i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
                                        @endif
                                    </div>
                                    <div class="activity-info-text">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 w-75">{{$classwork->class}} - {{$classwork->subject}}</h6>
                                            <span class="text-muted d-block">{{$classwork->created_at->format('d/M')}}</span>
                                        </div>
                                        <div>
                                            <h7>{{$classwork->title}}</h7>
                                        </div>
                                        <p class="text-muted mt-3">{{$classwork->discription}}
                                            <a href="#" class="text-info">[more info]</a>
                                        </p>
                                    </div>
                                </div>
                                <hr> 
                                @endforeach
                                                                          
                            </div><!--end activity-->
                        </div><!--end crm-dash-activity-->
                    </div>  <!--end card-body-->                                     
                </div><!--end card--> 
            </div><!--end col-->  

            <div class="col-lg-4">
                <div class="card">                                       
                    <div class="card-body"> 
                        <h4 class="header-title mt-0 mb-3">Latest Exams</h4>
                        <div class="slimscroll crm-dash-activity">
                            <div class="activity">
                                @foreach($exams as $exam)

                                <div class="activity-info">
                                    <div class="icon-info-activity">
                                        @if($exam->type=='IMG')
                                        <i class=" ti-image bg-soft-pink"></i>
                                        @elseif($exam->type=='PDF')
                                        <i class=" fas fa-file-pdf bg-soft-warning"></i>
                                        @elseif($exam->type=='DOCS')
                                        <i class="fas fa-file-word bg-soft-danger"></i>
                                        @elseif($exam->type=='FORM')
                                        <i class="fas fa-file-alt bg-soft-primary"></i>
                                       @else
                                        <i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
                                        @endif
                                    </div>
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
                                        <p class="text-muted mt-3">Start at - {{date('d/M h:ia',$startTime)}}
                                          <br>  End at - {{date('d/M h:ia',$endTime)}}
                                          <br>    <a href="#" class="text-info">[more info]</a>
                                        </p>
                                      
                                    </div>
                                </div>
                                <hr> 
                                @endforeach
                                                                          
                            </div><!--end activity-->
                        </div><!--end crm-dash-activity-->
                    </div>  <!--end card-body-->                                     
                </div><!--end card--> 
            </div><!--end col-->  

        </div>
    </div>

    <!--Data table-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button onclick="window.location.href='/teacher/create_classwork'" class="btn btn-gradient-primary px-4 float-right mt-0 mb-3"><i class="mdi mdi-plus-circle-outline mr-2"></i>Add New Work</button>
                    <h4 class="header-title mt-0">All classwork</h4> 
                    <div class="table-responsive dash-social">
                        <table id="datatable" class="table">
                            <thead class="thead-light">
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone No</th>                                                    
                                <th>Country</th>
                                <th>Action</th>
                            </tr><!--end tr-->
                            </thead>

                            <tbody>
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-10.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Donald Gardner<small class="badge badge-soft-pink ml-1">New</small></td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>Tokyo, JAP</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-9.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Matt Rosales</td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>San Francisco USA</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-8.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Michael Hill<small class="badge badge-soft-blue ml-1">New</small></td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>Sydeny AUS</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-7.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Nancy Flanary</td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>Berlin GER</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-6.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Dorothy Key</td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>New York USA</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                            <tr>
                                <td><img src="{{ URL::asset('assets/images/users/user-5.jpg')}}" alt="" class="thumb-sm rounded-circle mr-2">Joseph Cross</td>
                                <td>xyx@gmail.com</td>
                                <td>+123456789</td>
                                <td>Tokyo JAP</td>
                                <td>                                                       
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr><!--end tr-->
                                                                            
                            </tbody>
                        </table>                    
                    </div>                                         
                </div><!--end card-body--> 
            </div><!--end card--> 
        </div> <!--end col-->                               
    </div><!--end row--> 
@endsection


@section('footerScript')
  <!-- Required datatable js -->
        <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.analytics_customers.init.js') }}"></script>

@stop