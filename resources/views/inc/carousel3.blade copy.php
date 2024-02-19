
{{-- <html>
    <head> --}}

    @section('head')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}

        {{-- <style>
            @import url(https://fonts.googleapis.com/css?family=Lato:400,300,900,700);

            html {
            font-size: 16px;
            }

            h3 {
            font-family: 'Lato', sans-serif;
            font-size: 2.125rem;
            font-weight: 700;
            color: #444;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 55px 0 35px;
            }

            a {
            color: #ddd;
            text-transform: capitalize;
            font-size: 24px;
            &:hover {
                color: #ccc;
                text-decoration:none;
            }
            }

            .carousel-inner { margin: auto; width: 90%; }
            .carousel-control 			 { width:  4%; }
            .carousel-control.left,
            .carousel-control.right {
            background-image:none;
            }
            
            .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
            margin-top:-10px;
            margin-left: -10px;
            color: #444;
            }

            .carousel-inner {
            a {
                display:table-cell;
                height: 180px;
                width: 200px;
                vertical-align: middle;
            }
            img {
                max-height: 150px;
                margin: auto auto;
                max-width: 100%;
            }
            }

            @media (max-width: 767px) {
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(100%, 0, 0);
                transform: translate3d(100%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-100%, 0, 0);
                transform: translate3d(-100%, 0, 0);
            }

            }
            @media (min-width: 767px) and (max-width: 992px ) {
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(50%, 0, 0);
                transform: translate3d(50%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-50%, 0, 0);
                transform: translate3d(-50%, 0, 0);
            }
            }
            @media (min-width: 992px ) {
            
            .carousel-inner > .item.next,
            .carousel-inner > .item.active.right {
                left: 0;
                -webkit-transform: translate3d(16.7%, 0, 0);
                transform: translate3d(16.7%, 0, 0);
            }
            .carousel-inner > .item.prev,
            .carousel-inner > .item.active.left {
                left: 0;
                -webkit-transform: translate3d(-16.7%, 0, 0);
                transform: translate3d(-16.7%, 0, 0);
            }
            
            }

        </style> --}}
    @endsection

    {{-- </head>

    <body> --}}
        <div class="col-md-12 col-md-offset-1">
            <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
            <div class="carousel-inner">
                <div class="item active">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/pineapple-96.png" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://www.pixground.com/wp-content/uploads/2023/10/Colorful-Background-Dynamic-Waves-AI-Generated-4K-Wallpaper-1536x864.webp" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/avocado-96.png" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://www.pixground.com/wp-content/uploads/2023/10/Colorful-Background-Dynamic-Waves-AI-Generated-4K-Wallpaper-1536x864.webp" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/onion-96.png" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/asparagus-96.png" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Plants/watermelon-96.png" class="img-responsive"></a></div>
                </div>
                <div class="item">
                <div class="col-md-2 col-sm-6 col-xs-12"><a href="#"><img src="https://maxcdn.icons8.com/Color/PNG/96/Food/eggplant-96.png" class="img-responsive"></a></div>
                </div>
            </div>
                <!--   <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> -->
            </div>
        </div>

        <script>
            $('.carousel[data-type="multi"] .item').each(function(){
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                for (var i=0;i<4;i++) {
                    next=next.next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }
                    
                    next.children(':first-child').clone().appendTo($(this));
                }
            });
        </script>
    {{-- </body>
</html> --}}