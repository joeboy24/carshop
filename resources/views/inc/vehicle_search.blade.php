@php
  $filtersOpen = false;
  foreach (['make', 'type', 'trans', 'steer', 'color', 'from', 'to', 'min_price', 'max_price'] as $filterKey) {
      $filterValue = request($filterKey);
      if ($filterValue !== null && $filterValue !== '' && $filterValue !== '0') {
          $filtersOpen = true;
          break;
      }
  }
@endphp
<div class="home_finder">
  <form class="home_keyword" action="{{ action('CardashController@store') }}" method="POST">
    @csrf
    <input type="text" name="search_veh" placeholder="Stock id or keyword" value="{{ request('search_veh') }}">
    <button type="submit" name="store_action" value="search_veh">Search</button>
  </form>
  <input class="finder_more" type="checkbox" id="finder_more" {{ $filtersOpen ? 'checked' : '' }}>
  <label class="finder_more_btn" for="finder_more">Filters</label>
  <form class="home_fields" action="{{ action('CarsController@index') }}">
    <select name="make">
      <option value="0">Make</option>
      @foreach ($makes as $item)
        <option value="{{ $item->id }}" {{ (string) request('make') === (string) $item->id ? 'selected' : '' }}>{{ $item->model_name }}</option>
      @endforeach
    </select>
    <select name="type">
      <option value="0">Type</option>
      @foreach ($types as $item)
        <option {{ (string) request('type') === (string) $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
    </select>
    <select name="trans">
      <option value="0">Transmission</option>
      <option value="Auto" {{ request('trans') === 'Auto' ? 'selected' : '' }}>Automatic</option>
      <option {{ request('trans') === 'Manual' ? 'selected' : '' }}>Manual</option>
    </select>
    <select name="steer">
      <option value="0">Steering</option>
      <option value="Lhd" {{ request('steer') === 'Lhd' ? 'selected' : '' }}>Left hand drive</option>
      <option value="Rhd" {{ request('steer') === 'Rhd' ? 'selected' : '' }}>Right hand drive</option>
    </select>
    <select name="color">
      <option value="0">Color</option>
      @if (session('car_color'))
        @foreach (session('car_color') as $item)
          <option {{ (string) request('color') === (string) $item->color ? 'selected' : '' }}>{{ $item->color }}</option>
        @endforeach
      @endif
    </select>
    <select name="from">
      <option value="0">From year</option>
      @for ($i = date('Y') - 25; $i <= date('Y'); $i++)
        <option {{ (string) request('from') === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
      @endfor
    </select>
    <select name="to">
      <option value="{{ date('Y') }}">To year</option>
      @for ($i = date('Y') - 24; $i <= date('Y'); $i++)
        <option {{ (string) request('to') === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
      @endfor
    </select>
    <input type="number" min="0" name="min_price" placeholder="Min price" value="{{ request('min_price') }}">
    <input type="number" min="0" name="max_price" placeholder="Max price" value="{{ request('max_price') }}">
    <button type="submit">Search</button>
  </form>
</div>
