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
            <h1><i class="fa fa-sliders"></i>Shipment variables</h1>
            <p>Freight, inspection, and insurance amounts for container and RoRo.</p>
        </div>
    </div>

    @if (count($variables) < 2)
        <form action="{{ action('CardashController@store') }}" method="POST">
            @csrf
            <section class="cms_panel">
                <h2>New rate</h2>
                <div class="cms_fields">
                    <label>Shipment type
                        <select name="item">
                            <option value="cont" selected>Container</option>
                            <option value="ro">RoRo</option>
                        </select>
                    </label>
                    <label>Freight (USD)
                        <input type="text" name="freight" placeholder="100" required>
                    </label>
                    <label>Inspection (USD)
                        <input type="text" name="inspection" placeholder="100" required>
                    </label>
                    <label>Insurance (USD)
                        <input type="text" name="insurance" placeholder="100" required>
                    </label>
                </div>
                <button type="submit" name="store_action" value="add_variables" class="cms_save">Save rate</button>
            </section>
        </form>
    @endif

    @if (count($variables) > 0)
        <div class="cms_records">
            @foreach ($variables as $var)
                @if ($var->del != 'null')
                    <article class="cms_rate">
                        <span class="cms_mark"><i class="fa {{ $var->item == 'cont' ? 'fa-cube' : 'fa-ship' }}"></i></span>
                        <div>
                            <h2>{{ $var->item == 'cont' ? 'Container' : 'RoRo' }}</h2>
                            <dl>
                                <div><dt>Freight</dt><dd>{{ $var->freight }}</dd></div>
                                <div><dt>Inspection</dt><dd>{{ $var->inspection }}</dd></div>
                                <div><dt>Insurance</dt><dd>{{ $var->insurance }}</dd></div>
                            </dl>
                        </div>
                        <button type="button" class="cms_icon_btn" data-bs-toggle="modal" data-bs-target="#edit_shp{{ $var->id }}" title="Edit"><i class="fa fa-pencil"></i></button>
                    </article>

                    <div class="modal fade" id="edit_shp{{ $var->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit {{ $var->item == 'cont' ? 'container' : 'RoRo' }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                </div>
                                <form action="{{ action('CardashController@update', $var->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="cms_fields">
                                            <label>Freight (USD)
                                                <input type="text" name="freight" value="{{ $var->freight }}" required>
                                            </label>
                                            <label>Inspection (USD)
                                                <input type="text" name="inspection" value="{{ $var->inspection }}" required>
                                            </label>
                                            <label>Insurance (USD)
                                                <input type="text" name="insurance" value="{{ $var->insurance }}" required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_action" value="update_variables" class="cms_save">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p class="cms_empty">No shipment rates yet.</p>
    @endif
</div>
@endsection
