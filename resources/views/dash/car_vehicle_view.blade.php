
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
                    <li class="submenu-item">
                        <a href="/new_entry">New Entry</a>
                    </li>
                    <li class="submenu-item active">
                        <a href="/view_vehicle">View/Edit Vehicle</a>
                    </li>
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
        <h3><i class="fa fa-file-text color2"></i>&nbsp;&nbsp;Vehicle Management</h3>
        <a href="/new_entry"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Add Vehicle</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a>
        <div class="row">
            <div class="col-12 col-md-8">
                <form action="{{ action('CardashController@store') }}" method="POST">
                    @csrf
                    <input type="text" name="search_veh" class="search_emp" placeholder="Search">
                    <button class="search_btn" name="store_action" value="dash_search_veh"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>

    {{ $cars->links() }}
 
    <div class="row">
        <div class="col-12 col-xl-12">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <!-- Vehicle View -->
                    <div class="table-responsive">
                        @if (count($cars) > 0)
                            <table class="table mb-0 table-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Model / Details</th>
                                        <th></th>
                                        <th></th>
                                        <th>Accessories</th>
                                        <th class="align_right">Actions</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($cars as $car)
                                        @if ($car->del == 'yes')
                                            <tr class="del_danger">
                                        @else
                                            @if ($c % 2 == 1)
                                                <tr class="bg9">
                                            @else
                                                <tr>
                                            @endif
                                        @endif
                                            <td class="text-bold-500">{{$c++}} <br><br>
                                                <img class="car_prev" src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" width="100" alt="">
                                                <p class="small_p">&nbsp;</p>
                                                <p class="small_p">{{count($car->gallery)}} Photos</p>
                                            </td>
                                            <td class="text-bold-500">
                                                <!--a href="/cardash/" class="color10"></a-->
                                                <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                                                <p class="small_p">Model Code: {{ $car->model_code }}</p>
                                                <p class="small_p_black">Color: {{ $car->color }}</p>
                                                <p class="small_p_black">Year: {{ $car->year }}</p>
                                                <p class="small_p_black">Mileage: {{ $car->mileage }}</p>
                                                <p class="small_p_black">Transmission: {{ $car->trans }}</p>
                                                <p class="small_p_black">Inventory Loc: {{ $car->inv_loc }}</p>
                                                <p class="small_p_black">Drive: {{ $car->drive }}</p>
                                            </td>
                                            <td class="text-bold-500"><br>
                                                <h6>${{ number_format($car->price, 2) }}</h6>
                                                <p class="small_p">Flash ($): {{ $car->flash }}</p>
                                                <p class="small_p_black">Steering: {{ $car->steer }}</p>
                                                <p class="small_p_black">Seats: {{ $car->seat }}</p>
                                                <p class="small_p_black">Doors: {{ $car->door }}</p>
                                                <p class="small_p_black">Engine Type: {{ $car->eng_type }}</p>
                                                <p class="small_p_black">Engine Size: {{ $car->eng_size }}</p>
                                            </td>
                                            <td class="text-bold-500"><br>
                                                <p class="small_p_black">Body Type: {{ $car->body_type }}</p>
                                                <p class="small_p_black">Fuel Type: {{ $car->fuel }}</p>
                                                <p class="small_p_black">Body Length: {{ $car->body_len }}</p>
                                                <p class="small_p_black">Vehicle Weight: {{ $car->vweight }}</p>
                                                <p class="small_p_black">Gross Veh. Weight: {{ $car->gvweight }}</p>
                                                <p class="small_p_black">Max. Load Cap.: {{ $car->max_load }}</p>
                                             </td>
                                            <td class="text-bold-500">
                                                <!--p class="accessory_box">Airbag</p>
                                                <p class="accessory_box">Bluetooth Connect</p-->
                                                <p class="small_p_black">{{ $car->accessory }}</p>
                                                <p class="small_p">Status: {{ $car->status }}</p>
                                            </td>

                                            <form action="{{ action('CardashController@update', $car->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf


                                                @if ($car->del == 'yes')
                                                    <td class="text-bold-500 align_right action_size">
                                                        <button type="submit" name="update_action" value="restore_car" class="my_trash" onclick="return confirm('Do you want to restore this record?')"><i class="fa fa-reply"></i></button>
                                                    </td>
                                                @else
                                                    <td class="text-bold-500 align_right action_size">
                                                        @if ($car->promote == 'no')
                                                            <button type="submit" name="update_action" value="publish_car" class="my_trash_small" onclick="return confirm('Click ok to promote this car to front page?')"><i class="fa fa-clipboard"></i></button>
                                                        @else
                                                            <button type="submit" name="update_action" value="unpublish_car" class="my_trash_small bg7" onclick="return confirm('Do you want to remove this car from front page?')"><i class="fa fa-clipboard"></i></button>
                                                            {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#leave{{$car->id}}" class="my_trash_small"><i class="fa fa-clipboard"></i></button> --}}
                                                        @endif
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{$car->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>
                                                        <button type="submit" name="update_action" value="del_car" class="my_trash_small" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                @endif
                                            </form>

                                        </tr>

                                        <!-- Update Vehicle -->
                                        <div class="modal fade" id="edit{{$car->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                            Edit Vehicle Details
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ action('CardashController@update', $car->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @csrf
                                                        <div class="modal-body">
                                                            
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                                                <input type="text" name="stock_id" value="{{$car->stock_id}}" readonly required>
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
                                                                        @if ($item->id == $car->make_id)
                                                                            <option value="{{$item->id}}" selected>{{$item->model_name}}</option>
                                                                        @else
                                                                            <option value="{{$item->id}}">{{$item->model_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Sub Model
                                                                <select name="submodel_id" id="" onchange="" required>
                                                                    @foreach ($submodels as $item)
                                                                        @if ($item->id == $car->submodel_id)
                                                                            <option value="{{$item->id}}" selected>{{$item->sub_name}}</option>
                                                                        @else
                                                                            <option value="{{$item->id}}">{{$item->sub_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-edit"></i> &nbsp; Model Code
                                                                <input type="text" name="model_code" value="{{$car->model_code}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-cc-visa"></i> &nbsp; Price ($)
                                                                <input type="number" min="0" step="any" name="price" value="{{$car->price}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Flash (%)
                                                                <input type="number" min="0" step="any" name="flash" value="{{$car->flash}}" required>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-calendar"></i> &nbsp; Year
                                                                <select name="year" id="" onchange="">
                                                                    <option value="0" selected>Select Year</option>
                                                                    @for ($i = date('Y')-10; $i <= date('Y'); $i++)
                                                                        @if ($car->year == $i)
                                                                            <option selected>{{$i}}</option>
                                                                        @else
                                                                            <option>{{$i}}</option>
                                                                        @endif
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-edit"></i> &nbsp; Mileage
                                                                <input type="text" name="mileage" value="{{$car->mileage}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Color
                                                                <input type="text" name="color" value="{{$car->color}}" required>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Transmission
                                                                <select name="trans" id="trans" onchange="">
                                                                    @if ($car->trans == 'Auto')
                                                                        <option selected>Auto</option>
                                                                        <option>Manual</option>
                                                                    @else
                                                                        <option>Auto</option>
                                                                        <option selected>Manual</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-car"></i> &nbsp; Drive
                                                                <select name="drive" id="drive" onchange="">
                                                                    @if ($car->drive == '2WD')
                                                                        <option selected>2WD</option>
                                                                        <option>4WD</option>
                                                                    @else
                                                                        <option>2WD</option>
                                                                        <option selected>4WD</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Steering
                                                                <select name="steer" id="steer" onchange="">
                                                                    @if ($car->steer == 'LHD')
                                                                        <option selected>LHD</option>
                                                                        <option>RHD</option>
                                                                    @else
                                                                        <option>LHD</option>
                                                                        <option selected>RHD</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Seats
                                                                <input type="number" min="0" max="8" name="seat" value="{{$car->seat}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-gears"></i> &nbsp; Engine Type
                                                                <input type="text" name="eng_type" value="{{$car->eng_type}}" required>
                                                            </div>
                                                
                                                            <div class="filter_div">
                                                                <i class="fa fa-edit"></i> &nbsp; Doors
                                                                <input type="number" min="0" max="5" name="door" value="{{$car->door}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-gear"></i> &nbsp; Engine Size
                                                                <input type="text" name="eng_size" value="{{$car->eng_size}}" required>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-bus"></i> &nbsp; Body Type
                                                                <select name="body_type" id="body_type" onchange="">
                                                                    <option selected>Sedan</option>
                                                                    <option>3</option>
                                                                    <option>2</option>
                                                                </select>
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-calculator"></i> &nbsp; Fuel Type
                                                                <select name="fuel" id="fuel" onchange="">
                                                                    @if ($car->fuel == 'Petrol')
                                                                        <option selected>Petrol</option>
                                                                        <option>Diesel</option>
                                                                        <option>Hybrid</option>
                                                                        <option>Gas</option>
                                                                    @elseif ($car->fuel == 'Diesel')
                                                                        <option>Petrol</option>
                                                                        <option selected>Diesel</option>
                                                                        <option>Hybrid</option>
                                                                        <option>Gas</option>
                                                                    @elseif ($car->fuel == 'Hybrid')
                                                                        <option>Petrol</option>
                                                                        <option>Diesel</option>
                                                                        <option selected>Hybrid</option>
                                                                        <option>Gas</option>
                                                                    @elseif ($car->fuel == 'Gas')
                                                                        <option>Petrol</option>
                                                                        <option>Diesel</option>
                                                                        <option>Hybrid</option>
                                                                        <option selected>Gas</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Body Length
                                                                <input type="text" name="body_len" value="{{$car->body_len}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Vehicle Weight
                                                                <input type="text" name="veh_weight" value="{{$car->vweight}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Gross Veh.Wgt
                                                                <input type="text" name="gross_weight" value="{{$car->gvweight}}">
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Max. Load Cap.
                                                                <input type="text" name="max_load" value="{{$car->max_load}}" placeholder="Maximum Loading Capacity">
                                                            </div>
                                
                                                            <div class="col-md-12">
                                                                <label>Accesories</label>
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <div class="form-group with-title mb-3">
                                                                            <textarea name="accessory" class="form-control" rows="3" required>{{$car->accessory}}</textarea>
                                                                            <label>Separate each accessory with comma(,)</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    
                                                            {{-- <div class="filter_div">
                                                                <i class="fa fa-camera"></i> &nbsp; Photo
                                                                <input type="file" name="photo" required>
                                                            </div> --}}
                                                            
                                                        </div> 
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update_action" value="update_vehicle" class="load_btn"><i class="fa fa-save"></i>&nbsp; Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $cars->links() }}
                        @else
                            <div class="alert alert-danger">
                                No Records Found on Vehicles
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="search_div">
        <form action="">
            <input id="search_fd" type="text" class="search_field" placeholder="Search...">
            <button type="button" onclick="showsearch()"><i class="fa fa-search"></i></button>
        </form>
        <script>
            function showsearch() {
                if (document.getElementById('search_fd').style.opacity != 1) {
                    document.getElementById('search_fd').style.opacity = 1;
                    // document.getElementById('search_fd').style.display = "none";
                } else {
                    document.getElementById('search_fd').style.opacity = 0;
                }
            }
        </script>
    </div>
        

@endsection

 