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
            <h1><i class="fa fa-align-left"></i>About</h1>
            <p>Paragraphs shown on the public about page.</p>
        </div>
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST">
        @csrf
        <section class="cms_panel">
            <h2>New paragraph</h2>
            <div class="cms_fields">
                <label class="wide">Title
                    <input type="text" name="title" placeholder="Title" required>
                </label>
                <label class="wide">Body
                    <textarea name="body" rows="4" placeholder="Body text" required></textarea>
                </label>
            </div>
            <button type="submit" name="store_action" value="add_about" class="cms_save">Add paragraph</button>
        </section>
    </form>

    @if (count($about) > 0)
        <div class="cms_records">
            @foreach ($about as $abt)
                @if ($abt->del != 'null')
                    <article class="cms_copy">
                        <div>
                            <h2>{{ $abt->title }}</h2>
                            <p>{{ $abt->body }}</p>
                        </div>
                        <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#edit_abt{{ $abt->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                    </article>

                    <div class="modal fade" id="edit_abt{{ $abt->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit paragraph</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                </div>
                                <form action="{{ action('CardashController@update', $abt->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="cms_fields">
                                            <label class="wide">Title
                                                <input type="text" name="title" value="{{ $abt->title }}" required>
                                            </label>
                                            <label class="wide">Body
                                                <textarea name="body" rows="4" required>{{ $abt->body }}</textarea>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_action" value="update_about" class="cms_save">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div style="margin-top:16px">{{ $about->links() }}</div>
    @else
        <p class="cms_empty">No about paragraphs yet.</p>
    @endif
</div>
@endsection
