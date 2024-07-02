
@extends('layouts.app')


@section('navlist')

  <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
  <li class="nav-item active"><a href="/about" class="nav-link">About Us</a></li>
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
    <div style="height: 100px"></div>
</section>

<!-- By Model -->
<section class="by_model">
  <div class="container">
    

    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 by_model_right">

        @include('inc.messages')
        {{-- <div class="key_search">
          <form action="{{ action('CardashController@store') }}" method="POST">
            @csrf
          <p><span>Search &nbsp;</span><i class="fa fa-car"></i></p>
          <input type="text" name="search_veh" placeholder="By Stock ID or Keyword">
          <button type="submit" name="store_action" value="search_veh"><i class="fa fa-search"></i></button>
          </form>
        </div> --}}

        <div class="row">
          <div class="col-md-12">
            <div class="sv_header">

              <h4>Our Services</h4>
              @if (count($services) > 0)
                <div class="row service_cont" id="contact">
                    @foreach ($services as $srv)
                      {{-- <div class="col-md-4">
                        <p class="service_box">
                          @if ($srv->id == 1)
                            <i class="fa fa-car"></i>   
                          @elseif ($srv->id == 2)
                            <i class="fa fa-leaf"></i> 
                          @elseif ($srv->id == 3)
                            <i class="fa fa-cogs"></i> 
                          @else
                            <i class="fa fa-gear"></i> 
                          @endif
                          {{$srv->title}}
                        </p>
                      </div> --}}
                      
                        @if ($srv->id == 1)
                          <a href="/more_makes" class="col-md-4"><div>
                            <p class="service_box">
                                <i class="fa fa-car"></i> 
                                {{$srv->title}}
                            </p>
                          </div></a>
                        @elseif ($srv->id == 2)
                          <a href="/cardash/Truck/edit" class="col-md-4"><div>
                            <p class="service_box">
                              <i class="fa fa-leaf"></i> 
                              {{$srv->title}}
                            </p>
                          </div></a>
                        @elseif ($srv->id == 3)
                          <a href="/more_parts" class="col-md-4"><div>
                            <p class="service_box">
                              <i class="fa fa-cogs"></i> 
                              {{$srv->title}}
                            </p>
                          </div></a>
                        @else
                          <a href="#" class="col-md-4"><div>
                            <p class="service_box">
                              <i class="fa fa-gear"></i> 
                              {{$srv->title}}
                            </p>
                          </div></a>
                        @endif
                    @endforeach
                </div>
              @else
                <div class="alert alert-danger">
                  No Records Found
                </div>  
              @endif

              <p>&nbsp;</p>
              {{-- <h2 class="h4" id="contact">Contact Us</h2> --}}
              <button id="sendMsg" onclick="sendMessage()" type="button" class="btn btn-primary py-3 px-5">CLICK TO SEND US A MESSAGE</button>

              <div class="row">
                <div id="msgForm" class="col-md-8">
                  <form class="container" action="{{ action('CardashController@store') }}" method="POST">
                    @csrf
                      <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                      </div>
                      <div class="form-group">
                        <input type="number" min="0" class="form-control" name="phone" placeholder="Your Phone" required>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Your Email" required>
                      </div>
                      <div class="form-group">
                        <textarea name="message" id="" cols="30" rows="3" class="form-control" placeholder="Message" required></textarea>
                      </div>
                      <div class="form-group">
                        <button type="submit" name="store_action" value="inquire"  class="btn btn-primary py-3 px-5">SEND MESSAGE</button>
                      </div>
                    </form>
                  {{-- <div class="col-md-6 padding20" id="map"></div> --}}
                </div>
                
                <div class="col-md-4">
                  <h2 class="h4">&nbsp;</h2>
                  @if (session('company') != '')
                    <p>{{session('company')->location}}</p>
                    <p><i class="fa fa-phone"></i>&nbsp;&nbsp; <a href="tel://{{session('company')->contact}}">{{session('company')->contact}}</a></p>
                    <p><i class="fa fa-envelope"></i>&nbsp;&nbsp; <a href="mailto:{{session('company')->email}}">{{session('company')->email}}</a></p>
                    <p><i class="fa fa-globe"></i>&nbsp;&nbsp; <a href="#">{{session('company')->website}}</a></p>
                  @endif
                </div>
              </div>

              <script>
                function sendMessage() {
                  document.getElementById('msgForm').style.display = "block";
                  document.getElementById('sendMsg').style.display = "none";
                  // alert('Works')
                }
              </script>

            </div>
          </div>
        
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Flash Deals -->
@include('inc.flash_deals')


@endsection


{{-- Macademia sells all types of used JDM (Japan Domestic Market) passenger vehicles. We focus mainly on newer model vehicles. All our vehicles are between 2017 and 2020 model years. Older vehicles can also be sourced upon customer request.

Macademia Specialises in Hybrid Vehicle (HV) system parts, Electric Vehicle (EV) systems parts and Internal Combustion Engine (ICE) vehicle parts.
We see the future of mobility in EVs and thus we are  focused on Hybrid and Electric vehicles. We repair and rebuild all types of vehicles.

We also export cars and mini trucks from Japan . We  mainly supply Japanese cars such as Toyota, Honda, Nissan, Mazda, Subaru, Mitsubishi, Suzuki and Daihatsu. Macademia specialises in  supplying Japanese auto parts (new parts ) and salvaged to our customers. We take orders from auto  mechanics, wholesalers and individuals.  --}}
    
  