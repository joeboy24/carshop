
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item active">
                <a href="/car_dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-car"></i>
                    <span>Vehicle Mgt.</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="/new_entry">New Entry</a>
                    </li>
                    <li class="submenu-item">
                        <!--a href="/pay_employee">Upload Data</a-->
                    </li>
                    <li class="submenu-item">
                        <a href="/view_vehicle">View/Edit Vehicle</a>
                    </li>
                    {{-- <li class="submenu-item ">
                        <a href="#">Accounts</a>
                    </li> --}}
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="/inquiry" class='sidebar-link'>
                    <i class="fa fa-envelope-open-o"></i>
                    <span>Inquiry</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="/addabout" class='sidebar-link'>
                    <i class="fa fa-clipboard"></i>
                    <span>About</span>
                </a>
            </li>

            

            

            <li class="sidebar-item">
                <a href="/addservice" class='sidebar-link'>
                    <i class="fa fa-suitcase"></i>
                    <span>Services</span><b class="menu_figure yellow_bg">{{session('leave_count')}}</b>
                </a>
            </li>

            <!--li class="sidebar-item">
                <a href="/birthdays" class='sidebar-link'>
                    <i class="fa fa-gift"></i>
                    <span>Birthdays</span><b class="menu_figure green_bg">{{session('bday_count')}}</b>
                </a>
            </li>

            <li class="sidebar-item ">
                <a href="/reports" class='sidebar-link'>
                    <i class="fa fa-file-text"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-calendar"></i>
                    <span>Calendar</span>
                </a>
            </li-->

            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="/companysetup">Company Setup</a>
                    </li>
                    <li class="submenu-item">
                        <a href="/adduser">Manage User</a>
                    </li>
                    <li class="submenu-item">
                        <a href="/model_mgt">Car Model Mgt.</a>
                    </li>
                    <li class="submenu-item">
                        <a href="/vehicle_types">Vehicle Types</a>
                    </li>
                    
                    {{-- <li class="submenu-item ">
                        <a href="#">Accounts</a>
                    </li> --}}
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="/variables" class='sidebar-link'>
                    <i class="fa fa-calculator"></i>
                    <span>Variables</span>
                </a>
            </li>

        </ul>
    </div>
    
@endsection

@section('content')


    <div class="page-heading">
        @include('inc.messages') 
        <h3><i class="fa fa-th-large color2"></i>&nbsp;&nbsp;Dashboard</h3>
        {{-- <a href="/emp_report"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Print Emp. Report</p></a>&nbsp; --}}
        <div class="dash_header">
            <div class="bg7 color8">
                <i class="fa fa-area-chart"></i>
                <p>{{date('M')}}. Analytics</p>
                <h4>{{session('analytics')}}</h4>
            </div>
            <div class="green_bg color8">
                <i class="fa fa-car"></i>
                <p>Vehicles</p>
                <h4>{{session('car_count')}}</h4>
            </div>
            <div class="bg1 color8">
                <i class="fa fa-cc-visa"></i>
                <p>Payments</p>
                <h4>{{session('pays')}}</h4>
            </div>
            <div class="bg3 color8">
                <i class="fa fa-unlock-alt"></i>
                <p>System Users</p>
                <h4>{{session('user_count')}}</h4>
            </div>
        </div>
    </div>

    <section class="menu_content">
        <a href="/new_entry"><button class="menu_btn"><i class="fa fa-car color5"></i><p>New Entry</p></button></a>
        <a href="/addabout"><button class="menu_btn"><i class="fa fa-clipboard color2"></i><p>About</p></button></a>
        <a href="/addservice"><button class="menu_btn"><i class="fa fa-suitcase color1"></i><p>Services</p></button></a>
        <a href="/inquiry"><button class="menu_btn"><i class="fa fa-envelope color4"></i><p>Inquiries</p></button></a>
        <a href="#"><button class="menu_btn"><i class="fa fa-bar-chart color7"></i><p>Analytics</p></button></a>
        <a href="/variables"><button class="menu_btn"><i class="fa fa-calculator color5"></i><p>Variables</p></button></a>
        <a href="#"><button class="menu_btn"><i class="fa fa-credit-card-alt"></i><p>Payments</p></button></a>
        {{-- <button class="menu_btn"><i class="fa fa-cc-visa"></i><p>Payments</p></button></a> --}}
        <a href="#"><button class="menu_btn"><i class="fa fa-file-text color6"></i><p>Reports</p></button></a>
        <a href="/companysetup"><button class="menu_btn"><i class="fa fa-gears color3"></i><p>Settings</p></button></a>
    </section>

    <div class="row">
        <div class="col-12 col-xl-10">
            @include('inc.messages') 
            <div class="">
                
            </div>
        </div>
    </div>
        

@endsection

 