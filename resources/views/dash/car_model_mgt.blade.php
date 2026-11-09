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
            <h1><i class="fa fa-car"></i>Makes and models</h1>
            <p>Makes shown in the public finder, and the models under each make.</p>
        </div>
    </div>

    <div class="cms_split">
        <div>
            <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="cms_panel">
                    <h2>New make</h2>
                    <div class="cms_fields">
                        <label>Name
                            <input type="text" name="model_name" placeholder="Toyota" required>
                        </label>
                        <label>Code
                            <input type="text" name="model_code" placeholder="TYT" required>
                        </label>
                        <label class="wide">Logo
                            <input type="file" name="pass_photo" accept="image/png,image/jpeg" required>
                            <span class="cms_hint">32 × 32 PNG with a transparent background.</span>
                        </label>
                    </div>
                    <button type="submit" name="store_action" value="add_make" class="cms_save">Save make</button>
                </section>
            </form>

            @if ($makes_page->count() > 0)
                <div class="cms_records">
                    @foreach ($makes_page as $make)
                        <article class="cms_record cms_setting">
                            <img src="{{ \App\Support\Media::url('classified/makes/'.$make->logo) }}" alt="">
                            <div>
                                <div class="cms_record_top">
                                    <h2>{{ $make->model_name }}</h2>
                                    <span class="cms_pill {{ $make->status == 'active' ? 'on' : '' }}">{{ $make->status == 'active' ? 'Active' : 'Inactive' }}</span>
                                </div>
                                <p>{{ $make->model_code }}</p>
                            </div>
                            <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#edit{{ $make->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                        </article>

                        <div class="modal fade" id="edit{{ $make->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit {{ $make->model_name }}</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <form action="{{ action('CardashController@update', $make->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="cms_fields">
                                                <label>Name
                                                    <input type="text" name="model_name" value="{{ $make->model_name }}" required>
                                                </label>
                                                <label>Code
                                                    <input type="text" name="model_code" value="{{ $make->model_code }}" required>
                                                </label>
                                                <label>Status
                                                    <select name="status">
                                                        <option value="active" {{ $make->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $make->status != 'active' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="update_action" value="update_make" class="cms_save">Update make</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $makes_page->links() }}
            @else
                <p class="cms_empty">No makes yet.</p>
            @endif
        </div>

        <div>
            <form action="{{ action('CardashController@store') }}" method="POST">
                @csrf
                <section class="cms_panel">
                    <h2>New model</h2>
                    <div class="cms_fields">
                        <label class="wide">Make
                            <select name="make_id" required>
                                @foreach ($makes as $item)
                                    <option value="{{ $item->id }}">{{ $item->model_name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>Model
                            <input type="text" name="sub_name" placeholder="Corolla" required>
                        </label>
                        <label>Code
                            <input type="text" name="sub_code" placeholder="CRL" required>
                        </label>
                    </div>
                    <button type="submit" name="store_action" value="add_submodel" class="cms_save">Save model</button>
                </section>
            </form>

            @if ($submodels_page->count() > 0)
                <div class="cms_records">
                    @foreach ($submodels_page as $subm)
                        <article class="cms_record cms_note">
                            <span class="cms_mark"><i class="fa fa-car"></i></span>
                            <div>
                                <div class="cms_record_top">
                                    <h2>{{ optional($subm->make)->model_name }} {{ $subm->sub_name }}</h2>
                                    <span class="cms_pill {{ $subm->status == 'active' ? 'on' : '' }}">{{ $subm->status == 'active' ? 'Active' : 'Inactive' }}</span>
                                </div>
                                <p>{{ $subm->sub_code }}</p>
                            </div>
                            <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#editsub{{ $subm->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                        </article>

                        <div class="modal fade" id="editsub{{ $subm->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit {{ $subm->sub_name }}</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <form action="{{ action('CardashController@update', $subm->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="cms_fields">
                                                <label class="wide">Make
                                                    <select name="make_id" required>
                                                        @foreach ($makes as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $subm->make_id ? 'selected' : '' }}>{{ $item->model_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <label>Model
                                                    <input type="text" name="sub_name" value="{{ $subm->sub_name }}" required>
                                                </label>
                                                <label>Code
                                                    <input type="text" name="sub_code" value="{{ $subm->sub_code }}" required>
                                                </label>
                                                <label>Status
                                                    <select name="status">
                                                        <option value="active" {{ $subm->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $subm->status != 'active' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="update_action" value="update_submodel" class="cms_save">Update model</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $submodels_page->links() }}
            @else
                <p class="cms_empty">No models yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
