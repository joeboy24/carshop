
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

  {{-- <div class="login_body"> --}}
    
    <div class="header_space2">
    </div>

    <div class="login_body">
    
    {{-- <div class="row">
      <div class="col-md-8 offset-md-2 login_content">
        123erfd
      </div>
    </div> --}}

      {{-- <div class="row"> --}}
        {{-- <div class="col-md-6"> --}}

          <div class="lock_container">
            <p><i class="fa fa-shopping-basket"></i></p>
          </div>

          <section class="login_content">
            {{-- <div style="height: 50px"></div> --}}
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <input type="text" style="text-align: center" placeholder="Oops..! Cart page temporarily suspended..!" class="login_input" readonly>
            </form>
          </section>

        {{-- </div> --}}

        {{-- <div class="col-md-6">
          <img class="sf_img1" src="/maindir/images/sf3.webp" width="100%" alt="">
          <img class="sf_img2" src="/maindir/images/sf2.jpeg" width="100%" alt="">
        </div>
      </div> --}}

    </div>

  {{-- </div> --}}

@endsection

    
  