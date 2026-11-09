@php
    $photo = optional($car->gallery->first())->img;
    $vehicleName = trim((optional($car->make)->model_name ?? '').' '.(optional($car->submodel)->sub_name ?? ''));
    $vehiclePrice = (float) ($car->price ?? 0);
    if ($car->flash) {
        $vehiclePrice = $vehiclePrice + (($car->flash / 100) * $vehiclePrice);
    }
    $photoUrl = $photo ? \App\Support\Media::url('classified/cars/'.$car->stock_id.'/'.$photo) : null;
@endphp
@if ($photoUrl)
<a class="vehicle_card" href="/cars/{{ $car->id }}">
    <span class="vehicle_card_photo">
        <img src="{{ $photoUrl }}" alt="">
        @if ($car->flash)
            <span class="flash_tag">{{ $car->flash }}% off</span>
        @endif
        @if (($car->status ?? null) == 'Sold')
            <span class="sold_tag">Sold</span>
        @endif
    </span>
    <span class="vehicle_card_name">{{ $vehicleName ?: 'Vehicle' }}</span>
    <span class="vehicle_card_price">Price <strong>USD {{ number_format($vehiclePrice) }}</strong></span>
</a>
@endif
