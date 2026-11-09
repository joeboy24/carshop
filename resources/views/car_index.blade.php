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
      <div class="home_finder">
        <form class="home_keyword" action="{{ action('CardashController@store') }}" method="POST">
          @csrf
          <input type="text" name="search_veh" placeholder="Stock id or keyword">
          <button type="submit" name="store_action" value="search_veh">Search</button>
        </form>
        <form class="home_fields" action="{{ action('CarsController@index') }}">
          <select name="make">
            <option value="0">Make</option>
            @foreach ($makes as $item)
              <option value="{{ $item->id }}">{{ $item->model_name }}</option>
            @endforeach
          </select>
          <select name="type">
            <option value="0">Type</option>
            @foreach ($types as $item)
              <option>{{ $item->name }}</option>
            @endforeach
          </select>
          <select name="trans">
            <option value="0">Transmission</option>
            <option value="Auto">Automatic</option>
            <option>Manual</option>
          </select>
          <select name="steer">
            <option value="0">Steering</option>
            <option value="Lhd">Left hand drive</option>
            <option value="Rhd">Right hand drive</option>
          </select>
          <select name="color">
            <option value="0">Color</option>
            @if (session('car_color'))
              @foreach (session('car_color') as $item)
                <option>{{ $item->color }}</option>
              @endforeach
            @endif
          </select>
          <select name="from">
            <option value="0">From year</option>
            @for ($i = date('Y') - 25; $i <= date('Y'); $i++)
              <option>{{ $i }}</option>
            @endfor
          </select>
          <select name="to">
            <option value="{{ date('Y') }}">To year</option>
            @for ($i = date('Y') - 24; $i <= date('Y'); $i++)
              <option>{{ $i }}</option>
            @endfor
          </select>
          <input type="number" min="0" name="min_price" placeholder="Min price">
          <input type="number" min="0" name="max_price" placeholder="Max price">
          <button type="submit">Search</button>
        </form>
      </div>
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
      <div class="vehicle_grid">
        @foreach ($cars as $car)
          @if (optional($car->gallery->first())->img)
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
