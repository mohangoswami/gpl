@extends('layouts.student_master')


@section('content')

       <div class="row mt-5">
        <div class="col-lg-4">
        @foreach ($results as $result)
            <div class="card bg-light b-round">
                <div class="card-body b-round bg-primary">
                    <div class="ribbon2 rib2-warning">
                        <span class="text-white text-center rib2-warning"><i class="fas fa-medal"></i></span>                                        
                    </div><!--end ribbon-->
                    <h1 class="header-title b-round bg-light text-center mt-5 m-2">{{$result->subject}}</h1>  
                    <h2 class="header-title b-round bg-light text-center mt-0 m-2">{{$result->title}}</h2>  
                    <div class=" text-center">
                        <div>
                            <div class="avatar-box thumb-xl align-self-center mr-2">
                                <span class="avatar-title text-pink rounded-circle bg-light">
                                    @if($result->marksObtain!="")
                                    {{$result->marksObtain}}
                                    @else
                                    N/A
                                    @endif
                                </span>
                            </div>
                        <h5 class="text-light">Max Marks - {{$result->maxMarks}}</h5>
                        </div>
                        
                    </div>
                @php
                            $exams = DB::table('exams')
                ->select('topperShown')
                ->where('id', $result->titleId)
                ->get();
                @endphp
                @foreach ($exams as $exam)
                @if($exam->topperShown == 1)
                        <div class="card-footer b-round text-center">
                            <div >
                                <h4 class="text-light">Top 3 Scorer</h4>
                            </div>
                            <div class="text-light">
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($toppers as $topper)
                                @if($i>3)
                                @break;
                                @endif
                                @if($topper->titleId == $result->titleId)
                                    @if($topper->marksObtain!="")
                                        
                                    
                                <span>{{$i}}. {{$topper->name}} 
                                    <span class="avatar-title text-primary rounded-circle bg-light"> -{{$topper->marksObtain}}*</span>
                                    <br>
                                @php
                                    $i=$i+1;
                                @endphp
                                @endif
                                
                                @endif
                                
                                @endforeach 
                            </div>                                        
                        </div>
                        @endif
                        @endforeach
                </div><!--end card-body-->
            </div><!--end card-->
        @endforeach 
        </div><!--end col-->                        
        </div><!--end row-->
      

@stop
