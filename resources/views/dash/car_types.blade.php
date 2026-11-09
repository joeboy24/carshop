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
    <div class="cms_list_head">
        <div>
            <h1><i class="fa fa-th-large"></i>Vehicle types</h1>
            <p>Body styles used when a vehicle is added and when visitors filter the stock.</p>
        </div>
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="cms_panel">
            <h2>New type</h2>
            <div class="cms_fields">
                <label>Name
                    <input type="text" name="name" placeholder="Sedan" required>
                </label>
                <label>Image
                    <input type="file" name="pass_photo" accept="image/png,image/jpeg" required>
                    <span class="cms_hint">240 × 140 PNG with a transparent background.</span>
                </label>
            </div>
            <button type="submit" name="store_action" value="add_type" class="cms_save">Save type</button>
        </section>
    </form>

    @if (count($types) > 0)
        <div class="cms_records">
            @foreach ($types as $tp)
                <article class="cms_record cms_setting">
                    <img src="{{ \App\Support\Media::url('classified/types/'.$tp->img) }}" alt="">
                    <div>
                        <div class="cms_record_top">
                            <h2>{{ $tp->name }}</h2>
                            <span class="cms_pill on">Active</span>
                        </div>
                    </div>
                    <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#edit{{ $tp->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                </article>

                <div class="modal fade" id="edit{{ $tp->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit {{ $tp->name }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                            </div>
                            <form action="{{ action('CardashController@update', $tp->id) }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @csrf
                                <div class="modal-body">
                                    <div class="cms_fields">
                                        <label>Name
                                            <input type="text" name="model_name" value="{{ $tp->name }}" required>
                                        </label>
                                        <label>Status
                                            <select name="status">
                                                <option value="active" {{ $tp->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $tp->status != 'active' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update_action" value="update_type" class="cms_save">Update type</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="cms_empty">No vehicle types yet.</p>
    @endif
</div>
@endsection
