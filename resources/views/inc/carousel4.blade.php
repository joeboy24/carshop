

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
            @php
              $shopDb = [];
              foreach ($parts as $part) {
                  if (optional($part->gallery->first())->img) {
                      $shopDb[] = $part;
                  }
              }
              $shopFolder = $partUrls ?? [];
              $shopLimit = !empty($homeLayout) ? 5 : count($shopDb);
              $shopItems = [];
              if (!empty($homeLayout) && $shopFolder) {
                  $dbTake = min(count($shopDb), intdiv($shopLimit, 2));
                  $folderTake = min(count($shopFolder), $shopLimit - $dbTake);
                  if ($dbTake + $folderTake < $shopLimit) {
                      $dbTake = min(count($shopDb), $shopLimit - $folderTake);
                  }
                  $dbPool = $shopDb;
                  $folderPool = $shopFolder;
                  shuffle($dbPool);
                  shuffle($folderPool);
                  foreach (array_slice($dbPool, 0, $dbTake) as $part) {
                      $shopItems[] = ['type' => 'db', 'part' => $part];
                  }
                  foreach (array_slice($folderPool, 0, $folderTake) as $url) {
                      $shopItems[] = ['type' => 'file', 'url' => $url];
                  }
                  shuffle($shopItems);
              } else {
                  foreach (array_slice($shopDb, 0, $shopLimit) as $part) {
                      $shopItems[] = ['type' => 'db', 'part' => $part];
                  }
              }
              $partsShown = count($shopItems);
            @endphp
            <div class="vehicle_grid {{ !empty($homeLayout) ? 'vehicle_grid_parts' : '' }}">
            @foreach ($shopItems as $item)
              @if ($item['type'] === 'db')
                @php
                  $part = $item['part'];
                  $partPhoto = $part->gallery->first()->img;
                @endphp
                <a class="vehicle_card" href="/more_parts">
                    <span class="vehicle_card_photo">
                      <img src="{{ \App\Support\Media::url('classified/cars/'.$part->stock_id.'/'.$partPhoto) }}" alt="">
                    </span>
                    <span class="vehicle_card_name">{{ $part->vwidth }}</span>
                    @if ((float) $part->price > 0)
                      <span class="vehicle_card_price">Price <strong>USD {{ number_format((float) $part->price) }}</strong></span>
                    @endif
                </a>
              @else
                <button type="button" class="vehicle_card part_card" data-part="{{ $item['url'] }}">
                  <span class="vehicle_card_photo">
                    <img src="{{ $item['url'] }}" alt="">
                  </span>
                  <span class="vehicle_card_name">Parts</span>
                  <span class="vehicle_card_price">View photos</span>
                </button>
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