@php
    $vehicleOn = request()->is('new_entry', 'view_vehicle', 'add_part', 'view_parts');
    $settingsOn = request()->is('companysetup', 'adduser', 'model_mgt', 'vehicle_types');
@endphp
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('car_dashboard') ? 'active' : '' }}">
            <a href="/car_dashboard" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class="sidebar-link">
                <i class="fa fa-car"></i>
                <span>Vehicles</span>
            </a>
            <ul class="submenu {{ $vehicleOn ? 'active' : '' }}">
                <li class="submenu-item {{ request()->is('new_entry') ? 'active' : '' }}">
                    <a href="/new_entry">New entry</a>
                </li>
                <li class="submenu-item {{ request()->is('view_vehicle') ? 'active' : '' }}">
                    <a href="/view_vehicle">All vehicles</a>
                </li>
                <li class="submenu-item {{ request()->is('add_part') ? 'active' : '' }}">
                    <a href="/add_part">New part</a>
                </li>
                <li class="submenu-item {{ request()->is('view_parts') ? 'active' : '' }}">
                    <a href="/view_parts">All parts</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item {{ request()->is('inquiry') ? 'active' : '' }}">
            <a href="/inquiry" class="sidebar-link">
                <i class="fa fa-envelope-o"></i>
                <span>Inquiries</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('addabout') ? 'active' : '' }}">
            <a href="/addabout" class="sidebar-link">
                <i class="fa fa-align-left"></i>
                <span>About</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('addservice') ? 'active' : '' }}">
            <a href="/addservice" class="sidebar-link">
                <i class="fa fa-briefcase"></i>
                <span>Services</span>
            </a>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class="sidebar-link">
                <i class="fa fa-cog"></i>
                <span>Settings</span>
            </a>
            <ul class="submenu {{ $settingsOn ? 'active' : '' }}">
                <li class="submenu-item {{ request()->is('companysetup') ? 'active' : '' }}">
                    <a href="/companysetup">Company</a>
                </li>
                <li class="submenu-item {{ request()->is('adduser') ? 'active' : '' }}">
                    <a href="/adduser">Users</a>
                </li>
                <li class="submenu-item {{ request()->is('model_mgt') ? 'active' : '' }}">
                    <a href="/model_mgt">Makes and models</a>
                </li>
                <li class="submenu-item {{ request()->is('vehicle_types') ? 'active' : '' }}">
                    <a href="/vehicle_types">Vehicle types</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item {{ request()->is('variables') ? 'active' : '' }}">
            <a href="/variables" class="sidebar-link">
                <i class="fa fa-sliders"></i>
                <span>Variables</span>
            </a>
        </li>
    </ul>
</div>
