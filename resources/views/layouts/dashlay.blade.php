<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('company') != '' ? session('company')->abrv : 'MACADEMIA' }} · Content</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dashdir/css/bootstrap.css">

    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="/dashdir/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="/dashdir/vendors/iconly/bold.css">

    <link rel="stylesheet" href="/dashdir/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/dashdir/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/dashdir/css/app.css">
    <link rel="stylesheet" href="/dashdir/css/main.css">
    <link rel="stylesheet" href="/dashdir/css/cms.css">
    <link rel="stylesheet" href="/maindir/css/feed_style_clean.css">
    <link rel="shortcut icon" href="/dashdir/images/favicon.svg" type="image/x-icon">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a class="cms_brand" href="/car_dashboard">
                                @if (session('company') != '' && session('company')->logo)
                                    <img src="{{ \App\Support\Media::url('classified/company/'.session('company')->logo) }}" alt="">
                                @else
                                    <span class="cms_brand_mark"><i class="fa fa-car"></i></span>
                                @endif
                                <span>
                                    <strong>{{ session('company') != '' ? session('company')->abrv : 'CMS' }}</strong>
                                    <em>Content</em>
                                </span>
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                
                @yield('sidebar_menu')

                <button class="sidebar-toggler btn x"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div id="main" class='layout-navbar'>
            
            @yield('header_nav')

            <div class="top_space">
            </div>

            {{-- <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> --}}

            <div id="main-content">

                @yield('content')

            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    {{-- <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div> --}}
                    <div class="">
                        {{-- <div class="float-end"> --}}
                        <p class="footer_txt">Copyright © {{ date('Y') }} {{ session('company') != '' ? session('company')->abrv : 'MACADEMIA' }}</p>
                    </div>
                </div>
            </footer> 
        </div>
    </div>
    <script src="/dashdir/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/dashdir/js/bootstrap.bundle.min.js"></script>

    <!-- Include Choices JavaScript -->
    <script src="/dashdir/vendors/choices.js/choices.min.js"></script>
    <script src="/dashdir/js/pages/form-element-select.js"></script>

    <script src="/dashdir/vendors/apexcharts/apexcharts.js"></script>
    <script src="/dashdir/js/pages/dashboard.js"></script>

    <script src="/dashdir/js/main.js"></script>
    <script>
        (function () {
            var tip = document.createElement('div');
            tip.className = 'cms_tip';
            tip.hidden = true;
            document.body.appendChild(tip);
            var wait;
            var current;

            function label(el) {
                if (el.hasAttribute('title') && el.getAttribute('title')) {
                    el.setAttribute('data-tip', el.getAttribute('title'));
                    if (!el.getAttribute('aria-label')) el.setAttribute('aria-label', el.getAttribute('title'));
                    el.removeAttribute('title');
                }
                return el.getAttribute('data-tip') || '';
            }

            function host(node) {
                return node && node.closest ? node.closest('[title], [data-tip]') : null;
            }

            function place(el, text) {
                tip.textContent = text;
                tip.hidden = false;
                tip.classList.remove('above', 'below');
                tip.style.left = '0px';
                tip.style.top = '0px';
                var box = el.getBoundingClientRect();
                var width = tip.offsetWidth;
                var height = tip.offsetHeight;
                var center = box.left + box.width / 2;
                var left = Math.max(12 + width / 2, Math.min(center, window.innerWidth - 12 - width / 2));
                var top = box.bottom + 8;
                var placeAbove = top + height > window.innerHeight - 8 && box.top - height - 8 > 8;
                if (placeAbove) top = box.top - height - 8;
                tip.classList.add(placeAbove ? 'above' : 'below');
                tip.style.setProperty('--cms-tip-arrow', (center - left + width / 2) + 'px');
                tip.style.left = (left - width / 2) + 'px';
                tip.style.top = top + 'px';
            }

            function show(el) {
                var text = label(el);
                if (!text) return;
                current = el;
                clearTimeout(wait);
                wait = setTimeout(function () {
                    if (current === el) place(el, text);
                }, 60);
            }

            function hide(el) {
                if (current !== el) return;
                current = null;
                clearTimeout(wait);
                tip.hidden = true;
            }

            document.addEventListener('pointerover', function (event) {
                var el = host(event.target);
                if (!el || (event.relatedTarget && el.contains(event.relatedTarget))) return;
                show(el);
            });
            document.addEventListener('pointerout', function (event) {
                var el = host(event.target);
                if (!el || (event.relatedTarget && el.contains(event.relatedTarget))) return;
                hide(el);
            });
            document.addEventListener('focusin', function (event) {
                var el = host(event.target);
                if (el) show(el);
            });
            document.addEventListener('focusout', function (event) {
                var el = host(event.target);
                if (el) hide(el);
            });
            window.addEventListener('scroll', function () { tip.hidden = true; }, true);
        })();
    </script>

</body>

</html>