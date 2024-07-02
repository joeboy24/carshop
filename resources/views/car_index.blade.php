
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
    <div style="height: 100px"></div>
  </div>
</section>

<!-- Showcase By Model -->
@include('inc.showcase_searchby')


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
              <a href="/cars/{{$car->id}}"><div class="col_20 car_thumb float-left">
                <img src="https://macademiagroup.com/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" alt="">
                <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                {{-- <p>{{date('s', strtotime($car->created_at))}} Views</p> --}}
                <h5>Price <span>USD&nbsp;{{ number_format($car->price) }}</span></h5>
                @if ($car->status == 'Sold')
                  <h5 class="sold_tag">Sold</h5>
                @endif
              </div></a>
              {{-- <div class="item">
                  <a href="/cars/{{$flash_deals[$i]->id}}"><div class="cust_col car_thumb">
                    <img src="https://macademiagroup.com/storage/classified/cars/{{$flash_deals[$i]->stock_id}}/{{$flash_deals[$i]->gallery[0]->img}}" class="img-responsive">
                    
                    <h3 class="flash_price_tag">PRICE ${{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</h3>
                    
                    <h5 class="flash_tag">{{$flash_deals[$i]->flash}}% off</h5>
                  </div></a>
              </div> --}}
            @endforeach

            <p class="clear_both"></p>
            <a href="/more_cars"><button class="show_more_gray"><i class="fa fa-folder-open">&nbsp;</i>&nbsp;View More</button></a>
          @else
            <div class="alert alert-danger">
              No Records Found
            </div>  
          @endif
        </div>

        <!-- Carousel -->
        {{-- <h6 class="pannel_header2"><span>Vehicle Parts</span> </h6> --}}
        
        @include('inc.carousel4')
        {{-- @include('inc.carousel2') --}}

        <div class="col-12 by_type">
          <p>&nbsp;</p>
          <h6 class="pannel_header"><span>Search By Type</span> </h6>
          @foreach ($types as $item)
            <a href="/cardash/{{$item->name}}/edit"><div class="by_type_cont">
              <img src="https://macademiagroup.com/storage/classified/types/{{$item->img}}" alt="">
              <p>{{$item->name}}</p>
          </div></a>
          @endforeach

          <a href="/cardash/ /edit"><div class="by_type_cont">
            <p><i class="fa fa-warning"></i></p>
            <p>Others</p></a>
          </div>
        </div>

        {{-- @include('inc.carousel3') --}}
        
      </div>
    </div>

  </div>
</section>


<!-- Flash Deals -->
@include('inc.flash_deals')

@endsection
    
  