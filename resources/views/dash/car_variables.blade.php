
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

            <li class="sidebar-item active">
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
        <h3><i class="fa fa-calculator color4"></i>&nbsp;&nbsp;Shipment Variables</h3>
        {{-- <a href="/emp_report"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Print Emp. Report</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a> --}}
    </div>

    @if (count($variables) < 2)
        <div class="row">
            <div class="col-12 col-xl-10">
                @include('inc.messages') 
                <div class="card">
                    <div class="card-body">

                        <p>&nbsp;</p>
                        <div class="col-md-10 offset-md-1">

                            <!-- Add Employee -->
                            <form action="{{ action('CardashController@store') }}" method="POST">
                                @csrf
                    
                                <div class="filter_div" id="">
                                    <i class="fa fa-car"></i> &nbsp; Shipment Type
                                    <select name="item" id="" onchange="">
                                        <option value="cont" selected>Container</option>
                                        <option value="ro">Roro</option>
                                    </select>
                                </div>
                        
                                <div class="filter_div" id="">
                                    <i class="fa fa-edit"></i> &nbsp; Freight Val($)
                                    <input type="text" name="freight" placeholder="eg. 100" required>
                                </div>
                        
                                <div class="filter_div" id="">
                                    <i class="fa fa-pencil-square"></i> &nbsp; Inspection Val($)
                                    <input type="text" name="inspection" placeholder="eg. 100" required>
                                </div>
                        
                                <div class="filter_div" id="">
                                    <i class="fa fa-edit"></i> &nbsp; Insurance Val($)
                                    <input type="text" name="insurance" placeholder="eg. 100" required>
                                </div>
                    
                                <div class="form-group modal_footer">
                                    <button type="submit" name="store_action" value="add_variables" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- {{ $variables->links() }} --}}
    <div class="row">
        <div class="col-12 col-xl-10">
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <div class="col-md-10 offset-md-1">
                        <!-- Leaves View -->
                        <div class="table-responsive">
                            @if (count($variables) > 0)
                                <table class="table mb-0 table-lg">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Freight</th>
                                            <th>Inspection</th>
                                            <th>Insurance</th>
                                            <th class="align_right">Action</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        @foreach ($variables as $var)
                                            @if ($var->del != 'null')
                                                @if ($c % 2 == 1)
                                                    <tr class="bg9">
                                                @else
                                                    <tr>
                                                @endif
                                                    <td class="text-bold-500">{{$c++}}</td>
                                                    <td class="text-bold-500">
                                                        @if ($var->item == 'cont')
                                                            Container
                                                        @else
                                                            Roro
                                                        @endif
                                                    </td>
                                                    <td class="text-bold-500">{{ $var->freight }}</td>
                                                    <td class="text-bold-500">{{ $var->inspection }}</td>
                                                    <td class="text-bold-500">{{ $var->insurance }}</td>
                                                    {{-- <td class="text-bold-500">@if ($lv->dob != '') {{date('D.. M, d Y', strtotime($lv->dob))}} @endif</td> --}}
                                                    <td class="text-bold-500 align_right">

                                                        <form action="{{ action('HrdashController@update', $var->id) }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @csrf
                                                            
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#edit_shp{{$var->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>

                                                        </form>

                                                    </td>
                                                </tr>

                                                <!-- Update Users -->
                                                <div class="modal fade" id="edit_shp{{$var->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    Edit
                                                                    @if ($var->item == 'cont')
                                                                        Container Variables
                                                                    @else
                                                                        Roro Variables
                                                                    @endif
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ action('CardashController@update', $var->id) }}" method="POST">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    
                                                                    {{-- <div class="filter_div" id="">
                                                                        <i class="fa fa-car"></i> &nbsp; Shipment Type
                                                                        <select name="item" id="" onchange="">
                                                                            @if ($var->item == 'cont')
                                                                                <option value="cont" selected>Container</option>
                                                                                <option value="ro">Roro</option>
                                                                            @else
                                                                                <option value="cont">Container</option>
                                                                                <option value="ro" selected>Roro</option>
                                                                            @endif
                                                                        </select>
                                                                    </div> --}}
                                                            
                                                                    <div class="filter_div" id="">
                                                                        <i class="fa fa-edit"></i> &nbsp; Freight Val($)
                                                                        <input type="text" name="freight" placeholder="eg. 100" value="{{$var->freight}}" required>
                                                                    </div>
                                                            
                                                                    <div class="filter_div" id="">
                                                                        <i class="fa fa-pencil-square"></i> &nbsp; Inspection Val($)
                                                                        <input type="text" name="inspection" placeholder="eg. 100" value="{{$var->inspection}}" required>
                                                                    </div>
                                                            
                                                                    <div class="filter_div" id="">
                                                                        <i class="fa fa-edit"></i> &nbsp; Insurance Val($)
                                                                        <input type="text" name="insurance" placeholder="eg. 100" value="{{$var->insurance}}" required>
                                                                    </div>
                                                                    
                                                                </div> 

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="fa fa-times d-block d-sm-none"></i><span class="d-none d-sm-block">Close</span>
                                                                    </button>
                                                                    <!--button id="success" class="btn btn-outline-success btn-lg btn-block" type="submit" name="update_action" value="update_user">Update</button-->
                                                                    <button type="submit" name="update_action" value="update_variables" class="btn btn-primary me-1 mb-1">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $variables->links() }} --}}
                            @else
                                <div class="alert alert-danger">
                                    No Records Found
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        

@endsection

 