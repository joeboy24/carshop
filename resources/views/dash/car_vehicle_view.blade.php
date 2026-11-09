
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')
<div class="cms_page cms_wide">
    @include('inc.messages')
    <div class="cms_list_head">
        <div>
            <h1>Vehicles</h1>
            <p>Promote a listing to the homepage, edit its details, or remove it.</p>
        </div>
        <div class="cms_form_links">
            <a href="/new_entry">New vehicle</a>
            <a href="/add_part">New part</a>
        </div>
    </div>
    <form class="cms_search" action="{{ action('CardashController@store') }}" method="POST">
        @csrf
        <input type="text" name="search_veh" placeholder="Stock id, chassis, or model">
        <button type="submit" name="store_action" value="dash_search_veh">Search</button>
    </form>

    @if (count($cars) > 0)
        <div class="cms_records">
            @foreach ($cars as $car)
                @php $shot = $car->gallery->first(); @endphp
                <article class="cms_record">
                    @if ($shot)
                        <img src="{{ \App\Support\Media::url('classified/cars/'.$car->stock_id.'/'.$shot->img) }}" alt="">
                    @else
                        <img alt="">
                    @endif
                    <div>
                        <div class="cms_record_top">
                            <h2>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h2>
                            <span class="cms_pill {{ $car->status == 'Sold' ? 'sold' : ($car->status == 'Active' ? 'on' : '') }}">{{ $car->status }}</span>
                            @if ($car->del == 'yes')
                                <span class="cms_pill">Deleted</span>
                            @elseif ($car->promote != 'no' && $car->flash < 1)
                                <span class="cms_pill on">Promoted</span>
                            @endif
                        </div>
                        <p>{{ $car->stock_id }} · {{ $car->chassis_no }} · {{ $car->year }} · {{ $car->mileage }} · {{ $car->color }} · {{ $car->inv_loc }}</p>
                        <p>{{ $car->trans }} · {{ $car->drive }} · {{ $car->steer }} · {{ $car->body_type }} · {{ $car->fuel }} · {{ $shot ? count($car->gallery).' '.(count($car->gallery) === 1 ? 'photo' : 'photos') : 'No photos' }}</p>
                        <p class="cms_price">USD {{ number_format((float) $car->price, 0) }}@if ($car->flash > 0) · Flash {{ $car->flash }}%@endif</p>
                    </div>
                    <form action="{{ action('CardashController@update', $car->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        @if ($car->del == 'yes')
                            <button type="submit" name="update_action" value="restore_car" class="cms_icon_btn" title="Restore" onclick="return confirm('Restore this vehicle?')"><i class="fa fa-reply"></i></button>
                        @else
                            @if ($car->flash < 1)
                                @if ($car->promote == 'no')
                                    <button type="submit" name="update_action" value="publish_car" class="cms_icon_btn" title="Promote" onclick="return confirm('Promote this vehicle to the homepage?')"><i class="fa fa-star-o"></i></button>
                                @else
                                    <button type="submit" name="update_action" value="unpublish_car" class="cms_icon_btn is_on" title="Remove from homepage" onclick="return confirm('Remove this vehicle from the homepage?')"><i class="fa fa-star"></i></button>
                                @endif
                            @endif
                            <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $car->id }}" class="cms_icon_btn" title="Edit"><i class="fa fa-pencil"></i></button>
                            <button type="submit" name="update_action" value="del_car" class="cms_icon_btn danger" title="Delete" onclick="return confirm('Delete this vehicle?')"><i class="fa fa-trash"></i></button>
                        @endif
                    </form>
                </article>

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
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-warning"></i> &nbsp; Status
                                                                <select name="status" id="status" onchange="">
                                                                    @if ($car->status == 'Sold')
                                                                        <option value="{{$car->status}}" selected>{{$car->status}}</option>
                                                                        <option>Active</option>
                                                                        <option>Inactive</option>
                                                                    @elseif ($car->status == 'Inactive')
                                                                        <option value="{{$car->status}}" selected>{{$car->status}}</option>
                                                                        <option>Active</option>
                                                                        <option>Sold</option>
                                                                    @else
                                                                        <option>Sold</option>
                                                                        <option selected>Active</option>
                                                                        <option>Inactive</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                                                <input type="text" name="stock_id" value="{{$car->stock_id}}" readonly required>
                                                            </div>
                                                            
                                                            <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Chassis No.
                                                                <input type="text" name="chassis_no" value="{{$car->chassis_no}}">
                                                            </div>
                                                
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-thumb-tack"></i> &nbsp; Inventory Loc.
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
                                                                    @for ($i = date('Y')-24; $i <= date('Y'); $i++)
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
                                                                    <option selected>{{$car->body_type}}</option>
                                                                    @foreach ($types as $type)
                                                                        @if ($type->name != $car->body_type)
                                                                            <option>{{$type->name}}</option>
                                                                        @endif
                                                                    @endforeach
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
                                                    
                                                            {{-- <div class="filter_div">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Body Length
                                                                <input type="text" name="body_len" value="{{$car->body_len}}" required>
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Vehicle Weight
                                                                <input type="text" name="veh_weight" value="{{$car->vweight}}">
                                                            </div> --}}
                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Vehicle Width
                                                                <input type="text" name="veh_width" value="{{$car->vwidth}}">
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-pencil-square"></i> &nbsp; Gross Veh.Wgt
                                                                <input type="text" name="gross_weight" value="{{$car->gvweight}}">
                                                            </div>
                                                    
                                                            <div class="filter_div" id="">
                                                                <i class="fa fa-edit"></i> &nbsp; Max. Load Cap.
                                                                <input type="text" name="max_load" value="{{$car->max_load}}" placeholder="Maximum Loading Capacity">
                                                            </div>
                                
                                                            <label class="cms_field">Accessories
                                                                <textarea name="accessory" rows="3" required placeholder="Separate each accessory with a comma">{{ $car->accessory }}</textarea>
                                                            </label>
                                                    
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
        </div>
        <div style="margin-top:16px">{{ $cars->links() }}</div>
    @else
        <p class="cms_empty">No vehicles yet.</p>
    @endif
</div>
@endsection

 