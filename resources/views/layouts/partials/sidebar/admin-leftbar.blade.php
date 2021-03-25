  <!-- leftbar-tab-menu -->
  <div class="leftbar-tab-menu">
    <div class="main-icon-menu">
        <a href="/admin/" class="logo logo-metrica d-block text-center">
            <span> 
                <img src="{{ URL::asset('assets/images/gpl_logo2.png')}}" alt="logo-small" class="logo-sm">
            </span>
        </a>
        <nav class="nav">
            <a href="#studentsRecord" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="All Records" data-trigger="hover">
                <i data-feather="users" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end Students Record-->  

            <a href="#MetricaAnalytics" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Live Class" data-trigger="hover">
                <i data-feather="video" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end MetricaAnalytics-->  

            <a href="#createUser" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Create" data-trigger="hover">
                <i data-feather="user-plus" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end MetricaApps-->

            <a href="#flashNews" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Flash News" data-trigger="hover">
                <i data-feather="rss" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end MetricaUikit-->

            <a href="#createSub" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Class & Subject" data-trigger="hover">
                <i data-feather="copy" class="align-self-center menu-icon icon-dual"></i>             
            </a><!--end MetricaPages-->

            <a href="#allClasswork" class="nav-link" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Classwork" data-trigger="hover">
                <i data-feather="file" class="align-self-center menu-icon icon-dual"></i>
            </a> <!--end allClasswork--> 

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
            <a href="/admin/" class="logo">
                <div class="mt-4">
                 <h2 class="text-muted font-weight-bold">G P L M S</h2>  
                </div>
            </a>
        </div>
        <!--end logo-->
        <div class="menu-body slimscroll">          
            
            <div id="studentsRecord" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">View All Record</h6>       
                    <ul class="nav metismenu">
                          <li class="nav-item">
                            <a class="nav-link" href="/admin/allStudentsRecord"><span class="w-100">Students</span></a>
                        </li><!--end nav-item-->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/allTeachersRecord"><span class="w-100">Teachers</span></a>
                        </li><!--end nav-item-->
                    </ul>
                </div>
                
            </div><!-- end Student Record -->

            <div id="MetricaAnalytics" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Live Classes</h6>       
                    <ul class="nav metismenu">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/liveClasses/create_liveClass"><span class="w-100">Create</span></a>
                        </li><!--end nav-item-->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/liveClasses/allLiveClasses"><span class="w-100">View all</span></a>
                        </li><!--end nav-item-->
                    </ul>
                </div>
                
            </div><!-- end Analytic -->
            <div id="createUser" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Create New User</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="/register">Student</a></li>
                    <li class="nav-item"><a class="nav-link" href="/teacher/register">Teacher</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/register">Admin</a></li>
                   
                </ul>
            </div><!-- end Pages -->

            <div id="flashNews" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Flash News</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="/admin/createFlashNews">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/allFlashNews">All News</a></li>
                   
                </ul>
            </div><!-- end flashNews -->

            <div id="createSub" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Create Class,Subject & Terms</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="/admin/create_subCode">Create Subject & Class</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/allSubCodes">View Subject & Class</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/createTerms">Create Term</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/allTerms">View Terms</a></li>
                 
                </ul>
            </div><!-- end createSub -->

            <div id="allClasswork" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">All Classwork</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="/admin/allClasswork">All Classwork</a></li>
                      
                </ul>
            </div><!-- end createSub -->
            
        </div><!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>
<!-- end leftbar-tab-menu-->