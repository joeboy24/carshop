
@extends('layouts.app')


@section('navlist')

  <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
  <li class="nav-item dropbtn"><a href="/about" class="nav-link">About Us</a></li>
  {{-- <li class="nav-item dropbtn"><a href="/how_to_buy" class="nav-link">How to buy</a></li> --}}
  <li class="nav-item dropbtn"><a href="/services" class="nav-link">Services</a></li>
  <!--<li class="nav-item dropdown"><a href="" class="nav-link dropbtn">How to buy</a>
    <div class="dropdown-content">
      <a class="nav-item dropdown" href="/admissions#apply"><i class="fa fa-send li_icon"></i>&nbsp;&nbsp; How to Apply</a>
      <a class="nav-item dropdown" href="/admissions#programs"><i class="fa fa-graduation-cap li_icon"></i>&nbsp; Programs Offered</a>
    </div>
  </li>
  <li class="nav-item"><a href="/news" class="nav-link">News</a></li-->
  {{-- <li class="nav-item dropdown"><a href="" class="nav-link dropbtn">Programs</a>
    <div class="dropdown-content">
      @foreach (session('program') as $program)
        <a href="/student_portal">{{ $program->program_name }}</a>
      @endforeach
    </div> 
  </li> --}}
  <!--li class="nav-item dropdown"><a class="nav-link dropbtn">Services</a>
    <div class="dropdown-content">
      <a href="#"><i class="fa fa-university li_icon"></i>&nbsp;&nbsp; HTI</a>
      <a href="/exam_portal"><i class="fa fa-pencil li_icon"></i>&nbsp;&nbsp; Examinations</a>
      <a href="/student_portal"><i class="fa fa-graduation-cap li_icon"></i>&nbsp; Student Portal</a>
      <a href="/staff_portal"><i class="fa fa-user-circle-o li_icon"></i>&nbsp;&nbsp; Staff Portal</a>
      <a href="/admin_portal"><i class="fa fa-unlock-alt li_icon"></i>&nbsp;&nbsp;&nbsp; Administration</a>
    </div>
  </li--> 
  <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
  {{-- <li class="nav-item"><a href="/gallery" class="nav-link">Gallery</a></li> --}}
  <li class="nav-item cta"><a href="/cart" class="nav-link"><i class="fa fa-shopping-basket color8"></i>&nbsp;&nbsp;<span>Cart</span></a></li>
	        
@endsection


@section('content')

<section class="car_header" style="background: url(/maindir/images/picanto/c2.jpeg); background-size: 100%; height: 750px">
  <div class="container">
    {{-- <img src="/maindir/images/picanto/c2.jpeg" width="100%" alt=""> --}}
    <div style="height: 100px"></div>
    <form action="{{ action('CarsController@index') }}">
      <div class="row">
        <div class="car_searchby col-md-4">
          <h2 class="sb_h2">Find your dream car <i class="fa fa-car color11"></i></h2>
          <select class="search_sel" name="make" id="">
            <option value="0">Select Make</option>
            @foreach ($makes as $item)
              <option value="{{$item->id}}">{{$item->model_name}}</option>
            @endforeach
          </select>

          <select class="search_sel" name="type" id="">
            <option value="0">Type</option>
            @foreach ($types as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>

          <select class="search_sel" name="trans" id="">
            <option value="0">Transmission</option>
            <option value="Auto">Automatic</option>
            <option>Manual</option>
          </select>
          
          <select class="search_sel" name="color" id="">
            <option value="0">Color</option>
            @if (session('car_color'))
              @foreach (session('car_color') as $item)
                <option>{{$item->color}}</option>
              @endforeach
            @endif
          </select>

          <div class="double_select">
            <select class="ds ds1" name="from" id="">
              <option value="0" selected>From Year</option>
              @for ($i = date('Y')-25; $i <= date('Y'); $i++)
                  <option>{{$i}}</option>
              @endfor
            </select>

            <select class="ds ds2" name="to" id="">
              <option value="{{date('Y')}}" selected>To Year</option>
              @for ($i = date('Y')-10; $i <= date('Y'); $i++)
                  <option>{{$i}}</option>
              @endfor
            </select>
          </div>

          <div class="">
            <input class="search_input ds1" type="number" min="0" name="min_price" placeholder="Min Price">
            <input class="search_input ds2" type="number" min="0" name="max_price" placeholder="Max Price" id="">
          </div>
          
          <button type="submit" class="sb_btn"><i class="fa fa-search"></i>&nbsp; Search</button>

          {{-- <div></div>
          <input type="range"> --}}

        </div>
      </div>
    </form>
  </div>
</section>

<!-- By Model -->
<section class="by_model">
  <div class="container">
    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 by_model_right" id="search_veh">
        <div class="key_search">
          <form action="{{ action('CardashController@store') }}" method="POST">
            @csrf
          <p><span>Search &nbsp;</span><i class="fa fa-car"></i></p>
          <input type="text" name="search_veh" placeholder="By Stock ID or Keyword">
          <button type="submit" name="store_action" value="search_veh"><i class="fa fa-search"></i></button>
          </form>
        </div>

        <div class="col-12 car_display" id="car_display">

          @if (count($cars) > 0)
            @foreach ($cars as $car)
              <a href="/cars/{{$car->id}}"><div class="col_20 car_thumb">
                <img src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" alt="">
                {{-- <img class="car_prev" src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" width="100" alt=""> --}}
                <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                <p>{{date('s', strtotime($car->created_at))}} Views</p>
                <h5>Price <span>USD&nbsp;{{ number_format($car->price) }}</span></h5>
              </div></a>
            @endforeach

            <p class="clear_both"></p>
            <a href="#"><button class="show_more_gray"><i class="fa fa-folder-open">&nbsp;</i>&nbsp;View More</button></a>
          @else
            <div class="alert alert-danger">
              No Records Found
            </div>  
          @endif
        </div>

        <div class="col-12 by_type">
          <p>&nbsp;</p>
          <h6 class="pannel_header"><span>Search By Type</span> </h6>
          @foreach ($types as $item)
            <a href="/cardash/{{$item->name}}/edit"><div class="by_type_cont">
              <img src="/storage/classified/types/{{$item->img}}" alt="">
              <p>{{$item->name}}</p>
          </div></a>
          @endforeach

          <a href="/cardash/ /edit"><div class="by_type_cont">
            <p><i class="fa fa-warning"></i></p>
            <p>Others</p></a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<!-- Appointment -->
{{-- <section class="ftco-intro">
  <div class="container">
    <div class="row no-gutters">
            
      <div id="my_appointment" class="col-md-8 color-3 p-4">
        <h3 class="mb-2">Make an Appointment</h3>
        <form action="#" class="appointment-form">
          <div class="row">
              <div class="col-sm-4">
              <div class="form-group">
                  <div class="select-wrap">
              <div class="icon"><span class="ion-ios-arrow-down"></span></div>
              <select name="" id="" class="form-control">
                <option>Department</option>
                @if (count($department) != 0)
                  @foreach ($department as $dept)
                    <option>{{$dept->dept_name}}</option>
                  @endforeach
                @endif
              </select>
              </div>
                  </div>
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <div class="icon"><span class="icon-user"></span></div>
                  <input type="text" class="form-control" id="appointment_name" placeholder="Name">
                  </div>
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <div class="icon"><span class="icon-paper-plane"></span></div>
                  <input type="text" class="form-control" id="appointment_email" placeholder="Email">
                  </div>
          </div>
          </div>
          <div class="row">
          <div class="col-sm-4">
              <div class="form-group">
                  <div class="icon"><span class="ion-ios-calendar"></span></div>
              <input type="text" class="form-control appointment_date" placeholder="Date">
              </div>    
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <div class="icon"><span class="ion-ios-clock"></span></div>
              <input type="text" class="form-control appointment_time" placeholder="Time">
              </div>
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                  <div class="icon"><span class="icon-phone2"></span></div>
              <input type="text" class="form-control" id="phone" placeholder="Phone">
              </div>
          </div>
          </div>
          
          <div class="form-group">
          <input type="submit" value="Make an Appointment" class="btn btn-primary">
          </div>
        </form>
      </div>
      <div class="col-md-4 color-1 p-4">
        <h3 class="mb-4">Our Contact Details</h3>
        <p>Email:mrJay@pivoapps.net <br>Loc. Las Vegas </p>
        <span class="phone-number">PivoApps</span>
      </div>
    </div>
  </div>
</section> --}}

<!-- Flash Deals -->
@include('inc.flash_deals')


@endsection
    
  