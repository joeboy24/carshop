
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item">
                <a href="/car_dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item active has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-car"></i>
                    <span>Vehicle Mgt.</span>
                </a>
                <ul class="submenu active"> 
                    <li class="submenu-item active">
                        <a href="/new_entry">New Entry</a>
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
        <h3><i class="fa fa-gears"></i>&nbsp;&nbsp;Add Vehicle Parts</h3>
        <a href="/view_parts"><p class="print_report">&nbsp;<i class="fa fa-file-text"></i>&nbsp; View Parts</p></a>
        <a href="/new_entry"><p class="print_report">&nbsp;<i class="fa fa-car"></i>&nbsp;Add Vehicle</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-10">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <div class="col-md-10 offset-md-1">

                        <!-- Add Vehicle Part -->

                        {{-- <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                <input type="text" name="stock_id" value="SM{{date('m').'0'.date('is')}}" readonly required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Part
                                <input type="text" name="name" placeholder="Name / Title" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-gears"></i> &nbsp; Description
                                <input type="text" name="desc" placeholder="Description" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Select Related Pictures
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="add_part" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form> --}}


                        <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                <input type="text" name="stock_id" value="SM{{date('my').'0'.$cars_tot}}" readonly required>
                            </div>
                        
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Part Name
                                <input type="text" name="part_name" placeholder="ex. Tires" required>
                            </div>

                            <div class="col-md-12" id="veh_parts">
                                <label>Description</label>
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <div class="form-group with-title mb-3">
                                            <textarea name="part_desc" class="form-control" rows="3" maxlength="200" required></textarea>
                                            <label>Short description of vehicle part(s)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="filter_div">
                                <i class="fa fa-cc-visa"></i> &nbsp; Price ($)
                                <input type="number" min="0" step="any" name="price" placeholder="ex. 950" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Select Related Pictures
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="add_new_part" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
        

@endsection

 