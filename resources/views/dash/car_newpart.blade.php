
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')


    <div class="page-heading">
        <h3><i class="fa fa-gears"></i>&nbsp;&nbsp;Add Vehicle Parts</h3>
        <a href="/view_parts"><p class="print_report">&nbsp;<i class="fa fa-file-text"></i>&nbsp; View Parts</p></a>
        <a href="/new_entry"><p class="print_report">&nbsp;<i class="fa fa-car"></i>&nbsp;Add Vehicle</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-10">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    <div class="col-md-10 offset-md-1">

                        <!-- Add Vehicle Part -->

                        {{-- <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                <input type="text" name="stock_id" value="SM{{date('m').'0'.date('is')}}" readonly required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Part
                                <input type="text" name="name" placeholder="Name / Title" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-gears"></i> &nbsp; Description
                                <input type="text" name="desc" placeholder="Description" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Select Related Pictures
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="add_part" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form> --}}


                        <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="filter_div">
                                <i class="fa fa-pencil-square"></i> &nbsp; Stock ID
                                <input type="text" name="stock_id" value="SM{{date('my').'0'.$cars_tot}}" readonly required>
                            </div>
                        
                            <div class="filter_div">
                                <i class="fa fa-edit"></i> &nbsp; Part Name
                                <input type="text" name="part_name" placeholder="ex. Tires" required>
                            </div>

                            <div class="col-md-12" id="veh_parts">
                                <label>Description</label>
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <div class="form-group with-title mb-3">
                                            <textarea name="part_desc" class="form-control" rows="3" maxlength="200" required></textarea>
                                            <label>Short description of vehicle part(s)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="filter_div">
                                <i class="fa fa-cc-visa"></i> &nbsp; Price ($)
                                <input type="number" min="0" step="any" name="price" placeholder="ex. 950" required>
                            </div>
                    
                            <div class="filter_div">
                                <i class="fa fa-camera"></i> &nbsp; Select Related Pictures
                                <input type="file" name="photo[]" multiple required>
                            </div>
                            
                            <div class="form-group modal_footer">
                                <button type="submit" name="store_action" value="add_new_part" class="load_btn"><i class="fa fa-save"></i>&nbsp; Save</button>
                            </div>
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
        

@endsection

 