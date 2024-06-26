

@section('head')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        @import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
        .col-item
        {
            border: 1px solid #E1E1E1;
            border-radius: 5px;
            background: #FFF;
        }
        .col-item .photo img
        {
            margin: 0 auto;
            width: 100%;
        }

        .col-item .info
        {
            padding: 10px;
            border-radius: 0 0 5px 5px;
            margin-top: 1px;
        }

        .col-item:hover .info {
            background-color: #F5F5DC;
        }
        .col-item .price
        {
            /*width: 50%;*/
            float: left;
            margin-top: 5px;
        }

        .col-item .price h5
        {
            line-height: 20px;
            margin: 0;
        }

        .price-text-color
        {
            color: #219FD1;
        }

        .col-item .info .rating
        {
            color: #777;
        }

        .col-item .rating
        {
            /*width: 50%;*/
            float: left;
            font-size: 17px;
            text-align: right;
            line-height: 52px;
            margin-bottom: 10px;
            height: 52px;
        }

        .col-item .separator
        {
            border-top: 1px solid #E1E1E1;
        }

        .clear-left
        {
            clear: left;
        }

        .col-item .separator p
        {
            line-height: 20px;
            margin-bottom: 0;
            margin-top: 10px;
            text-align: center;
        }

        .col-item .separator p i
        {
            margin-right: 5px;
        }
        .col-item .btn-add
        {
            width: 50%;
            float: left;
        }

        .col-item .btn-add
        {
            border-right: 1px solid #E1E1E1;
        }

        .col-item .btn-details
        {
            width: 50%;
            float: left;
            padding-left: 10px;
        }
        .controls
        {
            margin-top: 20px;
        }
        [data-slide="prev"]
        {
            margin-right: 10px;
        }


    </style>
@endsection



        
<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="5000" id="myCarousel">
  <div class="col-md-12 carousel-inner">
    
    @if (count($flash_deals) > 0)
        @for ($i=0; $i<count($flash_deals); $i++)
            @if ($i == 0)
                <div class="item active">
                    <a href="/cars/{{$flash_deals[$i]->id}}"><div class="cust_col car_thumb">
                        <img src="https://macademiagroup.com/storage/classified/cars/{{$flash_deals[$i]->stock_id}}/{{$flash_deals[$i]->gallery[0]->img}}" class="img-responsive">
                        
                        <h3 class="flash_price_tag">PRICE ${{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</h3>
                        
                        <h5 class="flash_tag">{{$flash_deals[$i]->flash}}% off</h5>
                        {{-- <h6>{{ $flash_deals[$i]->make->model_name.' '.$flash_deals[$i]->submodel->sub_name }}</h6>
                        <p>{{date('s', strtotime($flash_deals[$i]->created_at))}} Views</p>
                        <h5>Price <span>USD&nbsp;{{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</span></h5> --}}
                    </div></a>
                </div>
            @else
                <div class="item">
                    <a href="/cars/{{$flash_deals[$i]->id}}"><div class="cust_col car_thumb">
                        <img src="https://macademiagroup.com/storage/classified/cars/{{$flash_deals[$i]->stock_id}}/{{$flash_deals[$i]->gallery[0]->img}}" class="img-responsive">
                        
                        <h3 class="flash_price_tag">PRICE ${{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</h3>
                        
                        <h5 class="flash_tag">{{$flash_deals[$i]->flash}}% off</h5>
                        {{-- <h6>{{ $flash_deals[$i]->make->model_name.' '.$flash_deals[$i]->submodel->sub_name }}</h6>
                        <p>{{date('s', strtotime($flash_deals[$i]->created_at))}} Views</p>
                        <h5>Price <span>USD&nbsp;{{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</span></h5> --}}
                    </div></a>
                </div>
            @endif
        @endfor
    @endif

  </div>
  
</div>


<script>
    $('.carousel[data-type="multi"] .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<2;i++) {
        next=next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        
        next.children(':first-child').clone().appendTo($(this));
    }
    });

    function adjustCarousel() {
        if ($(window).width() < 576) {
            $('.carousel-inner .item').removeClass('col-xs-6');
        //     $('.carousel-inner .item').addClass('col-md-6');
        // } else {
        //     $('.carousel-inner .item').removeClass('col-md-12');
        //     $('.carousel-inner .item').addClass('col-md-6');
        }
    }
    
    adjustCarousel();
    
    $(window).resize(function(){
        adjustCarousel();
    });

</script>



    {{-- </body>
</html> --}}