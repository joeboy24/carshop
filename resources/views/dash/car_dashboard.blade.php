
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')
    <div class="cms_page">
        @include('inc.messages')
        <div class="cms_head">
            <h1>Dashboard</h1>
            <p>Vehicles, parts, inquiries, and the pages on the public site.</p>
        </div>
        <div class="cms_stats">
            <a class="cms_stat" href="/view_vehicle"><span>Vehicles</span><strong>{{ $car_count }}</strong></a>
            <a class="cms_stat" href="/view_parts"><span>Parts</span><strong>{{ $part_count }}</strong></a>
            <a class="cms_stat" href="/inquiry"><span>Inquiries</span><strong>{{ $inquiry_count }}</strong></a>
            <a class="cms_stat" href="/adduser"><span>Users</span><strong>{{ $user_count }}</strong></a>
        </div>
        <div class="cms_tiles">
            <a class="cms_tile" href="/new_entry"><i class="fa fa-plus"></i><span>New vehicle</span></a>
            <a class="cms_tile" href="/view_vehicle"><i class="fa fa-car"></i><span>Vehicles</span></a>
            <a class="cms_tile" href="/add_part"><i class="fa fa-cogs"></i><span>New part</span></a>
            <a class="cms_tile" href="/inquiry"><i class="fa fa-envelope-o"></i><span>Inquiries</span></a>
            <a class="cms_tile" href="/addabout"><i class="fa fa-align-left"></i><span>About</span></a>
            <a class="cms_tile" href="/addservice"><i class="fa fa-briefcase"></i><span>Services</span></a>
            <a class="cms_tile" href="/variables"><i class="fa fa-sliders"></i><span>Variables</span></a>
            <a class="cms_tile" href="/companysetup"><i class="fa fa-building-o"></i><span>Company</span></a>
            <a class="cms_tile" href="/adduser"><i class="fa fa-user"></i><span>Users</span></a>
        </div>
    </div>
@endsection

 