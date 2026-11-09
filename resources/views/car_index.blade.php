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
      <p class="home_kicker">{{ $companyName }}</p>
      <h1>Find a vehicle</h1>
      <p class="home_lead">Japanese stock. Search by make, type, year, or stock id.</p>
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

      @php $shown = 0; @endphp
      <div class="vehicle_grid vehicle_grid_wide">
        @foreach ($cars as $car)
          @if ($shown < 12 && optional($car->gallery->first())->img)
            @php $shown++; @endphp
            @include('inc.vehicle_card')
          @endif
        @endforeach
      </div>

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
