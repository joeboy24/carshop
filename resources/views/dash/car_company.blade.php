@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')
@php
    $logo = $company && $company->logo ? \App\Support\Media::url('classified/company/'.$company->logo) : null;
@endphp
<div class="cms_page">
    @include('inc.messages')
    <div class="cms_list_head">
        <div>
            <h1><i class="fa fa-bank"></i>Company</h1>
            <p>Name, address, and contact details shown on the public site.</p>
        </div>
        @if ($logo)
            <img class="cms_brand_preview" src="{{ $logo }}" alt="">
        @endif
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="cms_panel">
            <h2>Company details</h2>
            <div class="cms_fields">
                <label>Company name
                    <input type="text" name="name" value="{{ $company->name ?? '' }}" placeholder="Full name" required>
                </label>
                <label>Short name
                    <input type="text" name="abrv" value="{{ $company->abrv ?? '' }}" placeholder="Abbreviation" required>
                </label>
                <label>Location
                    <input type="text" name="loc" value="{{ $company->location ?? '' }}" placeholder="City" required>
                </label>
                <label>Contact
                    <input type="text" name="contact" value="{{ $company->contact ?? '' }}" placeholder="Phone" required>
                </label>
                <label class="wide">Address
                    <textarea name="company_add" rows="3" required>{{ $company->comp_add ?? '' }}</textarea>
                </label>
                <label>Email
                    <input type="email" name="email" value="{{ $company->email ?? '' }}" placeholder="Email" required>
                </label>
                <label>Website
                    <input type="text" name="company_web" value="{{ $company->website ?? '' }}" placeholder="https://">
                </label>
                <label>Live chat
                    <select name="chat">
                        <option value="on" {{ ($company->chat ?? 'on') !== 'off' ? 'selected' : '' }}>On</option>
                        <option value="off" {{ ($company->chat ?? 'on') === 'off' ? 'selected' : '' }}>Off</option>
                    </select>
                    <span class="cms_hint">The chat button on the public site.</span>
                </label>
                <label class="wide">Logo
                    <input type="file" name="company_logo" accept="image/png,image/jpeg">
                    <span class="cms_hint">PNG or JPEG, up to 5 MB. Leave this empty to keep the current logo.</span>
                </label>
            </div>
            <button type="submit" name="store_action" value="admi_config" class="cms_save">Save company</button>
        </section>
    </form>
</div>
@endsection
