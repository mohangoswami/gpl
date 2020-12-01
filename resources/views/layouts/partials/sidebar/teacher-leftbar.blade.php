  <!-- leftbar-tab-menu -->
        <div class="leftbar-tab-menu">
            <div class="main-icon-menu">
                <a href="{{ URL::asset('analytics/analytics-index')}}" class="logo logo-metrica d-block text-center">
                    <span>
                        <img src="{{ URL::asset('assets/images/gpl_logo2.png')}}" alt="logo-small" class="rounded-circle logo-sm">
                    </span>
                </a>
                <nav class="nav">
                    <a href="#classroom" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="classroom" data-trigger="hover">
                        <i data-feather="book-open" class="align-self-center menu-icon icon-dual"></i>
                    </a><!--end classroom-->  

                    <a href="#addMaterial" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Add Material" data-trigger="hover">
                        <i data-feather="plus-square" class="align-self-center menu-icon icon-dual"></i>
                    </a><!--end MetricaApps-->

                    <a href="#Examination" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Examination" data-trigger="hover">
                        <i data-feather="file-text" class="align-self-center menu-icon icon-dual"></i>
                    </a><!--end MetricaUikit-->

                    <a href="#liveClasses" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Live classes" data-trigger="hover">
                        <i data-feather="video" class="align-self-center menu-icon icon-dual"></i>             
                    </a><!--end MetricaPages-->
                    <!--
                    <a href="#MetricaAuthentication" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Authentication" data-trigger="hover">
                        <i data-feather="lock" class="align-self-center menu-icon icon-dual"></i>
                    </a> <!--end MetricaAuthentication--> 

                </nav><!--end nav-->
                <div class="pro-metrica-end">
                    <a href="" class="help" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Chat">
                        <i data-feather="message-circle" class="align-self-center menu-icon icon-md icon-dual mb-4"></i> 
                    </a>
                    <a href="" class="profile">
                        <img src="{{ URL::asset('assets/images/users/user-4.jpg')}}" alt="profile-user" class="rounded-circle thumb-sm"> 
                    </a>
                </div>
            </div><!--end main-icon-menu-->

            <div class="main-menu-inner">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="/teacher/" class="logo">
                        <div class="mt-4">
                         <h2 class="text-muted font-weight-bold">G P L M S</h2>  
                        </div>
                    </a>
                </div>
                <!--end logo-->
                <div class="menu-body slimscroll">                    
                    <div id="classroom" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">classroom</h6>       
                        </div>
                        <ul class="nav">
                            @isset($subCodes)                                
                            @foreach($subCodes as $subCode)
                                @foreach($classCodes as $classCode)
                                    @if($subCode==$classCode->id)
                                    <li class="nav-item"><a class="nav-link" href="{{route('teacher.classroom',[$classCode->id])}}">{{$classCode->class}} - {{$classCode->subject}}</a></li>
                                    @endif
                                @endforeach
                            @endforeach
                            @endisset

                            </ul>
                    </div><!-- end Analytic -->

                    <div id="addMaterial" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Add Material</h6>
                        </div>
                        <ul class="nav">
                            @isset($subCodes)                                
                            @foreach($subCodes as $subCode)
                                @foreach($classCodes as $classCode)
                                    @if($subCode==$classCode->id)
                                    <li class="nav-item"><a class="nav-link" href="{{route('teacher.addMaterial',[$classCode->id])}}">{{$classCode->class}} - {{$classCode->subject}}</a></li>
                                    @endif
                                @endforeach
                            @endforeach
                            @endisset

                            </ul>
                    </div><!-- end Analytic -->
                    
                    <div id="Examination" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Examination</h6>      
                        </div>
                        <ul class="nav">
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="/teacher/createExam">Create Exam</a></li>
                                <li class="nav-item"><a class="nav-link" href="/teacher/allExams">View Exams</a></li>
                            </ul>
                    </div><!-- end Pages -->

                    <div id="liveClasses" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Live Classes</h6>        
                        </div>
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="/teacher/liveClass"">Today's Live Classes</a></li>
                            
                        </ul>
                    </div><!-- end Pages -->
                    <div id="MetricaAuthentication" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Authentication</h6>     
                        </div>
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-login">Log in</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-login-alt">Log in alt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-register">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-register-alt">Register-alt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-recover-pw">Re-Password</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-recover-pw-alt">Re-Password-alt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-lock-screen">Lock Screen</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-lock-screen-alt">Lock Screen</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-404">Error 404</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-404-alt">Error 404-alt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-500">Error 500</a></li>                            
                            <li class="nav-item"><a class="nav-link" href="/authentication/auth-500-alt">Error 500-alt</a></li>
                        </ul>
                    </div><!-- end Authentication-->
                </div><!--end menu-body-->
            </div><!-- end main-menu-inner-->
        </div>
        <!-- end leftbar-tab-menu-->