

<section class="showcase_searchby">
    <div class="container">
      <form action="{{ action('CarsController@index') }}">
        {{-- @csrf --}}
        <div class="row">
          <div class="col2_25">
            <select class="search_sel" name="make" id="">
              <option value="0">Select Make</option>
              @foreach ($makes as $item)
                <option value="{{$item->id}}">{{$item->model_name}}</option>
              @endforeach
            </select>
          </div>
  
          <div class="col2_25">
            <select class="search_sel" name="type" id="">
              <option value="0">Type</option>
              @foreach ($types as $item)
                <option>{{$item->name}}</option>
              @endforeach
            </select>
          </div>
  
          <div class="col2_25">
            <select class="search_sel" name="trans" id="">
              <option value="0">Transmission</option>
              <option value="Auto">Automatic</option>
              <option>Manual</option>
            </select>
          </div>
  
          <div class="col2_25">
            <select class="search_sel" name="steer" id="">
              <option value="0">Steering</option>
              <option value="Lhd">Left Hand Drive</option>
              <option value="Rhd">Right Hand Drive</option>
            </select>
          </div>
  
          <div class="col2_25">
            <select class="search_sel" name="color" id="">
              <option value="0">Color</option>
              @if (session('car_color'))
                @foreach (session('car_color') as $item)
                  <option>{{$item->color}}</option>
                @endforeach
              @endif
            </select>
          </div>
  
          <div class="col2_25">
            <div class="double_select">
              <select class="ds ds1" name="from" id="">
                <option value="0" selected>From Year</option>
                @for ($i = date('Y')-25; $i <= date('Y'); $i++)
                    <option>{{$i}}</option>
                @endfor
              </select>
  
              <select class="ds ds2" name="to" id="">
                <option value="{{date('Y')}}" selected>To Year</option>
                @for ($i = date('Y')-10; $i <= date('Y'); $i++)
                    <option>{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
  
          <div class="col2_25">
            <div class="">
              <input class="search_input ds1" type="number" min="0" name="min_price" placeholder="Min Price">
              <input class="search_input ds2" type="number" min="0" name="max_price" placeholder="Max Price" id="">
            </div>
          </div>
  
          <div class="col2_25">
            <button type="submit" class="sb_btn2"><i class="fa fa-search"></i>&nbsp; Search</button>
          </div>
        </div>
      </form>
    </div>
</section>