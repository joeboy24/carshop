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
    <div class="alert alert-danger" id="entry_alert" hidden></div>
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
                    <input type="text" name="stock_id" value="{{ old('stock_id', 'SM'.date('my').'0'.$cars_tot) }}" readonly required>
                </label>
                <label>Chassis no.
                    <input type="text" name="chassis_no" value="{{ old('chassis_no') }}" required>
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
                            <option value="{{ $item->id }}" @selected((string) old('make_id') === (string) $item->id)>{{ $item->model_name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Sub model
                    <select name="submodel_id" required>
                        @foreach ($submodels as $item)
                            <option value="{{ $item->id }}" @selected((string) old('submodel_id') === (string) $item->id)>{{ $item->sub_name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Model code
                    <input type="text" name="model_code" value="{{ old('model_code') }}" required>
                </label>
                <label>Year
                    <select name="year" required>
                        <option value="">Select year</option>
                        @for ($i = date('Y') - 30; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" @selected((string) old('year') === (string) $i)>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
                <label>Body type
                    <select name="body_type">
                        @foreach ($types as $type)
                            <option value="{{ $type->name }}" @selected(old('body_type') === $type->name)>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>Color
                    <input type="text" name="color" value="{{ old('color') }}" required>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Price</h2>
            <div class="cms_fields">
                <label>Price (USD)
                    <input type="number" min="0" step="any" name="price" value="{{ old('price') }}" placeholder="5000" required>
                </label>
                <label>Flash (%)
                    <input type="number" min="0" step="any" name="flash" value="{{ old('flash', '0') }}" required>
                </label>
            </div>
        </section>

        <section class="cms_panel">
            <h2>Specification</h2>
            <div class="cms_fields">
                <label>Mileage
                    <input type="text" name="mileage" value="{{ old('mileage') }}" required>
                </label>
                <label>Transmission
                    <select name="trans">
                        <option value="Auto" @selected(old('trans', 'Auto') === 'Auto')>Auto</option>
                        <option value="Manual" @selected(old('trans') === 'Manual')>Manual</option>
                    </select>
                </label>
                <label>Drive
                    <select name="drive">
                        <option value="2WD" @selected(old('drive', '2WD') === '2WD')>2WD</option>
                        <option value="4WD" @selected(old('drive') === '4WD')>4WD</option>
                    </select>
                </label>
                <label>Steering
                    <select name="steer">
                        <option value="LHD" @selected(old('steer', 'LHD') === 'LHD')>LHD</option>
                        <option value="RHD" @selected(old('steer') === 'RHD')>RHD</option>
                    </select>
                </label>
                <label>Seats
                    <input type="number" min="0" max="8" name="seat" value="{{ old('seat') }}" required>
                </label>
                <label>Doors
                    <select name="door">
                        <option value="5" @selected(old('door', '5') === '5')>5</option>
                        <option value="3" @selected(old('door') === '3')>3</option>
                        <option value="2" @selected(old('door') === '2')>2</option>
                    </select>
                </label>
                <label>Engine type
                    <input type="text" name="eng_type" value="{{ old('eng_type') }}" required>
                </label>
                <label>Engine size
                    <input type="text" name="eng_size" value="{{ old('eng_size') }}" required>
                </label>
                <label>Fuel
                    <select name="fuel">
                        <option value="Petrol" @selected(old('fuel', 'Petrol') === 'Petrol')>Petrol</option>
                        <option value="Diesel" @selected(old('fuel') === 'Diesel')>Diesel</option>
                        <option value="Hybrid" @selected(old('fuel') === 'Hybrid')>Hybrid</option>
                        <option value="LPG" @selected(old('fuel') === 'LPG')>LPG</option>
                        <option value="EV" @selected(old('fuel') === 'EV')>EV</option>
                    </select>
                </label>
                <label>Vehicle width
                    <input type="text" name="veh_width" value="{{ old('veh_width') }}">
                </label>
                <label>Width / height / length
                    <input type="text" name="veh_width" value="{{ old('veh_width') }}">
                </label>
                <label>Gross vehicle weight
                    <input type="text" name="gross_weight" value="{{ old('gross_weight') }}">
                </label>
                <label class="wide">Maximum load
                    <input type="text" name="max_load" value="{{ old('max_load') }}" placeholder="Maximum loading capacity">
                </label>
                <label class="wide">Accessories
                    <textarea name="accessory" rows="3" required placeholder="Separate each accessory with a comma">{{ old('accessory') }}</textarea>
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
<script>
    (function () {
        var form = document.querySelector('.cms_entry form');
        var banner = document.getElementById('entry_alert');
        if (!form || !banner) return;

        function showProblem(field) {
            var message = field.name === 'year'
                ? 'Oops..! Select Year to Proceed'
                : (field.type === 'file'
                    ? 'Add at least one photo before saving.'
                    : 'Fill in the highlighted field before saving.');
            form.querySelectorAll('.is_invalid').forEach(function (item) {
                item.classList.remove('is_invalid');
            });
            field.classList.add('is_invalid');
            banner.hidden = false;
            banner.textContent = message;
            banner.scrollIntoView({ block: 'center' });
            field.focus();
        }

        var reported = false;
        form.addEventListener('invalid', function (event) {
            event.preventDefault();
            if (reported) return;
            reported = true;
            showProblem(event.target);
            setTimeout(function () { reported = false; }, 0);
        }, true);

        form.addEventListener('submit', function (event) {
            var year = form.querySelector('[name="year"]');
            if (year.value) return;
            event.preventDefault();
            showProblem(year);
        });
    })();
</script>
@endsection
