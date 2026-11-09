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
            <h1><i class="fa fa-envelope"></i>Inquiries</h1>
            <p>Read a message and send the reply. Open inquiries still need an answer.</p>
        </div>
    </div>

    @if (count($inqs) > 0)
        <div class="cms_records">
            @foreach ($inqs as $inq)
                @if ($inq->del != 'null')
                    <article class="cms_record cms_note">
                        <span class="cms_mark"><i class="fa {{ $inq->status == 'active' ? 'fa-envelope' : 'fa-envelope-open-o' }}"></i></span>
                        <div>
                            <div class="cms_record_top">
                                <h2>{{ $inq->name }}</h2>
                                <span class="cms_pill {{ $inq->status == 'active' ? '' : 'on' }}">{{ $inq->status == 'active' ? 'Open' : 'Replied' }}</span>
                            </div>
                            <p>{{ $inq->email }}@if ($inq->phone) · {{ $inq->phone }}@endif</p>
                            <p>{{ $inq->message }}</p>
                            @if ($inq->reply)
                                <p class="cms_reply">Reply: {{ $inq->reply }}</p>
                            @endif
                        </div>
                        @if ($inq->status == 'active')
                            <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#reply{{ $inq->id }}" title="Reply"><i class="fa fa-pencil"></i></button>
                        @endif
                    </article>

                    <div class="modal fade" id="reply{{ $inq->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reply to {{ $inq->name }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                </div>
                                <form action="{{ action('CardashController@update', $inq->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="cms_fields">
                                            <label class="wide">Message
                                                <textarea rows="3" maxlength="200" readonly>{{ $inq->message }}</textarea>
                                            </label>
                                            <label class="wide">Reply
                                                <textarea name="reply_msg" rows="3" maxlength="250" required placeholder="Type the reply"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_action" value="close_inq" class="cms_save">Send reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div style="margin-top:16px">{{ $inqs->links() }}</div>
    @else
        <p class="cms_empty">No inquiries yet.</p>
    @endif
</div>
@endsection
