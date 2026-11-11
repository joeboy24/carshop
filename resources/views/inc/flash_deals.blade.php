<section class="home_band home_band_white">
  <div class="container">
    <div class="home_head">
      <h2>Flash deals</h2>
      <a href="/more_flash">View more</a>
    </div>
    @php
      $flashWithPhotos = collect($flash_deals ?? [])->filter(function ($deal) {
          return optional($deal->gallery->first())->img;
      })->values();
    @endphp
    @if ($flashWithPhotos->count() > 0)
      <div class="vehicle_grid vehicle_grid_wide">
        @foreach ($flashWithPhotos->take(6) as $car)
          @include('inc.vehicle_card')
        @endforeach
      </div>
    @else
      <p class="home_empty">No flash deals right now.</p>
    @endif
  </div>
</section>
