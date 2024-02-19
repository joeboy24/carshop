

<section class="by_model">
    <div class="container">
      <div class="row">
        <div class="col-md-2 by_model_left">
        </div>
  
        <div class="col-md-10 by_model_right">
  
          <div class="col-12">
            
            <h6 class="pannel_header2"><span>Flash Deals</span> </h6>
            @include('inc.carousel3')
  
            {{-- 
            @if (count($flash_deals) > 0)
              @foreach ($flash_deals as $car)
                <a href="/cars/{{$car->id}}"><div class="col_25 car_thumb">
                  <img src="/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}" alt="">
                  <h5 class="flash_tag">{{$car->flash}}% off</h5>
                  <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
                  <p>{{date('s', strtotime($car->created_at))}} Views</p>
                  <h5>Price <span>USD&nbsp;{{ number_format($car->price+(($car->flash/100)*$car->price)) }}</span></h5>
                </div></a>
              @endforeach
            @else
              <div class="alert alert-danger">
                  No Records Found
              </div>   
            @endif --}}
          
            <p class="clear_both"></p>
            <a href="/more_flash"><button class="show_more_gray"><i class="fa fa-folder-open">&nbsp;</i>&nbsp;View More</button></a>
        </div>
      </div>
    </div>
</section>