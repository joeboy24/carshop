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
    $cartItems = session('cart', []);
    $cartCount = is_array($cartItems) ? count($cartItems) : 0;
@endphp
<li class="nav-item {{ $browsing ? 'active' : '' }}"><a href="/" class="nav-link"><i class="fa fa-home nav_ico"></i>Home</a></li>
<li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="/about" class="nav-link"><i class="fa fa-info-circle nav_ico"></i>About Us</a></li>
<li class="nav-item {{ request()->is('services') ? 'active' : '' }}"><a href="/services" class="nav-link"><i class="fa fa-cogs nav_ico"></i>Services</a></li>
<li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="/contact" class="nav-link"><i class="fa fa-envelope nav_ico"></i>Contact</a></li>
<li class="nav-item nav_cart {{ request()->is('cart') ? 'active' : '' }}">
  <a href="/cart" class="nav-link" aria-label="Cart, {{ $cartCount }} {{ $cartCount === 1 ? 'item' : 'items' }}">
    <i class="fa fa-shopping-basket"></i>
    <span class="nav_cart_label">Cart</span>
    <span class="nav_cart_count">{{ $cartCount }}</span>
  </a>
</li>
@auth
<li class="nav-item cta {{ request()->is('car_dashboard') ? 'active' : '' }}"><a href="/car_dashboard" class="nav-link"><i class="fa fa-th-large nav_ico"></i>Dashboard</a></li>
@else
<li class="nav-item cta {{ request()->is('login') ? 'active' : '' }}"><a href="/login" class="nav-link"><i class="fa fa-lock nav_ico"></i>Login</a></li>
@endauth
