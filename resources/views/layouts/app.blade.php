
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MacademiaGroup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/maindir/css/animate.css">
    
    <link rel="stylesheet" href="/maindir/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/maindir/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/maindir/css/magnific-popup.css">

    <link rel="stylesheet" href="/maindir/css/aos.css">

    <link rel="stylesheet" href="/maindir/css/ionicons.min.css">

    <link rel="stylesheet" href="/maindir/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/maindir/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="/maindir/css/flaticon.css">
    <link rel="stylesheet" href="/maindir/css/icomoon.css">
    <link rel="stylesheet" href="/maindir/css/style.css">
    <link rel="stylesheet" href="/maindir/css/car.css">
    <link rel="stylesheet" href="/maindir/css/carousel.css">

    {{-- <link rel="stylesheet" href="/maindir/css/feed_style_clean.css"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    @yield('head')

  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
        @if (session('company') != '')
          <img class="sch_logo" src="/storage/classified/company/{{session('company')->logo}}">
          <a class="navbar-brand" href="/">{{session('company')->abrv}}<span></span>
            <p class="sch_name">{{session('company')->name}}</p>
          </a>
        @else
          <img class="sch_logo" src="/maindir/images/pivo.png">
          <a class="navbar-brand" href="/">Company<span>Name</span>
            <p class="sch_name">Company Fullname Here</p>
          </a>
        @endif
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-align-right"></span>
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">

            @yield('navlist')

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    
      @yield('content')

 
    <!-- New Footer -->
    <section class="my_section1">
      <div class="row">
        <div class="col-md-7 footer_left">
          <div class="row">
            <div class="col-md-3">
              <h6>Company</h6>
              <a href="/"><p>Home</p></a>
              <a href="/about"><p>About Us?</p></a>
              <a href="/how_to_buy"><p>How to buy</p></a>
              {{-- <a href="#"><p>News & Promos</p></a> --}}
              <a href="/services"><p>Services</p></a>
              <a href="/about#contact"><p>Contact</p></a>
            </div>

            <div class="col-md-3 footer_brand">
              <h6>Available</h6>
              @if (count(session('avail')) > 0)
                @foreach (session('avail') as $item)
                  <a href="/cardash/1"><p>{{$item->make->model_name}}</p></a>
                @endforeach
              @else
                <a href="#"><p>Nothing here...</p></a>
              @endif
            </div>

            <div class="col-md-6 footer_cars">
              <h6>About Us</h6>
              @if (session('about'))
                <a href="/about"><p>{{session('about')->title.' '.substr(session('about')->body, 0, 100)}}...</p></a>
              @else
                <a href="#"><p>Text goes here...</p></a>
              @endif
              <!--a href="#"><p>FAQ's</p></a>
              <a href="#"><p>Information</p></a>
              <a href="#"><p>Knowledge Base</p></a-->
            </div>
          </div>
          
        </div>
        
        <div class="col-md-5 footer_right">
          
          @if (session('company') != '')
            <img src="/storage/classified/company/{{session('company')->logo}}" style="width: 60px" alt="">
            <h3 class="ftco-heading-2" style="color: #fff">{{session('company')->abrv}}</h3>
            <p class="home_copyright">Copyright © {{date('Y')}} {{session('company')->abrv}}</p>
            <p class="home_contact">{{session('company')->contact}}</p>
          @endif
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
          </ul>
        </div>
      </div>
    </section>
    
  

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <!-- Modal -->
    <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalRequestLabel">Apply Now</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#">
              <div class="form-group">
                <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
                <input type="text" class="form-control" id="appointment_name" placeholder="Full Name">
              </div>
              <div class="form-group">
                <!-- <label for="appointment_email" class="text-black">Email</label> -->
                <input type="text" class="form-control" id="appointment_email" placeholder="Email">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <!-- <label for="appointment_date" class="text-black">Date</label> -->
                    <input type="text" class="form-control appointment_date" placeholder="Date">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <!-- <label for="appointment_time" class="text-black">Time</label> -->
                    <input type="text" class="form-control appointment_time" placeholder="Time">
                  </div>
                </div>
              </div>
              

              <div class="form-group">
                <!-- <label for="appointment_message" class="text-black">Message</label> -->
                <textarea name="" id="appointment_message" class="form-control" cols="30" rows="5" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Apply Now" class="btn btn-primary">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>


    <script src="/maindir/js/jquery.min.js"></script>
    <script src="/maindir/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/maindir/js/popper.min.js"></script>
    <script src="/maindir/js/bootstrap.min.js"></script>
    <script src="/maindir/js/jquery.easing.1.3.js"></script>
    <script src="/maindir/js/jquery.waypoints.min.js"></script>
    <script src="/maindir/js/jquery.stellar.min.js"></script>
    <script src="/maindir/js/owl.carousel.min.js"></script>
    <script src="/maindir/js/jquery.magnific-popup.min.js"></script>
    <script src="/maindir/js/aos.js"></script>
    <script src="/maindir/js/jquery.animateNumber.min.js"></script>
    <script src="/maindir/js/bootstrap-datepicker.js"></script>
    <script src="/maindir/js/jquery.timepicker.min.js"></script>
    <script src="/maindir/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="/maindir/js/google-map.js"></script>
    <script src="/maindir/js/main.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/65d861b68d261e1b5f645653/1hnajrchk';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script>
    <!--End of Tawk.to Script-->
    
  </body>
</html>
