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
            <h1><i class="fa fa-address-card"></i>Users</h1>
            <p>People who can sign in to this desk.</p>
        </div>
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST">
        @csrf
        <section class="cms_panel">
            <h2>New user</h2>
            <div class="cms_fields">
                <label>Name
                    <input type="text" name="name" placeholder="Name" required>
                </label>
                <label>Email
                    <input type="email" name="email" placeholder="Email" required>
                </label>
                <label>Phone
                    <input type="text" name="contact" placeholder="Phone" required>
                </label>
                <label>Role
                    <select name="status" required>
                        <option value="0">Select a role</option>
                        <option value="user">User</option>
                        <option value="admin">Administrator</option>
                    </select>
                </label>
                <label>Password
                    <input type="password" name="password" placeholder="Password" required>
                </label>
                <label>Confirm password
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                </label>
            </div>
            <button type="submit" name="store_action" value="create_user" class="cms_save">Create user</button>
        </section>
    </form>

    @if ($users->count() > 0)
        <div class="cms_records">
            @foreach ($users as $user)
                @if ($user->del != 'null')
                    <article class="cms_record cms_note">
                        <span class="cms_mark">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        <div>
                            <div class="cms_record_top">
                                <h2>{{ $user->name }}</h2>
                                <span class="cms_pill {{ $user->status == 'admin' ? 'on' : '' }}">{{ $user->status == 'admin' ? 'Administrator' : ($user->status == 'user' ? 'User' : $user->status) }}</span>
                            </div>
                            <p>{{ $user->email }} · {{ $user->contact }}</p>
                        </div>
                        <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                    </article>

                    <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit {{ $user->name }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                </div>
                                <form action="{{ action('CardashController@update', $user->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="cms_fields">
                                            <label>Name
                                                <input type="text" name="name" value="{{ $user->name }}" required>
                                            </label>
                                            <label>Email
                                                <input type="email" name="email" value="{{ $user->email }}" required>
                                            </label>
                                            <label>Phone
                                                <input type="text" name="contact" value="{{ $user->contact }}" required>
                                            </label>
                                            <label>Role
                                                <select name="status" required>
                                                    <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Administrator</option>
                                                    @if (!in_array($user->status, ['user', 'admin']))
                                                        <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                                    @endif
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_action" value="update_user" class="cms_save">Update user</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{ $users->links() }}
    @else
        <p class="cms_empty">No users yet.</p>
    @endif
</div>
@endsection
