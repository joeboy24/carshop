

{{-- <section class="by_model">
    <div class="container">
      <div class="row">
        <div class="col-md-2 by_model_left">
        </div>
  
        <div class="col-md-10 by_model_right"> --}}
  
          <div class="col-12">
  
            <h6 class="pannel_header2"><span>Shop Vehicle Parts</span> </h6>
            @if (count($parts) > 0)
              @foreach ($parts as $part)
                {{-- <a href="/cars/{{$part->id}}"> --}}
                    <div class="col_25 car_thumb">
                      <img src="/storage/classified/parts/{{$part->stock_id}}/{{$part->gallery[0]->img}}" alt="">
                      <h6>{{ $part->name }}</h6>
                  </div>
                {{-- </a> --}}
              @endforeach
            @else
              <div class="alert alert-danger">
                  No Records Found
              </div>   
            @endif
          
            <p class="clear_both"></p>
            <a href="/more_parts"><button class="show_more_gray"><i class="fa fa-folder-open">&nbsp;</i>&nbsp;View All</button></a>
        </div>

      {{-- </div>
    </div>
</section> --}}