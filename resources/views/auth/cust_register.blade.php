
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
    <div class="header_space">
      <div class="header_space_btm">
        <div class="inner_cont">
          {{-- <div class="cust_wdiv"> --}}
            <button class="cust_logout_btn"><i class="fa fa-sign-out"></i> Logout</button>
            <h6><span>Welcome! </span> Patric Ola Yawson</h6>
          {{-- </div> --}}
          <button class="sub_menu_btn dropdown">Menu&nbsp;&nbsp;<i class="fa fa-th-large"></i>
          <div class="dropdown-content">
            <a href="/cust_dashboard"><i class="fa fa-th-large li_icon"></i>&nbsp;&nbsp; Dashboard</a>
            <a href="/cust_invoice"><i class="fa fa-file-text li_icon"></i>&nbsp;&nbsp; Invoice</a>
            <a href="/cust_quotes"><i class="fa fa-suitcase li_icon"></i>&nbsp;&nbsp; Quotes</a>
            <a href="/cust_account"><i class="fa fa-unlock-alt li_icon"></i>&nbsp;&nbsp;&nbsp; Account</a>
          </div></button>

          <button class="sub_menu_btn hide">Account</button>
          <button class="sub_menu_btn hide">Quotes</button>
          <button class="sub_menu_btn hide">Invoice</button>
          <button class="sub_menu_btn hide">Dashboard</button>
        </div>
      </div>
    </div>

    <div class="login_body">

      {{-- <div class="row"> --}}
        {{-- <div class="col-md-6"> --}}

          <div class="lock_container">
            <p><i class="fa fa-unlock-alt"></i></p>
          </div>

          <section class="login_content">
            {{-- <div style="height: 50px"></div> --}}
            
            <form method="POST" action="{{ action('CardashController@store') }}">
              @csrf

              <input placeholder="Name" id="" type="text" class="@error('email') is-invalid @enderror login_input" name="name" value="{{ old('name') }}" required autocomplete="email" autofocus>
              <input placeholder="Phone" id="" type="number" min="0" maxlength="14" class="login_input" name="email" value="{{ old('phone') }}" required autocomplete="phone">
              <input placeholder="Email" id="email" type="text" class="@error('email') is-invalid @enderror login_input" name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

              <input placeholder="Password" id="" type="password" class="@error('password') is-invalid @enderror login_input" name="password" required autocomplete="current-password">
              <input placeholder="Confirm Password" id="" type="password" class="@error('password') is-invalid @enderror login_input" name="password" required>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror

              <div class="login_btn_container">
                <button type="submit" name="store_action" value="cust_register" class="login_btn">Register</button>
              </div>

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

    
  