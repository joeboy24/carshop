<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Make;
use App\Models\Type;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Variable;
use Session;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $make_val = $request->input('make');
        $type_val = $request->input('type');
        $trans_val = $request->input('trans');
        $steer_val = $request->input('steer');
        $color_val = $request->input('color');
        $from = $request->input('from');
        $to = $request->input('to');
        $min = $request->input('min_price');
        $max = $request->input('max_price');

        if ($make_val == 0) { $make = 'del'; $make_val = 'no'; }else { $make = 'make_id'; } 
        if ($type_val == 0) { $type = 'del'; $type_val = 'no'; }else { $type = 'body_type'; } 
        if ($trans_val == 0) { $trans = 'del'; $trans_val = 'no'; }else { $trans = 'trans'; } 
        if ($steer_val == 0) { $steer = 'del'; $steer_val = 'no'; }else { $steer = 'steer'; } 
        if ($color_val == 0) { $color = 'del'; $color_val = 'no'; }else { $color = 'color'; }
        
        if ($min == '') { $min = 0; }else { $min = $min*1; } 
        if ($max == '') { $max = 1000000; }else { $max = $max*1; }

        $where = [
            $make => $make_val,
            $type => $type_val,
            $trans => $trans_val,
            $steer => $steer_val,
            $color => $color_val,
            // 'cur_date' => date('D, d-M-Y'),
            // 'employees' => $employees,
            // 'region' => $region,
        ];

        // $cars = Car::where($where)->get();
        $cars = Car::where($where)->where('year', '>=', $from)->where('year', '<=', $to)->where('price', '>=', $min)->where('price', '<=', $max)->paginate(20);
        // $cars = Car::where($where)->where('year', '>=', $from)->where('year', '<=', $to)->where('price', '>=', $min)->where('price', '<=', $max)->get();

        $patch = [
            // 'c' => 1,
            'cars' => $cars,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(10)->get(),
        ];
        return view('showcase')->with($patch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $car = Car::find($id);
        // // str_replace
        // if (str_contains($car->accessory, 'airbag')) {
        //     $asc = str_replace(',', '#*', $car->accessory);
        //     $asc = '*';
        //     return $asc;
        // }else {
        //     return 2;
        // }
        $patch = [
            // 'c' => 1,
            'car' => $car,
            'types' => Type::all(),
            'vr' => Variable::all(),
            'accessory' => explode(',', $car->accessory),
            'car_imgs' => Gallery::where('car_id', $id)->get(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'countries' => Country::orderBy('id', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(10)->get(),
        ];
        return view('single_view')->with($patch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
