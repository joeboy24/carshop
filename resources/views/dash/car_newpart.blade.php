@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')
<div class="cms_page cms_entry">
    @include('inc.messages')
    <div class="cms_form_head">
        <div>
            <h1>New part</h1>
            <p>Give the part a name, a short description, a price, and at least one photo.</p>
        </div>
        <div class="cms_form_links">
            <a href="/view_parts">All parts</a>
            <a href="/new_entry">New vehicle</a>
        </div>
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="cms_panel">
            <h2>Part</h2>
            <div class="cms_fields">
                <label>Stock id
                    <input type="text" name="stock_id" value="SM{{ date('my').'0'.$cars_tot }}" readonly required>
                </label>
                <label>Part name
                    <input type="text" name="part_name" placeholder="Tires" required>
                </label>
                <label>Price (USD)
                    <input type="number" min="0" step="any" name="price" placeholder="950" required>
                </label>
                <label class="wide">Description
                    <textarea name="part_desc" rows="3" maxlength="200" required placeholder="Short description of the part"></textarea>
                </label>
                <label class="wide">Photos
                    <input type="file" name="photo[]" multiple required>
                </label>
            </div>
        </section>
        <button type="submit" name="store_action" value="add_new_part" class="cms_save">Save part</button>
    </form>
</div>
@endsection
