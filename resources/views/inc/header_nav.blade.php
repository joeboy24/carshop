
<header class='mb-3 my_header'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify color8 fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-1">
                        {{-- <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Mail</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">No new mail</a></li>
                        </ul> --}}
                    </li>
                    <li class="nav-item dropdown me-3">
                        {{-- <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <li><a class="dropdown-item">No notification available</a></li>
                        </ul> --}}
                    </li>
                </ul>
                <a class="cms_site" href="/">View site</a>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu cms_user">
                            <div class="user-name text-end">
                                <p>Signed in</p>
                                <h6>{{ auth()->user()->name }}</h6>
                            </div>
                            <span class="cms_avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end cms_account" aria-labelledby="dropdownMenuButton">
                        <li class="cms_account_who">
                            <span class="cms_avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            <span>
                                <strong>{{ auth()->user()->name }}</strong>
                                <em>{{ auth()->user()->status }}</em>
                            </span>
                        </li>
                        @if(auth()->user()->status != 'Administrator')
                            <li><a class="dropdown-item" @if(auth()->user()->status == 'Lecturer') href="/lprofile" @elseif(auth()->user()->status == 'Student') href="/sprofile" @endif><i class="fa fa-user"></i> Profile</a></li>
                        @endif
                        @if(auth()->user()->status == 'Administrator')
                            <li><a class="dropdown-item" href="/companysetup"><i class="fa fa-cog"></i> Company settings</a></li>
                        @endif
                        <li><a class="dropdown-item cms_logout" href="/logout"><i class="fa fa-sign-out"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    {{-- <div class="my_header2">
                            
        <div class="row">
            <div class="col-md-4 my_col">
                Hello!
            </div>
            <div class="col-md-4 my_col">
                Hello!
            </div>
            <div class="col-md-4 my_col">
                Hello!
            </div>
            <div class="col-md-4 my_col">
                Hello!
            </div>
            <div class="col-md-4 my_col">
                Hello!
            </div>
            <div class="col-md-4 my_col">
                Hello!
            </div>
        </div>
        
    </div> --}}
</header>