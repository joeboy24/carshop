
<div class="more-parts">
    {{-- <img src="" alt=""> --}}
    @if (count($parts) > 0)
        @foreach ($parts as $part)
            @for ($i = 0; $i < count($part->gallery); $i++)
                <img src="/storage/classified/parts/{{$part->stock_id}}/{{$part->gallery[$i]->img}}" alt="">
            @endfor
        @endforeach
    @else
        <div class="alert alert-danger">
            No Records Found
        </div>   
    @endif
</div>