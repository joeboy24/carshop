
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
            <h2>Contact</h2>
          </div>

          <div class="contact_grid">
            <form class="contact_form" action="{{ action('CardashController@store') }}" method="POST">
              @csrf
              @include('inc.inquiry_guard')
              <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required>
              <input type="number" min="0" name="phone" placeholder="Your phone" value="{{ old('phone') }}" required>
              <input type="email" name="email" placeholder="Your email" value="{{ old('email') }}" required>
              <textarea name="message" rows="4" placeholder="Message" required>{{ old('message') }}</textarea>
              <button type="submit" class="contact_send" name="store_action" value="inquire">Send message</button>
              <div class="contact_confirm" hidden>
                <p>Confirm this message before it is sent.</p>
                <div class="contact_actions">
                  <button type="submit" name="store_action" value="inquire">Confirm and send</button>
                  <button type="button" class="contact_back">Keep editing</button>
                </div>
              </div>
            </form>

            <div class="about_card service_details">
              @if (session('company'))
                @if (session('company')->location)
                  <p>{{ session('company')->location }}</p>
                @endif
                @if (session('company')->comp_add)
                  <p>{{ session('company')->comp_add }}</p>
                @endif
                @foreach (preg_split('/\s*\/\s*/', session('company')->contact ?? '') as $phone)
                  @if (trim($phone) !== '')
                    <p><i class="fa fa-phone"></i> <a href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">{{ trim($phone) }}</a></p>
                  @endif
                @endforeach
                @if (session('company')->email)
                  <p><i class="fa fa-envelope"></i> <a href="mailto:{{ session('company')->email }}">{{ session('company')->email }}</a></p>
                @endif
                @if (session('company')->website)
                  <p><i class="fa fa-globe"></i> <a href="{{ session('company')->website }}" target="_blank" rel="noopener">{{ preg_replace('#^https?://#', '', rtrim(session('company')->website, '/')) }}</a></p>
                @endif
              @endif
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
    
  