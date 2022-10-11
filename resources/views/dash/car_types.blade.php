
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

            <li class="sidebar-item active has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <ul class="submenu active">
                    <li class="submenu-item">
                        <a href="/companysetup">Company Setup</a>
                    </li>
                    <li class="submenu-item">
                        <a href="/adduser">Manage User</a>
                    </li>
                    <li class="submenu-item">
                        <a href="/model_mgt">Car Model Mgt.</a>
                    </li>
                    <li class="submenu-item active">
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
        <h3><i class="fa fa-align-center color3"></i>&nbsp;&nbsp;Vehicle Types</h3>
        {{-- <a href="/emp_report"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Print Emp. Report</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a> --}}
    </div>

    <div class="row">
        @include('inc.messages') 

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- <p>&nbsp;</p> --}}
                    <h6>Add Type</h6>
                    <!-- Add Model -->
                    <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!--div class="form-group"> 
                            <select class="choices form-select multiple-remove" name="accessory[]" multiple>
                                <optgroup label="Figures">
                                    <option value="romboid">Romboid</option>
                                    <option value="trapeze" selected>Trapeze</option>
                                    <option value="triangle">Triangle</option>
                                    <option value="polygon">Polygon</option>
                                </optgroup>
                                <optgroup label="Colors">
                                    <option value="red">Red</option>
                                    <option value="green">Green</option>
                                    <option value="blue" selected>Blue</option>
                                    <option value="purple">Purple</option>
                                </optgroup>
                            </select>
                        </div-->
                
                        <div class="filter_div" id="newtitle">
                            <i class="fa fa-car"></i> &nbsp; Name
                            <input type="text" name="name" placeholder="eg. Sedan" required>
                        </div>
                    
                        <div class="filter_div">
                            <i class="fa fa-camera"></i> &nbsp; Image
                            <input type="file" name="pass_photo" required>
                        </div>
                        <p class="small_p">Note: Image Size: 240 x 140 .png(Transparent Background)</p>

                        <div class="form-group modal_footer">
                            <button type="submit" name="store_action" value="add_type" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save Type</button>
                        </div>

                    </form>

                    <p>&nbsp;</p>
                    <!-- Make View -->
                    @if (count($types) != 0)
                        <div class="table-responsive">
                            <h6>All Models</h6>
                            <table class="table mb-0 table-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Image</th>
                                        <th class="align_right">Action</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($types as $tp)
                                        
                                        @if ($c % 2 == 1)
                                            <tr class="bg9">
                                        @else
                                            <tr>
                                        @endif
                                            <td class="text-bold-500">{{$c++}}</td>
                                            <td class="text-bold-500">{{ $tp->name }}<br>
                                                <p class="small_p">Logo: {{ $tp->img }}</p>
                                            </td>
                                            <td class="text-bold-500">
                                                <img class="car_prev" src="/storage/classified/types/{{$tp->img}}" width="70" alt="">
                                            </td>
                                            <td class="text-bold-500 align_right">

                                                <form action="{{ action('CardashController@update', $tp->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @csrf
                                                    
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{$tp->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>

                                                </form>

                                            </td>
                                        </tr>

                                        <!-- Update Type -->
                                        <div class="modal fade" id="edit{{$tp->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                            Edit Type Here
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ action('CardashController@update', $tp->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @csrf
                                                        <div class="modal-body">
                
                                                            <div class="filter_div" id="newtitle">
                                                                <i class="fa fa-car"></i> &nbsp; Name
                                                                <input type="text" name="model_name" value="{{ $tp->name }}" required>
                                                            </div>
                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-car"></i> &nbsp; Status
                                                                <select name="status" id="" onchange="">
                                                                    @if ($tp->status == 'active')
                                                                        <option value="active" selected>Active</option>
                                                                        <option value="inactive">Inactive</option>
                                                                    @else
                                                                        <option value="active">Active</option>
                                                                        <option value="inactive" selected>Inactive</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            
                                                        </div> 
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i><span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" name="update_action" value="update_type" class="btn btn-primary me-1 mb-1">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- {{ $types->links() }} --}}
                    @else
                        <div class="alert alert-danger">
                            No Vehicle Types Found
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6>Add Sub Model</h6>
                    <!-- Add Model -->
                    <form action="{{ action('CardashController@store') }}" method="POST">
                        @csrf
                
                        <div class="filter_div" id="">
                            <i class="fa fa-edit"></i> &nbsp; Model
                            <select name="make_id" id="" onchange="" required>
                                @foreach ($makes as $item)
                                    <option value="{{$item->id}}">{{$item->model_name}}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="filter_div" id="newtitle">
                            <i class="fa fa-car"></i> &nbsp; Sub Name
                            <input type="text" name="sub_name" required>
                        </div>
                
                        <div class="filter_div" id="newtitle">
                            <i class="fa fa-calculator"></i> &nbsp; Code
                            <input type="text" name="sub_code" required>
                        </div>

                        <div class="form-group modal_footer">
                            <button type="submit" name="store_action" value="add_submodel" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save Sub Model</button>
                        </div>

                    </form>

                    <p>&nbsp;</p>
                    <!-- Make View -->
                    @if (count($submodels) != 0)
                        <div class="table-responsive">
                            <h6>Add Sub Models</h6>
                            <table class="table mb-0 table-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sub Name</th>
                                        <th>Sub Code</th>
                                        <th class="align_right">Action</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($submodels as $subm)
                                        
                                        @if ($c % 2 == 1)
                                            <tr class="bg9">
                                        @else
                                            <tr>
                                        @endif
                                            <td class="text-bold-500">{{$y++}}</td>
                                            <td class="text-bold-500">{{ $subm->make->model_name.' '.$subm->sub_name }}</td>
                                            <td class="text-bold-500">{{ $subm->sub_code }}</td>
                                            <td class="text-bold-500 align_right">

                                                <form action="{{ action('HrdashController@update', $subm->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @csrf
                                                    
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editsub{{$subm->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>

                                                </form>

                                            </td>
                                        </tr>

                                        <!-- Update Salary Category -->
                                        <div class="modal fade" id="editsub{{$subm->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                            Edit Sub Model Here
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ action('CardashController@update', $subm->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Model
                                                                <select name="make_id" id="" onchange="" required>
                                                                    @foreach ($makes as $item)
                                                                        @if ($item->id == $subm->make_id)
                                                                            <option value="{{$item->id}}" selected>{{$item->model_name}}</option>
                                                                        @else
                                                                            <option value="{{$item->id}}">{{$item->model_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                
                                                            <div class="filter_div" id="newtitle">
                                                                <i class="fa fa-car"></i> &nbsp; Sub Name
                                                                <input type="text" name="sub_name" value="{{$subm->sub_name}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div" id="newtitle">
                                                                <i class="fa fa-calculator"></i> &nbsp; Code
                                                                <input type="text" name="sub_code" value="{{$subm->sub_code}}" required>
                                                            </div>
                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-car"></i> &nbsp; Status
                                                                <select name="status" id="" onchange="">
                                                                    @if ($subm->status == 'active')
                                                                        <option value="active" selected>Active</option>
                                                                        <option value="inactive">Inactive</option>
                                                                    @else
                                                                        <option value="active">Active</option>
                                                                        <option value="inactive" selected>Inactive</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            
                                                        </div> 
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i><span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" name="update_action" value="update_submodel" class="btn btn-primary me-1 mb-1">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $submodels_page->links() }}
                    @else
                        <div class="alert alert-danger">
                            No Sub-Models Available
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}

    </div>

    {{-- {{ $departments->links() }}
    <div class="row">
        <div class="col-12 col-xl-10">
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <div class="col-md-10 offset-md-1">
                        <!-- Leaves View -->
                        <div class="table-responsive">
                            @if (count($departments) > 0)
                                <table class="table mb-0 table-lg">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="align_right">Action</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        @foreach ($departments as $dept)
                                            
                                            @if ($c % 2 == 1)
                                                <tr class="bg9">
                                            @else
                                                <tr>
                                            @endif
                                                <td class="text-bold-500">{{$c++}}</td>
                                                <td class="text-bold-500">{{ $dept->dept_name }}</td>
                                                <td class="text-bold-500 align_right">

                                                    <form action="{{ action('HrdashController@update', $dept->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @csrf
                                                        
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{$dept->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>

                                                    </form>

                                                </td>
                                            </tr>

                                            <!-- Update Salary Category -->
                                            <div class="modal fade" id="edit{{$dept->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                Edit Department Here
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <form action="{{ action('CardashController@update', $dept->id) }}" method="POST">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @csrf
                                                            <div class="modal-body">
                                                                
                                                                <div class="col-md-12">
                                                                    <label>Department Name</label>
                                                                    <div class="form-group has-icon-left">
                                                                        <div class="position-relative">
                                                                            <input name="dept_name" type="text" class="form-control" placeholder="Title" id="first-name-icon" value="{{ $dept->dept_name }}" required>
                                                                            <div class="form-control-icon">
                                                                                <i class="fa fa-align-center"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i><span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" name="update_action" value="update_dept" class="btn btn-primary me-1 mb-1">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $departments->links() }}
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
    </div> --}}
        

@endsection

 