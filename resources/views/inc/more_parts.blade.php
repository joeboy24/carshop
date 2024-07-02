
<div class="more-partszz">
    {{-- @if (count($parts) > 0)
        @foreach ($parts as $part)
            @if ($part->del != 'yes' || $part->status != 'Inactive')
                @for ($i = 0; $i < count($part->gallery); $i++)
                    <img src="https://macademiagroup.com/storage/classified/parts/{{$part->stock_id}}/{{$part->gallery[$i]->img}}" alt="">
                @endfor
            @endif
        @endforeach
    @else 
        <div class="alert alert-danger">
            No Records Found
        </div>   
    @endif --}}

    @if (count($parts) > 0)
        @foreach ($parts as $part)
        <a>
            <div class="col_25 car_thumb">
                <div class="car_thumb_img_container">
                    @foreach ($part->gallery as $item)
                        <img class="car_prev" src="/storage/classified/cars/{{$part->stock_id}}/{{$item->img}}" width="100" alt="">
                    @endforeach
                    {{-- <img class="car_prev" src="/storage/classified/cars/{{$part->stock_id}}/{{$part->gallery[0]->img}}" width="100" alt=""> --}}
                </div>
                <div class="car_thumb_details">
                    <h1 class="parts_price">PRICE ${{$part->price}}</h1>
                    <h3>{{ $part->vwidth }}</h3>
                    <p class="gray_p">{{ $part->max_load }}</p>
                </div>
            </div>
        </a>
        @endforeach
    @else
        <div class="alert alert-danger">
            No Records Found
        </div>   
    @endif
</div>