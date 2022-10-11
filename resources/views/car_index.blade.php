
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

<section class="car_header" style="background: url(/maindir/images/picanto/c2.webp); background-size: 100%; height: 750px">
  <div class="container">
    {{-- <img src="/maindir/images/picanto/c2.webp" width="100%" alt=""> --}}
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
              @for ($i = date('Y')-10; $i <= date('Y'); $i++)
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

<!-- Events and News -->
<!--p>&nbsp;</p>
<section class="my_section1 container">
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

<!-- Our Goals -->
{{-- <section class="ftco-section ftco-services">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-2">{{$homepage->goals_header}}</h2>
        <p>{{$homepage->goals_body}}</p>
      </div>
    </div>

    <div class="row">

        @if ($homepage->goal1_title != '')
          @if ($homepage->goal2_title == '' && $homepage->goal3_title == '' && $homepage->goal4_title == '')
            <div class="col-md-10 offset-md-1 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal3_title != '' && $homepage->goal4_title != '' || $homepage->goal2_title != '' && $homepage->goal3_title == '' && $homepage->goal4_title != '' || $homepage->goal2_title != '' && $homepage->goal3_title != '' && $homepage->goal4_title == '')
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal3_title == '' && $homepage->goal4_title != '' || $homepage->goal2_title == '' && $homepage->goal3_title != '' && $homepage->goal4_title == '' || $homepage->goal2_title != '' && $homepage->goal3_title == '' && $homepage->goal4_title == '')
            <div class="col-md-6 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title != '' && $homepage->goal3_title != '' && $homepage->goal4_title != '')
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          @endif
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-anesthesia"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">{{$homepage->goal1_title}}</h3>
                <p>{{$homepage->goal1_text}}</p>
              </div>
            </div>      
          </div>
        @endif

        @if ($homepage->goal2_title != '')
          @if ($homepage->goal1_title == '' && $homepage->goal3_title == '' && $homepage->goal4_title == '')
            <div class="col-md-10 offset-md-1 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal1_title == '' && $homepage->goal3_title != '' && $homepage->goal4_title != '' || $homepage->goal1_title != '' && $homepage->goal3_title == '' && $homepage->goal4_title != '' || $homepage->goal1_title != '' && $homepage->goal3_title != '' && $homepage->goal4_title == '')
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal1_title == '' && $homepage->goal3_title == '' && $homepage->goal4_title != '' || $homepage->goal1_title == '' && $homepage->goal3_title != '' && $homepage->goal4_title == '' || $homepage->goal1_title != '' && $homepage->goal3_title == '' && $homepage->goal4_title == '')
            <div class="col-md-6 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal1_title != '' && $homepage->goal3_title != '' && $homepage->goal4_title != '')
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          @endif
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tooth-1"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">{{$homepage->goal2_title}}</h3>
                <p>{{$homepage->goal2_text}}</p>
              </div>
            </div>    
          </div>
        @endif

        @if ($homepage->goal3_title != '')
          @if ($homepage->goal2_title == '' && $homepage->goal1_title == '' && $homepage->goal4_title == '')
            <div class="col-md-10 offset-md-1 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal1_title != '' && $homepage->goal4_title != '' || $homepage->goal2_title != '' && $homepage->goal1_title == '' && $homepage->goal4_title != '' || $homepage->goal2_title != '' && $homepage->goal1_title != '' && $homepage->goal4_title == '')
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal1_title == '' && $homepage->goal4_title != '' || $homepage->goal2_title == '' && $homepage->goal1_title != '' && $homepage->goal4_title == '' || $homepage->goal2_title != '' && $homepage->goal1_title == '' && $homepage->goal4_title == '')
            <div class="col-md-5 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title != '' && $homepage->goal1_title != '' && $homepage->goal4_title != '')
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          @endif
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tooth-with-braces"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">{{$homepage->goal3_title}}</h3>
                <p>{{$homepage->goal3_text}}</p>
              </div>
            </div>      
          </div>
        @endif

        @if ($homepage->goal4_title != '')
          @if ($homepage->goal2_title == '' && $homepage->goal3_title == '' && $homepage->goal1_title == '')
            <div class="col-md-10 offset-md-1 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal3_title != '' && $homepage->goal1_title != '' || $homepage->goal2_title != '' && $homepage->goal3_title == '' && $homepage->goal1_title != '' || $homepage->goal2_title != '' && $homepage->goal3_title != '' && $homepage->goal1_title == '')
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title == '' && $homepage->goal3_title == '' && $homepage->goal1_title != '' || $homepage->goal2_title == '' && $homepage->goal3_title != '' && $homepage->goal1_title == '' || $homepage->goal2_title != '' && $homepage->goal3_title == '' && $homepage->goal1_title == '')
            <div class="col-md-5 d-flex align-self-stretch ftco-animate">
          @elseif ($homepage->goal2_title != '' && $homepage->goal3_title != '' && $homepage->goal1_title != '')
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          @endif
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-dental-care"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">{{$homepage->goal4_title}}</h3>
                <p>{{$homepage->goal4_text}}</p>
              </div>
            </div>      
          </div>
        @endif

    </div>

  </div>
  <div class="container-wrap mt-5">
    <div class="row d-flex no-gutters">
      <div class="col-md-6 img" style="background-image: url(/storage/classified/system_use/{{$homepage->headteacher_photo}});">
      </div>
      <div class="col-md-6 d-flex">
        <div class="about-wrap">
          <div class="heading-section heading-section-white mb-5 ftco-animate">
            <h2 class="mb-2">{{$homepage->meet_header}}</h2>
            <p>{{$homepage->meet_body}}</p>
          </div>

          @if ($homepage->meet1_title != '')
            <div class="list-services d-flex ftco-animate">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-check2"></span>
              </div>
              <div class="text">
                <h3>{{$homepage->meet1_title}}</h3>
                <p>{{$homepage->meet1_text}}</p>
              </div>
            </div>
          @endif

          @if ($homepage->meet2_title != '')
            <div class="list-services d-flex ftco-animate">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-check2"></span>
              </div>
              <div class="text">
                <h3>{{$homepage->meet2_title}}</h3>
                <p>{{$homepage->meet2_text}}</p>
              </div>
            </div>
          @endif

          @if ($homepage->meet3_title != '')
            <div class="list-services d-flex ftco-animate">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-check2"></span>
              </div>
              <div class="text">
                <h3>{{$homepage->meet3_title}}</h3>
                <p>{{$homepage->meet3_text}}</p>
              </div>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>
</section> --}}

<!-- News -->
<!--section class="ftco-section"> 
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <h2 class="mb-2">CHNTC NEWS</h2>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a href="blog-single.html" class="block-20" style="background-image: url('/storage/classified/Nursing/n4.jpeg');">
            </a>
            <div class="text d-flex py-4">
              <div class="meta mb-3">
                <div><a href="#">Sep. 20, 2018</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <div class="desc pl-3">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry" data-aos-delay="100">
            <a href="blog-single.html" class="block-20" style="background-image: url('/maindir/images/image_2.jpg');">
            </a>
            <div class="text d-flex py-4">
              <div class="meta mb-3">
                <div><a href="#">Sep. 20, 2018</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <div class="desc pl-3">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry" data-aos-delay="200">
            <a href="blog-single.html" class="block-20" style="background-image: url('/storage/classified/Nursing/n6.jpeg');">
            </a>
            <div class="text d-flex py-4">
              <div class="meta mb-3">
                <div><a href="#">Sep. 20, 2018</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <div class="desc pl-3">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section-->

<!-- Achievements -->
<!--section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url('/storage/classified/Nursing/n7.jpeg');" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-3 aside-stretch py-5">
        <div class=" heading-section heading-section-white ftco-animate pr-md-4">
          <h2 class="mb-3">Our History</h2>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
        </div>
      </div>
      <div class="col-md-9 py-5 pl-md-5">
        <div class="row">
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="14">0</strong>
                <span>Years of Experience</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="4500">0</strong>
                <span>Qualified Lecturers</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="4200">0</strong>
                <span>Happy Smiling Customer</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="320">0</strong>
                <span>Patients Per Year</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section-->

<!-- Pricing Section -->
{{-- <section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
        <h2 class="mb-3">Our Best Pricing</h2>
        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 ftco-animate">
        <div class="pricing-entry pb-5 text-center">
          <div>
            <h3 class="mb-4">Basic</h3>
            <p><span class="price">$24.50</span> <span class="per">/ session</span></p>
          </div>
          <ul>
            <li>Diagnostic Services</li>
            <li>Professional Consultation</li>
            <li>Tooth Implants</li>
            <li>Surgical Extractions</li>
            <li>Teeth Whitening</li>
          </ul>
          <p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        </div>
      </div>
      <div class="col-md-3 ftco-animate">
        <div class="pricing-entry pb-5 text-center">
          <div>
            <h3 class="mb-4">Standard</h3>
            <p><span class="price">$34.50</span> <span class="per">/ session</span></p>
          </div>
          <ul>
            <li>Diagnostic Services</li>
            <li>Professional Consultation</li>
            <li>Tooth Implants</li>
            <li>Surgical Extractions</li>
            <li>Teeth Whitening</li>
          </ul>
          <p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        </div>
      </div>
      <div class="col-md-3 ftco-animate">
        <div class="pricing-entry active pb-5 text-center">
          <div>
            <h3 class="mb-4">Premium</h3>
            <p><span class="price">$54.50</span> <span class="per">/ session</span></p>
          </div>
          <ul>
            <li>Diagnostic Services</li>
            <li>Professional Consultation</li>
            <li>Tooth Implants</li>
            <li>Surgical Extractions</li>
            <li>Teeth Whitening</li>
          </ul>
          <p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        </div>
      </div>
      <div class="col-md-3 ftco-animate">
        <div class="pricing-entry pb-5 text-center">
          <div>
            <h3 class="mb-4">Platinum</h3>
            <p><span class="price">$89.50</span> <span class="per">/ session</span></p>
          </div>
          <ul>
            <li>Diagnostic Services</li>
            <li>Professional Consultation</li>
            <li>Tooth Implants</li>
            <li>Surgical Extractions</li>
            <li>Teeth Whitening</li>
          </ul>
          <p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        </div>
      </div>
    </div>
  </div>
</section> --}}

<!-- Newsletter -->
{{-- <section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12">
        <div class="col-md-8 offset-md-2 text-center heading-section heading-section-white ftco-animate">
          <h2>Subcribe to our Newsletter</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
          <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8">
              <form action="{{ action('GuestPagesController@store') }}" class="subscribe-form" method="POST">
                @csrf
                <div class="form-group d-flex">
                  <input type="email" name="email" class="form-control" placeholder="Enter email address">
                  <input type="submit" name="store_action" value="Subscribe" class="submit px-3" onclick="alert('Subscription Successful!')">
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}

{{-- <div id="map"></div> --}}


@endsection
    
  