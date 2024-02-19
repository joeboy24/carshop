
{{-- <html>
    <head> --}}

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

    {{-- </head>

    <body> --}}
        {{-- <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-9">
                        <h3>
                            Carousel Product Cart Slider</h3>
                    </div>
                    <div class="col-md-3">
                        <!-- Controls -->
                        <div class="controls pull-right hidden-xs">
                            <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                                data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                                    data-slide="next"></a>
                        </div>
                    </div>
                </div>
                <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        
<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="5000" id="myCarousel">
  <div class="col-md-12 carousel-inner">
    
    
    @for ($i=0; $i<count($flash_deals); $i++)

        @if ($i == 0)
                    
            <div class="item active">
                <a href="#"><div class="cust_col car_thumb">
                    <img src="/storage/classified/cars/{{$flash_deals[$i]->stock_id}}/{{$flash_deals[$i]->gallery[0]->img}}" class="img-responsive">
                    
                    <h3 class="flash_price_tag">${{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</h3>
                    
                    <h5 class="flash_tag">{{$flash_deals[$i]->flash}}% off</h5>
                    {{-- <h6>{{ $flash_deals[$i]->make->model_name.' '.$flash_deals[$i]->submodel->sub_name }}</h6>
                    <p>{{date('s', strtotime($flash_deals[$i]->created_at))}} Views</p>
                    <h5>Price <span>USD&nbsp;{{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</span></h5> --}}
                </div></a>
            </div>
        @else
        <div class="item">
            <a href="#"><div class="cust_col car_thumb">
                <img src="/storage/classified/cars/{{$flash_deals[$i]->stock_id}}/{{$flash_deals[$i]->gallery[0]->img}}" class="img-responsive">
                
                <h3 class="flash_price_tag">${{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</h3>
                
                <h5 class="flash_tag">{{$flash_deals[$i]->flash}}% off</h5>
                {{-- <h6>{{ $flash_deals[$i]->make->model_name.' '.$flash_deals[$i]->submodel->sub_name }}</h6>
                <p>{{date('s', strtotime($flash_deals[$i]->created_at))}} Views</p>
                <h5>Price <span>USD&nbsp;{{ number_format($flash_deals[$i]->price+(($flash_deals[$i]->flash/100)*$flash_deals[$i]->price)) }}</span></h5> --}}
            </div></a>
        </div>
        @endif
        
    @endfor

    {{-- @foreach ($flash_deals as $car)
    <div class="item">
        <a href="#"><div class="cust_col car_thumb">
            <img src="https://img.freepik.com/premium-photo/green-branch-plant-with-neon-orange-glow-against-dark-starry-sky-generative-ai_76964-10382.jpg" class="img-responsive">
            
            <h3 class="flash_price_tag">${{ number_format($car->price+(($car->flash/100)*$car->price)) }}</h3>
            
            <h5 class="flash_tag">{{$car->flash}}% off</h5>
            <h6>{{ $car->make->model_name.' '.$car->submodel->sub_name }}</h6>
            <p>{{date('s', strtotime($car->created_at))}} Views</p>
            <h5>Price <span>USD&nbsp;{{ number_format($car->price+(($car->flash/100)*$car->price)) }}</span></h5>
        </div></a>
    </div>
    @endforeach --}}

  </div>
  {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> --}}
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