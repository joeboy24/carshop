
@extends('layouts.app')


 

@section('content')

<section class="detail">
  <div class="container">
    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 detail_main">
        @include('inc.messages')
        @php
          $vehicleName = trim((optional($car->make)->model_name ?? '').' '.(optional($car->submodel)->sub_name ?? ''));
          $vehicleListPrice = (float) $car->price;
          $vehicleSave = $car->flash ? ($car->flash / 100) * $vehicleListPrice : 0;
        @endphp
        <div class="detail_top">
          <div>
            <p class="detail_stock">Stock {{ $car->stock_id }}</p>
            <h1>{{ $vehicleName ?: 'Vehicle' }}
              @if ($car->status == 'Sold')
                <span class="sold_tag2">Sold</span>
              @endif
            </h1>
          </div>
          <form class="detail_search" action="{{ action('CardashController@store') }}" method="POST">
            @csrf
            <input type="text" name="search_veh" placeholder="Stock id or keyword">
            <button type="submit" name="store_action" value="search_veh" aria-label="Search"><i class="fa fa-search"></i></button>
          </form>
        </div>

        <div class="row">
          
          <div class="col-md-8">
            @php
              $leadPhoto = optional($car->gallery->first())->img;
              $leadUrl = $leadPhoto ? \App\Support\Media::url('classified/cars/'.$car->stock_id.'/'.$leadPhoto) : null;
            @endphp
            <div class="single_img_cont">
              @if ($leadUrl)
                <img id="single_view" src="{{ $leadUrl }}" alt="">
              @endif
            </div>
            
            <div class="related_imgs" id="related_imgs">
              @foreach ($car_imgs as $item)
                @php $thumbUrl = \App\Support\Media::url('classified/cars/'.$car->stock_id.'/'.$item->img); @endphp
                <img src="{{ $thumbUrl }}" alt="" class="{{ $loop->first ? 'is_on' : '' }}" onclick="document.getElementById('single_view').src=this.src; [].forEach.call(this.parentNode.children, function (el) { el.classList.remove('is_on'); }); this.classList.add('is_on');">
              @endforeach
            </div>

            <section class="detail_block">
              <h2>Details</h2>
              <table class="vehicle_det">
                <tbody>
                  <tr>
                    <td class="td1">Stock Id:</td>
                    <td>{{$car->stock_id}}</td>
                    <td class="td1">Inventory Location:</td>
                    <td>{{$car->inv_loc}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Model Code:</td>
                    <td>{{$car->model_code}}</td>
                    <td class="td1">Year:</td>
                    <td>{{$car->year}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Mileage:</td>
                    <td>{{$car->mileage}}</td>
                    <td class="td1">Color:</td>
                    <td>{{$car->color}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Transmission:</td>
                    <td>{{$car->trans}}</td>
                    <td class="td1">Drive:</td>
                    <td>{{$car->drive}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Steering:</td>
                    <td>{{$car->steer}}</td>
                    <td class="td1">Seats:</td>
                    <td>{{$car->seat}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Engine Type:</td>
                    <td>{{$car->eng_type}}</td>
                    <td class="td1">Door:</td>
                    <td>{{$car->door}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Engine Size:</td>
                    <td>{{$car->eng_size}}</td>
                    <td class="td1">Body Type:</td>
                    <td>{{$car->body_type}}</td>
                  </tr>
                  <tr>
                    <td class="td1">Fuel:</td>
                    <td>{{$car->fuel}}</td>
                    {{-- <td class="td1">Body Length:</td>
                    <td>{{$car->body_len}}</td> --}}
                    <td class="td1">Width/Height/Length:</td>
                    <td>{{$car->vwidth}}</td>
                  </tr>
                  {{-- <tr>
                    <td class="td1">Vehicle Weight:</td>
                    <td>{{$car->vweight}}</td>
                    <td class="td1">Width/Height/Length:</td>
                    <td>{{$car->vwidth}}</td>
                  </tr> --}}
                  <tr>
                    <td class="td1">Gross Vehicle Weight:</td>
                    <td>{{$car->gvweight}}</td>
                    <td class="td1">Max Loading Capacity:</td>
                    <td>{{$car->max_load}}</td>
                    {{-- <td class="td1">Body Type:</td>
                    <td>Station Wagon</td> --}}
                  </tr>
                </tbody>
              </table>
            </section>

            <section class="detail_block">
              <h2>Accessories</h2>
              <div class="car_accessory">
              @foreach ($accessory as $asc)
                @if (trim($asc) !== '' && trim($asc) !== '-')
                  <p><i class="fa fa-check color4"></i> {{ trim($asc) }}</p>
                @endif
              @endforeach
              </div>
            </section>
          </div>

          <div class="col-md-4">
            <div class="detail_price">
            <table class="price_calc">
              <thead>
                <th>Price</th>
                <th class="align_right">
                  <select name="" id="">
                    <option value="1">USD</option>
                  </select>
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>Vehicle</td>
                  <td class="align_right vprice">{{ number_format($vehicleListPrice) }}</td>
                </tr>
                @if ($vehicleSave > 0)
                  <tr>
                    <td>Save {{ $car->flash }}%</td>
                    <td class="align_right detail_save">− ${{ number_format($vehicleSave) }}</td>
                  </tr>
                @endif
                {{-- <tr class="line_br"><td><p></p></td></tr> --}}
                <tr class="tr_br">
                  <td>Country</td>
                  <td class="align_right color6">
                    <select name="" id="" style="width: 100%">
                      @foreach ($countries as $ct)
                        <option value="{{$ct->id}}">{{$ct->name}}</option>
                      @endforeach
                      {{-- <option value="1">Canada</option>
                      <option value="2">Ghana</option> --}}
                    </select>
                  </td>
                </tr>
                <tr class="tr_br">
                  <td>Shipment</td>
                  <td class="align_right color6">
                    <select name="" id="ship" onchange="shipment({{$car->price}}, {{$vr[0]->freight}}, {{$vr[0]->inspection}}, {{$vr[0]->insurance}}, {{$vr[1]->freight}}, {{$vr[1]->inspection}}, {{$vr[1]->insurance}})">
                      <option value="1">Container</option>
                      <option value="2">RoRo</option>
                    </select>
                  </td>
                </tr>
                <tr class="tr_br">
                  <td>Freight</td>
                  <td class="align_right color6"><label for="check1">$<span id="freight">{{number_format($vr[0]->freight)}}</span>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="" id="check1"></label></td>
                </tr>
                <tr class="tr_br">
                  <td>Inspection</td>
                  <td class="align_right color6"><label for="check2">$<span id="insp">{{number_format($vr[0]->inspection)}}</span>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="" id="check2"></label></td>
                </tr>
                <tr class="tr_br">
                  <td>Insurance</td>
                  <td class="align_right color6"><label for="check3">$<span id="insure">{{number_format($vr[0]->insurance)}}</span>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="" id="check3"></label></td>
                </tr>
                <tr class="tr_br">
                  <td>Total</td>
                  <td class="align_right"><h5 id="tot_price">${{ number_format($vehicleListPrice) }}</h5></td>
                </tr>
              </tbody>
            </table>
            <a class="inquiry_btn" href="javascript:void(Tawk_API.toggle())">Inquiry</a>
            <a class="buynow_btn" href="/cart">Buy now</a>
            </div>
          </div>
        </div>

        <script>
          function shipment(t, u, v, w, x, y, z) {
            // alert(z);
            ship = document.getElementById('ship');
            freight = document.getElementById('freight');
            insp = document.getElementById('insp');
            insure = document.getElementById('insure');
            tot_price = document.getElementById('tot_price');

            // var x = document.getElementById("myDIV");
            // if (x.innerHTML === "Hello") {
            //   x.innerHTML = "Swapped text!";
            // } else {
            //   x.innerHTML = "Hello";
            // }

            if (ship.value == '1') {
              freight.innerHTML = u.toLocaleString('en-US');
              insp.innerHTML = v.toLocaleString('en-US');
              insure.innerHTML = w.toLocaleString('en-US');
              tot = t + u + v + w;
              tot_price.innerHTML = '$' + tot.toLocaleString('en-US');
            } else {
              freight.innerHTML = x.toLocaleString('en-US');
              insp.innerHTML = y.toLocaleString('en-US');
              insure.innerHTML = z.toLocaleString('en-US');
              tot = t + x + y + z;
              tot_price.innerHTML = '$' + tot.toLocaleString('en-US');
            }

            // alert(ship.value);
          }
        </script>

        <div class="modal fade" id="inqure" tabindex="-1" role="dialog" aria-labelledby="imgRequestLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="imgRequestLabel"><i class="fa fa-envelope-open-o">&nbsp;</i>&nbsp;&nbsp;Inquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                <form action="{{ action('CardashController@store') }}" method="POST">
                  @csrf
                  <input class="inq" type="text" name="name" placeholder="Name" required>
                  <input class="inq" type="phone" name="phone" placeholder="Phone" required>
                  <input class="inq" type="email" name="email" placeholder="Email" required>
                  <textarea class="inq" name="message" id="" cols="30" rows="3" placeholder="Message"></textarea>
                  <button type="submit" name="store_action" value="inquire" class="sb_btn ds2"><i class="fa fa-search"></i>&nbsp; Submit</button>
                </form>
                
              </div>
              
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Flash Deals -->
@include('inc.flash_deals')


@endsection
    
  