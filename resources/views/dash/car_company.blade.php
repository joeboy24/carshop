
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')


    <div class="page-heading">
        <h3><i class="fa fa-bank color6"></i>&nbsp;&nbsp;Company Setup</h3>
        {{-- <a href="/emp_report"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Print Emp. Report</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a> --}}
    </div>

    <div class="row">
        <div class="col-12 col-xl-10">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <form class="form form-horizontal" action="{{action('CardashController@store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-10 offset-md-1">

                            <!-- Add Employee -->

                            <div class="filter_div" id="">
                                <i class="fa fa-bank"></i> &nbsp; Company Fullame
                                <input name="name" type="text" class="form-control" placeholder="Fullname" id="first-name-icon" @if ($company) value="{{$company->name}}" @endif required>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-bank"></i> &nbsp; Short Name
                                <input name="abrv" type="text" class="form-control" placeholder="Abreviation" id="first-name-icon" @if ($company) value="{{$company->abrv}}" @endif required>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-road"></i> &nbsp; Location
                                <input name="loc" type="text" class="form-control" placeholder="City" id="first-name-icon" @if ($company) value="{{$company->location}}" @endif required>
                            </div>
                            
                            <div class="col-md-4">
                                <label>Address</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <div class="form-group with-title mb-3">
                                            <textarea name="company_add" class="form-control" rows="3" required>@if ($company) {{$company->comp_add}} @endif</textarea>
                                            {{-- <textarea name="company_add" class="form-control" rows="3" placeholder="Address" required></textarea> --}}
                                            <label>Provide Address in Full</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-phone"></i> &nbsp; Contact
                                <input name="contact" type="text" class="form-control" placeholder="Mobile" @if ($company) value="{{$company->contact}}" @endif required>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-envelope"></i> &nbsp; Email
                                <input name="email" type="email" class="form-control" placeholder="Email" id="first-name-icon" @if ($company) value="{{$company->email}}" @endif required>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-photo"></i> &nbsp; Logo
                                <input name="company_logo" type="file" class="form-control" id="inputGroupFile01" @if ($company) value="{{$company->logo}}" @endif>
                            </div>

                            <div class="filter_div" id="">
                                <i class="fa fa-globe"></i> &nbsp; Website
                                <input name="company_web" type="text" class="form-control" placeholder="Website" id="first-name-icon" @if ($company) value="{{$company->website}}" @endif>
                            </div>

                            <div class="form-group modal_footer">
                                <button type="submit" class="load_btn" name="store_action" value="admi_config"><i class="fa fa-save"></i>&nbsp; Update</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
        

@endsection

 