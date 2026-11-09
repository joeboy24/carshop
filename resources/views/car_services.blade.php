
@extends('layouts.app')


 

@section('content')

@include('inc.showcase_searchby')

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

        <div class="page_panel">
          <div class="home_head">
            <h2>Our services</h2>
          </div>

          @if (count($services) > 0)
            <div class="service_grid">
              @foreach ($services as $srv)
                @php
                  if ($srv->id == 1) {
                      $serviceHref = '/more_makes';
                      $serviceIcon = 'fa-car';
                  } elseif ($srv->id == 2) {
                      $serviceHref = '/cardash/Truck/edit';
                      $serviceIcon = 'fa-leaf';
                  } elseif ($srv->id == 3) {
                      $serviceHref = '/more_parts';
                      $serviceIcon = 'fa-cogs';
                  } else {
                      $serviceHref = '/contact';
                      $serviceIcon = 'fa-gear';
                  }
                @endphp
                <a class="service_tile" href="{{ $serviceHref }}">
                  <i class="fa {{ $serviceIcon }}"></i>
                  <span>{{ $srv->title }}</span>
                </a>
              @endforeach
            </div>
          @else
            <p class="home_empty">No services listed right now.</p>
          @endif

          <div class="service_contact">
            <div class="service_details">
              @if (session('company'))
                @if (session('company')->location)
                  <p>{{ session('company')->location }}</p>
                @endif
                @if (session('company')->contact)
                  <p><i class="fa fa-phone"></i> <a href="tel:{{ preg_replace('/[^\d+]/', '', strtok(session('company')->contact, '/')) }}">{{ session('company')->contact }}</a></p>
                @endif
                @if (session('company')->email)
                  <p><i class="fa fa-envelope"></i> <a href="mailto:{{ session('company')->email }}">{{ session('company')->email }}</a></p>
                @endif
                @if (session('company')->website)
                  <p><i class="fa fa-globe"></i> <a href="{{ session('company')->website }}" target="_blank" rel="noopener">{{ preg_replace('#^https?://#', '', rtrim(session('company')->website, '/')) }}</a></p>
                @endif
              @endif
            </div>
            <button id="sendMsg" onclick="sendMessage()" type="button" class="service_msg">Send a message</button>

            <form id="msgForm" class="service_form" action="{{ action('CardashController@store') }}" method="POST">
              @csrf
              <input type="text" name="name" placeholder="Your name" required>
              <input type="number" min="0" name="phone" placeholder="Your phone" required>
              <input type="text" name="email" placeholder="Your email" required>
              <textarea name="message" rows="3" placeholder="Message" required></textarea>
              <button type="submit" name="store_action" value="inquire">Send message</button>
            </form>
          </div>

          <script>
            function sendMessage() {
              document.getElementById('msgForm').style.display = 'grid';
              document.getElementById('sendMsg').style.display = 'none';
            }
          </script>
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
    
  