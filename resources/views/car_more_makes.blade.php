@extends('layouts.app')

@section('content')

@include('inc.showcase_searchby')

<section class="more_makes">
  <div class="container">
    <div class="make_grid">
      @foreach ($makes as $item)
        <a class="make_tile" href="/cardash/{{ $item->id }}">
          <span class="make_tile_logo">
            <img src="{{ \App\Support\Media::url('classified/makes/'.$item->logo) }}" alt="">
          </span>
          <span class="make_tile_name">{{ $item->model_name }}</span>
        </a>
      @endforeach
    </div>
  </div>
</section>

@endsection
