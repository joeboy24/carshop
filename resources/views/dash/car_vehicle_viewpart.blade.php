
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')


    <div class="page-heading">
        <h3><i class="fa fa-file-text color2"></i>&nbsp;&nbsp;Vehicle Parts Mgt.</h3>
        <a href="/add_part"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Add Vehicle Part</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a>
    </div>

    {{ $parts->links() }}
 
    <div class="row">
        <div class="col-12 col-xl-8">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <!-- Vehicle View -->
                    <div class="table-responsive">
                        @if (count($parts) > 0)
                            <table class="table mb-0 table-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Part Details</th>
                                        <th class="align_right">Actions</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($parts as $part)
                                        @if ($part->del == 'yes')
                                            <tr class="del_danger">
                                        @else
                                            @if ($c % 2 == 1)
                                                <tr class="bg9">
                                            @else
                                                <tr>
                                            @endif
                                        @endif
                                            <td class="text-bold-500">{{$c++}} <br><br>
                                                <img class="car_prev" src="/storage/classified/cars/{{$part->stock_id}}/{{$part->gallery[0]->img}}" width="100" alt="">
                                                <p class="small_p">&nbsp;</p>
                                            </td>
                                            <td class="text-bold-500">
                                                <h6>{{ $part->vwidth.' - $'.$part->price }}</h6>
                                                {{-- <p class="small_p">ID: {{ $part->stock_id }}</p> --}}
                                                <p class="small_p_black">Desc: {{ $part->max_load }}</p>
                                                <p class="small_p_black">{{count($part->gallery)}} Photos</p>
                                                <p class="small_p">Status: {{ $part->status }}</p>
                                            </td>

                                            <form action="{{ action('CardashController@update', $part->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf


                                                @if ($part->del == 'yes')
                                                    <td class="text-bold-500 align_right action_size">
                                                        <button type="submit" name="update_action" value="restore_new_part" class="my_trash" onclick="return confirm('Do you want to restore this record?')"><i class="fa fa-reply"></i></button>
                                                    </td>
                                                @else
                                                    <td class="text-bold-500 align_right action_size">
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{$part->id}}" class="my_trash_small"><i class="fa fa-pencil"></i></button>
                                                        <button type="submit" name="update_action" value="del_new_part" class="my_trash_small" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                @endif
                                            </form>

                                        </tr>

                                        <!-- Update Vehicle Part -->
                                        <div class="modal fade" id="edit{{$part->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                            Edit Vehicle Part
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ action('CardashController@update', $part->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @csrf
                                                        <div class="modal-body">
                    
                                                            <div class="filter_div">
                                                                <i class="fa fa-edit"></i> &nbsp; Part
                                                                <input type="text" name="part_name" value="{{$part->vwidth}}" placeholder="Name / Title" required>
                                                            </div>
                                                    
                                                            {{-- <div class="filter_div">
                                                                <i class="fa fa-gears"></i> &nbsp; Description
                                                                <input type="text" name="part_desc" value="{{$part->max_load}}" placeholder="Description" required>
                                                            </div> --}}

                                                            <div class="col-md-12">
                                                                <label>Description</label>
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <div class="form-group with-title mb-3">
                                                                            <textarea name="part_desc" class="form-control" rows="3" maxlength="200" required>{{$part->max_load}}</textarea>
                                                                            <label>Part Description</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                        
                                                            <div class="filter_div">
                                                                <i class="fa fa-cc-visa"></i> &nbsp; Price ($)
                                                                <input type="number" min="0" step="any" name="price" value="{{$part->price}}" placeholder="eg. 5000" required>
                                                            </div>

                                                            {{-- <div class="filter_div">
                                                                <i class="fa fa-plus-circle"></i> &nbsp; Delete
                                                                <select name="part_del">
                                                                    @if ($part->del = 'yes')
                                                                        <option value="yes">Yes</option>
                                                                        <option value="no" selected>No</option>
                                                                    @else
                                                                        <option value="yes" selected>Yes</option>
                                                                        <option value="no">No</option>
                                                                    @endif
                                                                </select>
                                                            </div> --}}
                                                    
                                                        </div> 
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update_action" value="update_new_part" class="load_btn"><i class="fa fa-save"></i>&nbsp; Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $parts->links() }}
                        @else
                            <div class="alert alert-danger">
                                No Records Found on Vehicle Parts
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="search_div">
        <form action="">
            <input id="search_fd" type="text" class="search_field" placeholder="Search...">
            <button type="button" onclick="showsearch()"><i class="fa fa-search"></i></button>
        </form>
        <script>
            function showsearch() {
                if (document.getElementById('search_fd').style.opacity != 1) {
                    document.getElementById('search_fd').style.opacity = 1;
                    // document.getElementById('search_fd').style.display = "none";
                } else {
                    document.getElementById('search_fd').style.opacity = 0;
                }
            }
        </script>
    </div>
        

@endsection

 