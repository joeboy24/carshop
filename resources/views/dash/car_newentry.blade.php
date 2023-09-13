
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
        <h3><i class="fa fa-car"></i>&nbsp;&nbsp;Add Vehicle</h3>
        <a href="/view_vehicle"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Vehicle List</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-10">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <div class="col-md-10 offset-md-1">

                        <!-- Add Employee -->
                        <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                <input type="text" name="stock_id" value="SM{{date('my').'0'.$cars_tot}}" readonly required>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-thumb-tack"></i> &nbsp; Inventory Location
                                <select name="inv_loc" id="inv_loc" onchange="">
                                    <option selected>Japan - City 1</option>
                                    <option>Japan - City 2</option>
                                </select>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-car"></i> &nbsp; Model
                                <select name="make_id" id="" onchange="" required>
                                    @foreach ($makes as $item)
                                        <option value="{{$item->id}}">{{$item->model_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-pencil-square"></i> &nbsp; Sub Model
                                <select name="submodel_id" id="" onchange="" required>
                                    @foreach ($submodels as $item)
                                        <option value="{{$item->id}}">{{$item->sub_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Model Code
                                <input type="text" name="model_code" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-cc-visa"></i> &nbsp; Price ($)
                                <input type="number" min="0" step="any" name="price" placeholder="eg. 5000" required>
                            </div>
                                                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Flash (%)
                                <input type="number" min="0" step="any" name="flash" value="0">
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-calendar"></i> &nbsp; Year
                                <select name="year" id="" onchange="">
                                    <option value="0" selected>Select Year</option>
                                    @for ($i = date('Y')-10; $i <= date('Y'); $i++)
                                        <option>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Mileage
                                <input type="text" name="mileage" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Color
                                <input type="text" name="color" required>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-edit"></i> &nbsp; Transmission
                                <select name="trans" id="trans" onchange="">
                                    <option selected>Auto</option>
                                    <option>Manual</option>
                                </select>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-car"></i> &nbsp; Drive
                                <select name="drive" id="drive" onchange="">
                                    <option selected>2WD</option>
                                    <option>4WD</option>
                                </select>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-edit"></i> &nbsp; Steering
                                <select name="steer" id="steer" onchange="">
                                    <option selected>LHD</option>
                                    <option>RHD</option>
                                </select>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Seats
                                <input type="number" min="0" max="8" name="seat" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-gears"></i> &nbsp; Engine Type
                                <input type="text" name="eng_type" required>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-edit"></i> &nbsp; Doors
                                <select name="door" id="steer" onchange="">
                                    <option selected>5</option>
                                    <option>3</option>
                                    <option>2</option>
                                </select>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-gear"></i> &nbsp; Engine Size
                                <input type="text" name="eng_size" required>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-bus"></i> &nbsp; Body Type
                                <select name="body_type" id="body_type" onchange="">
                                    @foreach ($types as $type)
                                        <option>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="filter_div" id="">
                                <i class="fa fa-calculator"></i> &nbsp; Fuel Type
                                <select name="fuel" id="fuel" onchange="">
                                    <option selected>Petrol</option>
                                    <option>Diesel</option>
                                    <option>Hybrid</option>
                                    <option>Gas</option>
                                </select>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Body Length
                                <input type="text" name="body_len" required>
                            </div>
                    
                            <div class="filter_div" id="">
                                <i class="fa fa-edit"></i> &nbsp; Vehicle Weight
                                <input type="text" name="veh_weight" required>
                            </div>
                    
                            <div class="filter_div" id="">
                                <i class="fa fa-pencil-square"></i> &nbsp; Gross Veh. Weight
                                <input type="text" name="gross_weight">
                            </div>
                    
                            <div class="filter_div" id="">
                                <i class="fa fa-edit"></i> &nbsp; Max. Load Cap.
                                <input type="text" name="max_load" placeholder="Maximum Loading Capacity">
                            </div>

                            {{-- <div class="col-md-12">
                                <label>Accesories</label>

                                <div class="form-group"> 
                                    <select class="choices form-select multiple-remove" name="accessory[]" multiple=>
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
                                </div>

                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <div class="form-group with-title mb-3">
                                            <textarea name="accessory" class="form-control" rows="3" required></textarea>
                                            <label>Separate each accessory with comma(,)</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <script>
                                bankdiv = document.getElementById('bankdiv');
                                bank = document.getElementById('bank');
                                newbank = document.getElementById('newbank');
                                newbank.style.display = 'none';
                                function bankcheck() {
                                    // alert(bank.value);
                                    if (bank.value == 'na') {
                                        newbank.style.display = "block";
                                    } else {
                                        newbank.style.display = 'none';
                                    }
                                }

                                // document.getElementById('branch_div').style.display = 'none';
                                
                                branch_div = document.getElementById('branch_div');
                                branch = document.getElementById('branch');
                                newbranch = document.getElementById('newbranch');
                                newbranch.style.display = 'none';

                                function branchcheck() {
                                    // alert(branch.value);
                                    if (branch.value == 'na') {
                                        newbranch.style.display = "block";
                                    } else {
                                        newbranch.style.display = 'none';
                                    }
                                }
                            </script>
                    
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Select Related Pictures
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="add_vehicle" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form>


                        {{-- <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Test Photos
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="test_photos" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form> --}}
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
        

@endsection

 