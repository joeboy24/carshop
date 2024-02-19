
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

<section class="car_header" style="background: rgb(53, 53, 53); background-size: 100%">
  <div class="container">
    {{-- <img src="/maindir/images/picanto/c2.jpeg" width="100%" alt=""> --}}
    <div style="height: 100px"></div>
    {{-- <div class="row">
      <div class="col2_25">
        <select class="search_sel" name="make" id="">
          <option value="">Select Make</option>
          <option value="">2</option>
          <option value="">3</option>
        </select>
      </div>

      <div class="col2_25">
        <select class="search_sel" name="make" id="">
          <option value="">Select Category</option>
          <option value="">2</option>
          <option value="">3</option>
        </select>
      </div>

      <div class="col2_25">
        <select class="search_sel" name="make" id="">
          <option value="">Select Model</option>
          <option value="">2</option>
          <option value="">3</option>
        </select>
      </div>

      <div class="col2_25">
        <select class="search_sel" name="make" id="">
          <option value="">Select Type</option>
          <option value="">2</option>
          <option value="">3</option>
        </select>
      </div>

      <div class="col2_25">
        <select class="search_sel" name="make" id="">
          <option value="">Select Steering</option>
          <option value="">2</option>
          <option value="">3</option>
        </select>
      </div>

      <div class="col2_25">
        <div class="double_select">
          <select class="ds ds1" name="make" id="">
            <option value="">From Year</option>
            <option value="">2</option>
            <option value="">3</option>
          </select>

          <select class="ds ds2" name="make" id="">
            <option value="">To Year</option>
            <option value="">2</option>
            <option value="">3</option>
          </select>
        </div>
      </div>

      <div class="col2_25">
        <div class="">
            <input class="search_input ds1" type="text" name="min_price" placeholder="Min Price">
            <input class="search_input ds2" type="text" name="max_price" placeholder="Max Price" id="">
          </select>
        </div>
      </div>

      <div class="col2_25">
        <button type="button" class="sb_btn2"><i class="fa fa-search"></i>&nbsp; Search</button>
      </div>
      
    </div> --}}
  </div>
</section>

<!-- Showcase By Model -->
@include('inc.showcase_searchby')

<!-- By Model -->
<section class="by_model">
  <div class="container">
    

    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 by_model_right">
        
        <div class="key_search">
          <form action="{{ action('CardashController@store') }}" method="POST">
            @csrf
          <p><span>Search &nbsp;</span><i class="fa fa-car"></i></p>
          <input type="text" name="search_veh" placeholder="By Stock ID or Keyword">
          <button type="submit" name="store_action" value="search_veh"><i class="fa fa-search"></i></button>
          </form>
        </div>

        <div class="col-12">

          @if (count($cars) != 0)
            @foreach ($cars as $car)
              @if ($car->flash == 0)
                <a href="/cars/{{$car->id}}"><div class="col_20 car_thumb">
                  <img src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" alt="">
                  {{-- <img class="car_prev" src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" width="100" alt=""> --}}
                  <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                  <p>{{date('s', strtotime($car->created_at))}} Views</p>
                  <h5>Price <span>USD&nbsp;{{ number_format($car->price) }}</span></h5>
                </div></a>
              @else
                <a href="/cars/{{$car->id}}"><div class="col_25 car_thumb">
                  <img src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" alt="">
                  <h5 class="flash_tag">{{$car->flash}}% off</h5>
                  <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                  <p>{{date('s', strtotime($car->created_at))}} Views</p>
                  <h5>Price <span>USD&nbsp;{{ number_format($car->price+(($car->flash/100)*$car->price)) }}</span></h5>
                </div></a>
              @endif
            @endforeach
          @else
            <div class="alert alert-danger">
              No Records Found
            </div>  
          @endif

          <p class="clear_both"></p>
          {{$cars->links()}}
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

<!-- Flash Deals -->
@include('inc.flash_deals')

<!-- Events and News -->
<p>&nbsp;</p>
<!--section class="my_section1 container">
  <h6 class="pannel_header"><span>Our Promos & Blog</span> </h6>
  <div class="row">
    <div class="col-md-4 events">
      {{-- <div class="col-md-8 offset-md-4 heading-section ftco-animate">
        <h2 class="mb-2 float_right"><i class="fa fa-events"></i> Events</h2>
      </div> --}}
      <p class="events_line"></p>

      <div class="row">
        <div class="event_date_container">
          <p class="event_day">{{ date('d', strtotime(date('d-m-Y'))) }}<span></span></p>
          <p class="event_month">{{ date('M', strtotime(date('d-m-Y'))) }}</p>
        </div>
        <div class="event_container">
          <img src="/maindir/images/picanto/2.jpeg" width="100%">
          <p class="event_text">Title</p>
          <p class="clock_map"><i class="fa fa-clock-o">&nbsp;&nbsp;&nbsp;</i>{{date('d-m-Y')}}</p>
          <p class="clock_map"><i class="fa fa-map-marker">&nbsp;&nbsp;&nbsp;&nbsp;</i>Dallas</p>
          <a href="/all_events"><p class="myA">View more...</p></a>
        </div>
      </div>

    </div>

    <div class="col-md-8 events_right">
      {{-- <div class="col-md-8 heading-section ftco-animate">
        <h2 class="mb-2">News & Updates</h2>
      </div> --}}
      <p class="events_right_line"></p>
      <div class="row">
        {{-- @foreach (session('newsblog6') as $blog) --}}
          <a href="/guestpages/{{ 1 }}"><div class="col-md-5 block-21 mb-4 d-flex events_right_div">
              <a href="/guestpages/{{ 1 }}" class="blog-img mr-4" style="background-image: url(/maindir/images/picanto/1.jpeg); border-radius: 5px"></a>
              <div class="text">
                  <h3 class="heading"><a href="/guestpages/{{ 1 }}"> <b>Honda Give Away...</b></a></h3>
                  <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> {{ date('d-m-Y') }}</a></div>
                  <div><a href="#"><span class="icon-chat"></span> {{ 3 }}</a></div>
                  </div>
              </div>
          </div></a>

          <a href="/guestpages/{{ 1 }}"><div class="col-md-5 block-21 mb-4 d-flex events_right_div">
            <a href="/guestpages/{{ 1 }}" class="blog-img mr-4" style="background-image: url(/maindir/images/picanto/8.jpeg); border-radius: 5px"></a>
            <div class="text">
                <h3 class="heading"><a href="/guestpages/{{ 1 }}"> <b>Honda Give Away...</b></a></h3>
                <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> {{ date('d-m-Y') }}</a></div>
                <div><a href="#"><span class="icon-chat"></span> {{ 3 }}</a></div>
                </div>
            </div>
        </div></a>

        <a href="/guestpages/{{ 1 }}"><div class="col-md-5 block-21 mb-4 d-flex events_right_div">
          <a href="/guestpages/{{ 1 }}" class="blog-img mr-4" style="background-image: url(/maindir/images/picanto/1.jpeg); border-radius: 5px"></a>
          <div class="text">
              <h3 class="heading"><a href="/guestpages/{{ 1 }}"> <b>Honda Give Away...</b></a></h3>
              <div class="meta">
              <div><a href="#"><span class="icon-calendar"></span> {{ date('d-m-Y') }}</a></div>
              <div><a href="#"><span class="icon-chat"></span> {{ 3 }}</a></div>
              </div>
          </div>
      </div></a>

      <a href="/guestpages/{{ 1 }}"><div class="col-md-5 block-21 mb-4 d-flex events_right_div">
        <a href="/guestpages/{{ 1 }}" class="blog-img mr-4" style="background-image: url(/maindir/images/picanto/8.jpeg); border-radius: 5px"></a>
        <div class="text">
            <h3 class="heading"><a href="/guestpages/{{ 1 }}"> <b>Honda Give Away...</b></a></h3>
            <div class="meta">
            <div><a href="#"><span class="icon-calendar"></span> {{ date('d-m-Y') }}</a></div>
            <div><a href="#"><span class="icon-chat"></span> {{ 3 }}</a></div>
            </div>
        </div>
    </div></a>
        {{-- @endforeach --}}
      </div>
        <a href="/news"><button type="button" class="btn_red_inverse">Load More</button></a>
    </div>
  </div>
</section-->


@endsection
    
  