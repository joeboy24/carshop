
@extends('layouts.app')



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

    
  