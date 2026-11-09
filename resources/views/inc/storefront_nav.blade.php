@php
    $browsing = request()->is('/')
        || request()->is('more_cars')
        || request()->is('more_flash')
        || request()->is('more_makes')
        || request()->is('more_parts')
        || request()->is('cars')
        || request()->is('cars/*')
        || request()->is('cardash')
        || request()->is('cardash/*');
@endphp
<li class="nav-item {{ $browsing ? 'active' : '' }}"><a href="/" class="nav-link">Home</a></li>
<li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="/about" class="nav-link">About Us</a></li>
<li class="nav-item {{ request()->is('services') ? 'active' : '' }}"><a href="/services" class="nav-link">Services</a></li>
<li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="/contact" class="nav-link">Contact</a></li>
<li class="nav-item cta {{ request()->is('cart') ? 'active' : '' }}"><a href="/cart" class="nav-link"><i class="fa fa-shopping-basket color8"></i>&nbsp;&nbsp;<span>Cart</span></a></li>
