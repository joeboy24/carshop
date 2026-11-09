

<section class="by_model {{ !empty($homeLayout) ? 'home_band home_band_white' : '' }}">
    <div class="container">
      @if (empty($homeLayout))
      <div class="row">
        <div class="col-md-2 by_model_left">
        </div>
  
        <div class="col-md-10 by_model_right">
  
          <div class="col-12">
      @endif

            @if (!empty($homeLayout))
            <div class="home_head">
              <h2>Flash deals</h2>
              <a href="/more_flash">View more</a>
            </div>
            @else
            <h6 class="pannel_header2"><span>Flash Deals</span> </h6>
            @endif
            @php
              $flashWithPhotos = collect($flash_deals ?? [])->filter(function ($deal) {
                  return optional($deal->gallery->first())->img;
              })->values();
            @endphp
            @if ($flashWithPhotos->count() > 0)
            <div class="vehicle_grid">
              @foreach ($flashWithPhotos->take(4) as $car)
                @include('inc.vehicle_card')
              @endforeach
            </div>
            @if (empty($homeLayout))
            <a class="show_more_gray" href="/more_flash">View more</a>
            @endif
            @else
            <p class="home_empty">No flash deals right now.</p>
            @endif
      @if (empty($homeLayout))
        </div>
      </div>
      </div>
      @endif
    </div>
</section>