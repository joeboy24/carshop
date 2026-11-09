

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
    
    @foreach ($flashWithPhotos as $deal)
        @php $dealPhoto = optional($deal->gallery->first())->img; @endphp
        <div class="item {{ $loop->first ? 'active' : '' }}">
            <a href="/cars/{{ $deal->id }}"><div class="cust_col car_thumb">
                <img src="{{ \App\Support\Media::url('classified/cars/'.$deal->stock_id.'/'.$dealPhoto) }}" class="img-responsive" alt="">
                <h3 class="flash_price_tag">PRICE ${{ number_format($deal->price + (($deal->flash / 100) * $deal->price)) }}</h3>
                <h5 class="flash_tag">{{ $deal->flash }}% off</h5>
            </div></a>
        </div>
    @endforeach

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