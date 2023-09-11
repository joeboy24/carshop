
@extends('layouts.app')


@section('navlist')

  <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
  <li class="nav-item dropbtn"><a href="/about" class="nav-link">Why Choose Us</a></li>
  <li class="nav-item dropbtn"><a href="/how_to_buy" class="nav-link">How to buy</a></li>
  <li class="nav-item dropbtn"><a href="/services" class="nav-link">Services</a></li>
  <!--<li class="nav-item dropdown"><a href="" class="nav-link dropbtn">How to buy</a>
    <div class="dropdown-content">
      <a class="nav-item dropdown" href="/admissions#apply"><i class="fa fa-send li_icon"></i>&nbsp;&nbsp; How to Apply</a>
      <a class="nav-item dropdown" href="/admissions#programs"><i class="fa fa-graduation-cap li_icon"></i>&nbsp; Programs Offered</a>
    </div>
  </li>
  <li class="nav-item"><a href="/news" class="nav-link">News</a></li-->
  {{-- <li class="nav-item dropdown"><a href="" class="nav-link dropbtn">Programs</a>
    <div class="dropdown-content">
      @foreach (session('program') as $program)
        <a href="/student_portal">{{ $program->program_name }}</a>
      @endforeach
    </div> 
  </li> --}}
  <!--li class="nav-item dropdown"><a class="nav-link dropbtn">Services</a>
    <div class="dropdown-content">
      <a href="#"><i class="fa fa-university li_icon"></i>&nbsp;&nbsp; HTI</a>
      <a href="/exam_portal"><i class="fa fa-pencil li_icon"></i>&nbsp;&nbsp; Examinations</a>
      <a href="/student_portal"><i class="fa fa-graduation-cap li_icon"></i>&nbsp; Student Portal</a>
      <a href="/staff_portal"><i class="fa fa-user-circle-o li_icon"></i>&nbsp;&nbsp; Staff Portal</a>
      <a href="/admin_portal"><i class="fa fa-unlock-alt li_icon"></i>&nbsp;&nbsp;&nbsp; Administration</a>
    </div>
  </li--> 
  <li class="nav-item"><a href="/about#contact" class="nav-link">Contact</a></li>
  {{-- <li class="nav-item"><a href="/gallery" class="nav-link">Gallery</a></li> --}}
  <li class="nav-item cta"><a href="/cart" class="nav-link"><i class="fa fa-shopping-basket color8"></i>&nbsp;&nbsp;<span>Cart</span></a></li>
	        
@endsection
 

@section('content')

<section class="car_header" style="background: rgb(53, 53, 53); background-size: 100%">
    <div style="height: 100px"></div>
</section>

<!-- By Model -->
<section class="by_model">
  <div class="container">
    

    <div class="row">
      @include('inc.makes')

      <div class="col-md-10 by_model_right">

        @include('inc.messages')
        <div class="key_search">
          <form action="{{ action('CardashController@store') }}" method="POST">
            @csrf
          <p><span>Search &nbsp;</span><i class="fa fa-car"></i></p>
          <input type="text" name="search_veh" placeholder="By Stock ID or Keyword">
          <button type="submit" name="store_action" value="search_veh"><i class="fa fa-search"></i></button>
          </form>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="sv_header">
              <p>Stock Id: {{$car->stock_id}}</p>
              <h4>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h4>
              <p class="color7"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
              </p>
              <p id="xx">{{date('s', strtotime($car->created_at))}} Views</p>
              
              <script>
              </script>
            </div>
          </div>
          
          <div class="col-md-8">
            <div class="single_img_cont" id="single_view"
             style="background: url(/storage/classified/cars/{{$car->stock_id}}/{{$car->gallery[0]->img}}); background-size: 100%; background-position: center;
             background-repeat: no-repeat;">
            </div>
            
            <div class="related_imgs" id="related_imgs">
              @foreach ($car_imgs as $item)
                <img src="/storage/classified/cars/{{$car->stock_id}}/{{$item->img}}" width="16%" alt="" onclick="changeImg{{$item->id}}()">
                <script>
                  function changeImg{{$item->id}}() {
                    document.getElementById("single_view").style.backgroundImage = "url(/storage/classified/cars/{{$car->stock_id}}/{{$item->img}})";
                  }
                </script>
              @endforeach
              
            </div>

            <table class="vehicle_det">
              <p>&nbsp;</p>
              <h6 class="vehicle_det_header">{{ $car->make->model_name.' '.$car->submodel->sub_name }} - Car Details</h6>
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
                  <td class="td1">Body Length:</td>
                  <td>{{$car->body_len}}</td>
                </tr>
                <tr>
                  <td class="td1">Vehicle Weight:</td>
                  <td>{{$car->vweight}}</td>
                  <td class="td1">Gross Vehicle Weight:</td>
                  <td>{{$car->gvweight}}</td>
                </tr>
                <tr>
                  <td class="td1">Max Loading Capacity:</td>
                  <td>{{$car->max_load}}</td>
                  {{-- <td class="td1">Body Type:</td>
                  <td>Station Wagon</td> --}}
                </tr>
              </tbody>
            </table>

            <div class="car_accessory">
              <h6 class="vehicle_det_header">Accessories</h6>
              @foreach ($accessory as $asc)
                <p><i class="fa fa-check color4"></i> {{$asc}}</p>
              @endforeach
              <!--p><i class="fa fa-check color4"></i> CD Player</p>
              <p class="active_acc">Power Steering</p>
              <p class="active_acc">Leather Seat</p>
              <p>Alloy Wheels</p>
              <p>Rear Spoiler</p>
              <p class="active_acc">Wheel Spanner</p>
              <p class="active_acc">Central Locking</p>
              <p>Power Seat</p>
              <p class="active_acc">Navigation</p>
              <p class="active_acc">Sun Roof</p-->
            </div>
          </div>

          <div class="col-md-4">
            <table class="price_calc">
              <thead>
                <th>Total Price Calculator</th>
                <th class="align_right">
                  <select name="" id="">
                    <option value="1">USD</option>
                    {{-- <option value="2">EUR</option>
                    <option value="3">GBP</option>
                    <option value="4">CAD</option> --}}
                  </select>
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>Vehicle Price</td>
                  <td class="align_right vprice color6">{{number_format($car->price)}}</td>
                </tr>
                @if ($car->flash != 0)
                  <tr>
                    <td></td>
                    <td class="align_right color6"><p class="small_p color10">- <del>${{number_format(($car->flash/100)*$car->price)}}</del></p></td>
                  </tr>
                  <tr>
                    <td><p class="small_p">Save</p></td>
                    <td class="align_right color6">{{$car->flash}}%</td>
                  </tr>
                @endif
                {{-- <tr class="line_br"><td><p></p></td></tr> --}}
                <tr class="tr_br">
                  <td>Destination Country</td>
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
                  <td>Total Price</td>
                  <td class="align_right color6"><h5 id="tot_price">${{number_format($car->price)}}</h5></td>
                </tr>
              </tbody>
            </table>
            <button class="inquiry_btn bg11 color8" data-toggle="modal" data-target="#inqure"><i class="fa fa-envelope-open-o">&nbsp;</i>&nbsp;&nbsp;Inquiry</button>
            <a href="/cart"><button type="button" class="buynow_btn bg6 color8"><i class="fa fa-shopping-basket">&nbsp;</i>&nbsp;&nbsp;Buy Now</button></a>
          </div>
        </div>

        <script>

          tot = t + x + y + z;
          tot_price.innerHTML = tot.toLocaleString('en-US');

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
              tot_price.innerHTML = tot.toLocaleString('en-US');
            } else {
              freight.innerHTML = x.toLocaleString('en-US');
              insp.innerHTML = y.toLocaleString('en-US');
              insure.innerHTML = z.toLocaleString('en-US');
              tot = t + x + y + z;
              tot_price.innerHTML = tot.toLocaleString('en-US');
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
    
  