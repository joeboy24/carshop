
@extends('layouts.app')


@section('navlist')

  <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
  <li class="nav-item dropbtn"><a href="/about" class="nav-link">Why Choose Us</a></li>
  <li class="nav-item dropbtn"><a href="/how_to_buy" class="nav-link">How to buy</a></li>
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
  <li class="nav-item"><a href="/about#contact" class="nav-link">Contact</a></li>
  {{-- <li class="nav-item"><a href="/gallery" class="nav-link">Gallery</a></li> --}}
  <li class="nav-item cta"><a href="/cart" class="nav-link"><i class="fa fa-shopping-basket color8"></i>&nbsp;&nbsp;<span>Cart</span></a></li>
	        
@endsection


@section('content')

<section class="car_header" style="background: rgb(53, 53, 53); background-size: 100%">
  <div class="container">
    <div style="height: 100px"></div>
  </div>
</section>

<!-- Showcase By Model -->
<section class="showcase_searchby">
  <div class="container">
    <form action="{{ action('CarsController@index') }}">
      {{-- @csrf --}}
      <div class="row">
        <div class="col2_25">
          <select class="search_sel" name="make" id="">
            <option value="0">Select Make</option>
            @foreach ($makes as $item)
              <option value="{{$item->id}}">{{$item->model_name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col2_25">
          <select class="search_sel" name="type" id="">
            <option value="0">Type</option>
            @foreach ($types as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col2_25">
          <select class="search_sel" name="trans" id="">
            <option value="0">Transmission</option>
            <option value="Auto">Automatic</option>
            <option>Manual</option>
          </select>
        </div>

        <div class="col2_25">
          <select class="search_sel" name="steer" id="">
            <option value="0">Steering</option>
            <option value="Lhd">Left Hand Drive</option>
            <option value="Rhd">Right Hand Drive</option>
          </select>
        </div>

        <div class="col2_25">
          <select class="search_sel" name="color" id="">
            <option value="0">Color</option>
            @if (session('car_color'))
              @foreach (session('car_color') as $item)
                <option>{{$item->color}}</option>
              @endforeach
            @endif
          </select>
        </div>

        <div class="col2_25">
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
        </div>

        <div class="col2_25">
          <div class="">
            <input class="search_input ds1" type="number" min="0" name="min_price" placeholder="Min Price">
            <input class="search_input ds2" type="number" min="0" name="max_price" placeholder="Max Price" id="">
          </div>
        </div>

        <div class="col2_25">
          <button type="submit" class="sb_btn2"><i class="fa fa-search"></i>&nbsp; Search</button>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- By Model -->
<section class="more_makes">
  <div class="container">
    <div class="row">
      @foreach ($makes as $item)
        <div class="col_make">
          <a href="/cardash/{{$item->id}}"><p class="model_name2">
            <img src="/storage/classified/makes/{{$item->logo}}" alt=""><br>
            <span>{{$item->model_name}}</span></p>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>



@endsection
    
  