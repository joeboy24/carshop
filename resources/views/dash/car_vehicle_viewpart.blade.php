
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')
<div class="cms_page cms_wide">
    @include('inc.messages')
    <div class="cms_list_head">
        <div>
            <h1>Parts</h1>
            <p>Parts saved from the desk. Edit the name, description, and price, or remove the record.</p>
        </div>
        <div class="cms_form_links">
            <a href="/add_part">New part</a>
            <a href="/view_vehicle">All vehicles</a>
        </div>
    </div>

    @if (count($parts) > 0)
        <div class="cms_records">
            @foreach ($parts as $part)
                @php $shot = $part->gallery->first(); @endphp
                <article class="cms_record">
                    @if ($shot)
                        <img src="{{ \App\Support\Media::url('classified/cars/'.$part->stock_id.'/'.$shot->img) }}" alt="">
                    @else
                        <img alt="">
                    @endif
                    <div>
                        <div class="cms_record_top">
                            <h2>{{ $part->vwidth }}</h2>
                            <span class="cms_pill {{ $part->status == 'Active' ? 'on' : '' }}">{{ $part->status }}</span>
                            @if ($part->del == 'yes')
                                <span class="cms_pill">Deleted</span>
                            @endif
                        </div>
                        <p>{{ $part->stock_id }} · {{ $shot ? count($part->gallery).' '.(count($part->gallery) === 1 ? 'photo' : 'photos') : 'No photos' }}</p>
                        <p>{{ $part->max_load }}</p>
                        <p class="cms_price">USD {{ number_format((float) $part->price, 0) }}</p>
                    </div>
                    <form action="{{ action('CardashController@update', $part->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        @if ($part->del == 'yes')
                            <button type="submit" name="update_action" value="restore_new_part" class="cms_icon_btn" title="Restore" onclick="return confirm('Restore this part?')"><i class="fa fa-reply"></i></button>
                        @else
                            <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $part->id }}" class="cms_icon_btn" title="Edit"><i class="fa fa-pencil"></i></button>
                            <button type="submit" name="update_action" value="del_new_part" class="cms_icon_btn danger" title="Delete" onclick="return confirm('Delete this part?')"><i class="fa fa-trash"></i></button>
                        @endif
                    </form>
                </article>

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
        </div>
        <div style="margin-top:16px">{{ $parts->links() }}</div>
    @else
        <p class="cms_empty">No parts yet.</p>
    @endif
</div>
@endsection

 