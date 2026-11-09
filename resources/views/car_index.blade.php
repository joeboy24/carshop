@extends('layouts.app')

@section('content')
@php
  $companyName = optional(session('company'))->name ?: 'Vehicles and parts';
  $withPhoto = collect($cars ?? [])->filter(function ($car) {
      return optional($car->gallery->first())->img;
  })->values();
  $heroCar = $withPhoto->get(2) ?: $withPhoto->first();
  $heroUrl = $heroCar
      ? \App\Support\Media::url('classified/cars/'.$heroCar->stock_id.'/'.$heroCar->gallery->first()->img)
      : null;
@endphp

<div class="home">
  <section class="home_hero" @if ($heroUrl) style="background-image: url('{{ $heroUrl }}')" @endif>
    <div class="container home_hero_copy">
      <p class="home_kicker">
        <span class="home_kicker_full">{{ $companyName }}</span>
        <span class="home_kicker_short">{{ optional(session('company'))->abrv ?: $companyName }}</span>
      </p>
      <h1>Find a vehicle</h1>
      <p class="home_lead">Search vehicle or parts <span class="home_lead_break"></span>By make, type, year, or stock id.</p>
    </div>
    <div class="container">
      @include('inc.vehicle_search')
    </div>
  </section>

  <section class="home_makes">
    <div class="container">
      <div class="home_makes_row">
        @foreach ($makes as $item)
          <a class="home_make" href="/cardash/{{ $item->id }}">
            <img src="{{ \App\Support\Media::url('classified/makes/'.$item->logo) }}" alt="">
            <span>{{ $item->model_name }}</span>
          </a>
        @endforeach
        <a class="home_make home_make_more" href="/more_makes">All makes</a>
      </div>
    </div>
  </section>

  <section class="home_band">
    <div class="container">
      <div class="home_head">
        <h2>Promoted vehicles</h2>
        <a href="/more_cars">View more</a>
      </div>

      @php
        $partDir = storage_path('app/public/classified/maca-parts');
        $partUrls = [];
        if (is_dir($partDir)) {
            foreach (scandir($partDir) as $partFile) {
                if (preg_match('/\.(jpe?g|png|webp|gif)$/i', $partFile)) {
                    $partUrls[] = '/storage/classified/maca-parts/'.rawurlencode($partFile);
                }
            }
            sort($partUrls, SORT_NATURAL);
        }

        $promoCars = [];
        foreach ($cars as $car) {
            if (count($promoCars) >= 12) {
                break;
            }
            if (optional($car->gallery->first())->img) {
                $promoCars[] = $car;
            }
        }

        $promoItems = [];
        if ($partUrls) {
            $target = 18;
            $partSlots = min(count($partUrls), max(6, $target - count($promoCars)));
            $carSlots = min(count($promoCars), max(0, $target - $partSlots));
            $pool = $partUrls;
            shuffle($pool);
            $picked = array_slice($pool, 0, $partSlots);
            $usedCars = array_slice($promoCars, 0, $carSlots);
            foreach ($usedCars as $car) {
                $promoItems[] = ['type' => 'car', 'car' => $car];
            }
            foreach ($picked as $url) {
                $promoItems[] = ['type' => 'part', 'url' => $url];
            }
            shuffle($promoItems);
        } else {
            foreach ($promoCars as $car) {
                $promoItems[] = ['type' => 'car', 'car' => $car];
            }
        }
        $shown = count($promoItems);
      @endphp
      <div class="vehicle_grid vehicle_grid_wide">
        @foreach ($promoItems as $promo)
          @if ($promo['type'] === 'car')
            @php $car = $promo['car']; @endphp
            @include('inc.vehicle_card')
          @else
            <button type="button" class="vehicle_card part_card" data-part="{{ $promo['url'] }}">
              <span class="vehicle_card_photo">
                <img src="{{ $promo['url'] }}" alt="">
              </span>
              <span class="vehicle_card_name">Parts</span>
              <span class="vehicle_card_price">View photos</span>
            </button>
          @endif
        @endforeach
      </div>

      @if ($partUrls)
        <div class="part_modal" id="part_modal" hidden>
          <div class="part_modal_backdrop" data-part-close></div>
          <div class="part_modal_panel" role="dialog" aria-modal="true" aria-label="Part photo">
            <button type="button" class="part_modal_close" data-part-close aria-label="Close">&times;</button>
            <img class="part_modal_photo" alt="">
            <div class="part_modal_thumbs"></div>
          </div>
        </div>
        <script type="application/json" id="part_photos">@json($partUrls)</script>
        <script>
          (function () {
            var photos = JSON.parse(document.getElementById('part_photos').textContent);
            var modal = document.getElementById('part_modal');
            var main = modal.querySelector('.part_modal_photo');
            var thumbs = modal.querySelector('.part_modal_thumbs');

            function seed(str) {
              var h = 2166136261;
              for (var i = 0; i < str.length; i++) {
                h ^= str.charCodeAt(i);
                h = Math.imul(h, 16777619);
              }
              return h >>> 0;
            }

            function pickSet(current) {
              var pool = photos.filter(function (url) { return url !== current; });
              var state = seed(current) || 1;
              function rand() {
                state = (state + 0x6D2B79F5) | 0;
                var t = Math.imul(state ^ (state >>> 15), 1 | state);
                t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
                return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
              }
              for (var i = pool.length - 1; i > 0; i--) {
                var j = Math.floor(rand() * (i + 1));
                var swap = pool[i];
                pool[i] = pool[j];
                pool[j] = swap;
              }
              return [current].concat(pool.slice(0, 4));
            }

            function show(url) {
              main.src = url;
              [].forEach.call(thumbs.children, function (button) {
                button.classList.toggle('is_on', button.getAttribute('data-part') === url);
              });
            }

            function open(url) {
              thumbs.innerHTML = '';
              pickSet(url).forEach(function (thumbUrl) {
                var button = document.createElement('button');
                button.type = 'button';
                button.setAttribute('data-part', thumbUrl);
                var img = document.createElement('img');
                img.src = thumbUrl;
                img.alt = '';
                button.appendChild(img);
                button.addEventListener('click', function () { show(thumbUrl); });
                thumbs.appendChild(button);
              });
              show(url);
              modal.hidden = false;
              document.body.classList.add('part_modal_open');
            }

            function close() {
              modal.hidden = true;
              main.removeAttribute('src');
              document.body.classList.remove('part_modal_open');
            }

            document.querySelectorAll('.part_card').forEach(function (card) {
              card.addEventListener('click', function () {
                open(card.getAttribute('data-part'));
              });
            });
            modal.querySelectorAll('[data-part-close]').forEach(function (el) {
              el.addEventListener('click', close);
            });
            document.addEventListener('keydown', function (event) {
              if (event.key === 'Escape' && !modal.hidden) close();
            });
          })();
        </script>
      @endif

      @if ($shown === 0)
        <p class="home_empty">No promoted vehicles right now. Try a make or a stock id.</p>
      @endif
    </div>
  </section>

  <section class="home_band home_band_white">
    <div class="container">
      @include('inc.carousel4', ['homeLayout' => true])
    </div>
  </section>

  <section class="home_band">
    <div class="container">
      <div class="home_head">
        <h2>Search by type</h2>
      </div>
      <div class="by_type">
        @foreach ($types as $item)
          <a href="/cardash/{{ $item->name }}/edit">
            <div class="by_type_cont">
              <img src="{{ \App\Support\Media::url('classified/types/'.$item->img) }}" alt="">
              <p>{{ $item->name }}</p>
            </div>
          </a>
        @endforeach
        <a href="/cardash/ /edit">
          <div class="by_type_cont">
            <span class="type_mark"></span>
            <p>Others</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  @include('inc.flash_deals', ['homeLayout' => true])
</div>
@endsection
