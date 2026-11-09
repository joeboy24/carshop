

{{-- <section class="by_model">
    <div class="container">
      <div class="row">
        <div class="col-md-2 by_model_left">
        </div>
  
        <div class="col-md-10 by_model_right"> --}}
  
          @if (empty($homeLayout))
          <div class="col-12">
            <h6 class="pannel_header2"><span>Shop Vehicle Parts</span> </h6>
          @else
            <div class="home_head">
              <h2>Shop vehicle parts</h2>
              <a href="/more_parts">View all</a>
            </div>
          @endif
            @php $partsShown = 0; @endphp
            <div class="vehicle_grid">
            @foreach ($parts as $part)
              @php $partPhoto = optional($part->gallery->first())->img; @endphp
              @if ($partPhoto)
                @php $partsShown++; @endphp
                <a class="vehicle_card" href="/more_parts">
                    <span class="vehicle_card_photo">
                      <img src="{{ \App\Support\Media::url('classified/cars/'.$part->stock_id.'/'.$partPhoto) }}" alt="">
                    </span>
                    <span class="vehicle_card_name">{{ $part->vwidth }}</span>
                    @if ((float) $part->price > 0)
                      <span class="vehicle_card_price">Price <strong>USD {{ number_format((float) $part->price) }}</strong></span>
                    @endif
                </a>
              @endif
            @endforeach
            </div>
            @if ($partsShown === 0)
              <p class="home_empty">No parts listed right now.</p>
            @elseif (empty($homeLayout))
              <a class="show_more_gray" href="/more_parts">View all</a>
            @endif
          @if (empty($homeLayout))
        </div>
          @endif

      {{-- </div>
    </div>
</section> --}}