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
            <h1>New vehicle</h1>
            <p>The stock id is assigned for you. Photos are required before the vehicle can be saved.</p>
        </div>
        <div class="cms_form_links">
            <a href="/view_vehicle">All vehicles</a>
            <a href="/add_part">New part</a>
        </div>
    </div>

    <form action="{{ action('CardashController@store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="cms_panel">
            <h2>Identity</h2>
            <div class="cms_fields">
                <label>Stock id
                    <input type="text" name="stock_id" value="SM{{ date('my').'0'.$cars_tot }}" readonly required>
                </label>
                <label>Chassis no.
                    <input type="text" name="chassis_no" required>
                </label>
                <label>Inventory location
                    <select name="inv_loc">
                        <option selected>Nagoya</option>
                    </select>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Vehicle</h2>
            <div class="cms_fields">
                <label>Model
                    <select name="make_id" required>
                        @foreach ($makes as $item)
                            <option value="{{ $item->id }}">{{ $item->model_name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Sub model
                    <select name="submodel_id" required>
                        @foreach ($submodels as $item)
                            <option value="{{ $item->id }}">{{ $item->sub_name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Model code
                    <input type="text" name="model_code" required>
                </label>
                <label>Year
                    <select name="year">
                        <option value="0" selected>Select year</option>
                        @for ($i = date('Y') - 30; $i <= date('Y'); $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
                <label>Body type
                    <select name="body_type">
                        @foreach ($types as $type)
                            <option>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Color
                    <input type="text" name="color" required>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Price</h2>
            <div class="cms_fields">
                <label>Price (USD)
                    <input type="number" min="0" step="any" name="price" placeholder="5000" required>
                </label>
                <label>Flash (%)
                    <input type="number" min="0" step="any" name="flash" value="0" required>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Specification</h2>
            <div class="cms_fields">
                <label>Mileage
                    <input type="text" name="mileage" required>
                </label>
                <label>Transmission
                    <select name="trans">
                        <option selected>Auto</option>
                        <option>Manual</option>
                    </select>
                </label>
                <label>Drive
                    <select name="drive">
                        <option selected>2WD</option>
                        <option>4WD</option>
                    </select>
                </label>
                <label>Steering
                    <select name="steer">
                        <option selected>LHD</option>
                        <option>RHD</option>
                    </select>
                </label>
                <label>Seats
                    <input type="number" min="0" max="8" name="seat" required>
                </label>
                <label>Doors
                    <select name="door">
                        <option selected>5</option>
                        <option>3</option>
                        <option>2</option>
                    </select>
                </label>
                <label>Engine type
                    <input type="text" name="eng_type" required>
                </label>
                <label>Engine size
                    <input type="text" name="eng_size" required>
                </label>
                <label>Fuel
                    <select name="fuel">
                        <option selected>Petrol</option>
                        <option>Diesel</option>
                        <option>Hybrid</option>
                        <option>LPG</option>
                        <option>EV</option>
                    </select>
                </label>
                <label>Vehicle width
                    <input type="text" name="veh_width">
                </label>
                <label>Width / height / length
                    <input type="text" name="veh_width">
                </label>
                <label>Gross vehicle weight
                    <input type="text" name="gross_weight">
                </label>
                <label class="wide">Maximum load
                    <input type="text" name="max_load" placeholder="Maximum loading capacity">
                </label>
                <label class="wide">Accessories
                    <textarea name="accessory" rows="3" required placeholder="Separate each accessory with a comma"></textarea>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Photos</h2>
            <div class="cms_fields">
                <label class="wide">Related pictures
                    <input type="file" name="photo[]" multiple required>
                </label>
            </div>
        </section>

        <button type="submit" name="store_action" value="add_vehicle" class="cms_save">Save vehicle</button>
    </form>
</div>
@endsection
