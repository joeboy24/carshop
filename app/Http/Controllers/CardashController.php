<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Car;
use App\Models\Part;
use App\Models\User;
use App\Models\Make;
use App\Models\Type;
use App\Models\Gallery;
use App\Models\Company;
use App\Models\Submodel;
use App\Models\Inquire;
use App\Models\About;
use App\Models\Service;
use App\Models\Variable;
use Exception;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class CardashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return redirect(url()->previous());
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
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
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
        switch ($request->input('store_action')) {

            case 'create_user':

                $ps1 = $request->input('password');
                $ps2 = $request->input('password_confirmation');
                $username = $request->input('name');
                $email = $request->input('email');
                $contact = $request->input('contact');
                $status = $request->input('status');
                // $pass_photo = $request->input('pass_photo');

                if ($status == 0) {
                    return redirect(url()->previous())->with('error', 'Oops..! Select Status to procceed.');
                }

                if ($ps1 == $ps2){

                    try {
                        // $this->validate($request, [
                        //     'pass_photo'  => 'max:5000|mimes:jpeg,jpg,png'
                        // ]);
                        // $filenameWithExt = $request->file('pass_photo')->getClientOriginalName();
                        // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // $fileExt = $request->file('pass_photo')->getClientOriginalExtension();
                        // $filenameToStore = $username.substr( $contact, -4).'.'.$fileExt;
                        // $path = $request->file('pass_photo')->storeAs('public/classified/users', $filenameToStore);
                        
                    } catch (Exception $ex) {
                        // return redirect(url()->previous())->with('error', 'Ooops..! File Error');
                    }

                    try {

                        $create_user = User::firstOrCreate([
                            'name' => $username,
                            'email' => $email,
                            'contact' => $contact,
                            'status' => $status,
                            'password' => Hash::make($ps1),
                            'pass_photo' => 'noimage.png',
                            // 'pass_photo' => $filenameToStore
                        ]);
                        return redirect(url()->previous())->with('success', 'User `'.$username.'` successfully added!');
                        
                    }catch(\Throwable $th){
                        // return $th;
                        return redirect(url()->previous())->with('error', 'Oops..! Something is wrong! Could be duplicate entry.');
                    }
                }else{
                    return redirect(url()->previous())->with('error', 'Oops..! Passwords do not match');
                }

            break;

            case 'admi_config':

                $name = $request->input('name');
                $abrv = $request->input('abrv');
                $loc = $request->input('loc');
                

                $results = Company::find(1);

                if ($results){

                    $company = Company::find(1);
                    try {
                        $this->validate($request, [
                            'company_logo'  => 'max:5000|mimes:jpeg,jpg,png'
                        ]);
                        if($request->hasFile('company_logo')){
                            //get filename with ext
                            $filenameWithExt = $request->file('company_logo')->getClientOriginalName();
                            //get filename
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            //get file ext
                            $fileExt = $request->file('company_logo')->getClientOriginalExtension();
                            //filename to store
                            $filenameToStore = $company->logo;
                            //upload path
                            $path = $request->file('company_logo')->storeAs('public/classified/company', $filenameToStore);
                        }else{
                            $filenameToStore = $company->logo;
                        }
            
                    } catch (Exception $ex) {
                        return redirect('/companysetup')->with('error', 'Ooops..! File Error');
                    }

                    try {
                        // $company = Company::find(1);
                        $company->user_id = auth()->user()->id;
                        $company->name = $name;
                        $company->abrv = $abrv;
                        $company->comp_add = $request->input('company_add');

                        $company->location = $loc;
                        $company->contact = $request->input('contact');

                        $company->email = $request->input('email');
                        $company->website = $request->input('company_web');
                        $company->reg_date = Date('d-m-Y');
                        $company->logo = $filenameToStore;

                        $company->save();
                        return redirect('/companysetup')->with('success', 'Company`s details successfully updated');
                    } catch(Exception $ex){
                        return redirect('/companysetup')->with('error', 'Oops..! Something went wrong');
                    }

                }else{

                    try {
                        $this->validate($request, [
                            'company_logo'   => 'required|max:5000|mimes:jpeg,jpg,png'
                        ]);
                        if($request->hasFile('company_logo')){
                            //get filename with ext
                            $filenameWithExt = $request->file('company_logo')->getClientOriginalName();
                            //get filename
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            //get file ext
                            $fileExt = $request->file('company_logo')->getClientOriginalExtension();
                            //filename to store
                            $filenameToStore = 'company_logo.'.$fileExt;
                            //upload path
                            $path = $request->file('company_logo')->storeAs('public/classified/company', $filenameToStore);
                        }else{
                            $filenameToStore = '';
                        }
            
                    } catch (\Throwable $th) {
                        throw $th;
                        return redirect('/companysetup')->with('error', 'Ooops..! Something went wrong33');
                    }
                    

                    try {
                        $company = new Company;
                        $company->user_id = auth()->user()->id;
                        $company->name = $name;
                        $company->abrv = $abrv;
                        $company->comp_add = $request->input('company_add');

                        $company->location = $loc;
                        $company->contact = $request->input('contact');

                        $company->email = $request->input('email');
                        $company->website = $request->input('company_web');
                        $company->reg_date = Date('d-m-Y');
                        $company->logo = $filenameToStore;

                        $company->save();
                        return redirect('/companysetup')->with('success', 'Company`s details successfully added');
                    } catch(\Throwable $th){
                        throw $th;
                        return redirect('/companysetup')->with('error', 'Ooops..! Something went wrong22');
                    }
                    
                }
                
            break;

            case 'add_make':
                try {

                    $this->validate($request, [
                        'pass_photo'  => 'max:5000|mimes:jpeg,jpg,png'
                    ]);
                    // if($request->hasFile('pass_photo')){
                        //get filename with ext
                        $filenameWithExt = $request->file('pass_photo')->getClientOriginalName();
                        //get filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        //get file ext
                        $fileExt = $request->file('pass_photo')->getClientOriginalExtension();
                        //filename to store
                        $filenameToStore = $request->input('model_code').'.'.$fileExt;
                        //upload path
                        $path = $request->file('pass_photo')->storeAs('public/classified/makes', $filenameToStore);
                    // }else{
                    //     return 171819;
                    //     $filenameToStore = $company->logo;
                    // }
                    
                } catch (\Throwable $th) {
                    // throw $th;
                    return redirect(url()->previous())->with('error', 'Ooops..! Logo Upload Error');
                }
                try {
                    $add_make = Make::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'model_name' => $request->input('model_name'),
                        'model_code' => $request->input('model_code'),
                        'logo' => $filenameToStore,
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', '`'.$add_make->model_name.'` Successfully Added to Car Models');

            break;

            case 'add_type':

                // $accs = '';
                // foreach ($request->input('accessory') as $value) {
                //     $accs = $accs.'</p><p>'.$value;
                // }
                // $accs = '<p>'.$accs.'</p>';
                // return $accs;

                try {

                    $this->validate($request, [
                        'pass_photo'  => 'max:5000|mimes:jpeg,jpg,png'
                    ]);
                    // if($request->hasFile('pass_photo')){
                        //get filename with ext
                        $filenameWithExt = $request->file('pass_photo')->getClientOriginalName();
                        //get filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        //get file ext
                        $fileExt = $request->file('pass_photo')->getClientOriginalExtension();
                        //filename to store
                        $filenameToStore = $request->input('name').'.'.$fileExt;
                        //upload path
                        $path = $request->file('pass_photo')->storeAs('public/classified/types', $filenameToStore);
                    // }else{
                    //     return 171819;
                    //     $filenameToStore = $company->logo;
                    // }
                    
                } catch (\Throwable $th) {
                    // throw $th;
                    return redirect(url()->previous())->with('error', 'Ooops..! Logo Upload Error');
                }
                try {
                    $add_type = Type::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'name' => $request->input('name'),
                        'img' => $filenameToStore,
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', '`'.$add_type->name.'` Successfully Added to Vehicle Types');

            break;

            case 'add_submodel':
                
                $makes = Make::orderBy('model_name', 'ASC')->get();
                if (count($makes) == 0) {
                    return redirect(url()->previous())->with('error', 'Ooops..! Add vehicle model in order to add submodel');
                }

                try {
                    $add_submodel = Submodel::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'make_id' => $request->input('make_id'),
                        'sub_name' => $request->input('sub_name'),
                        'sub_code' => $request->input('sub_code'),
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', '`'.$add_submodel->sub_name.'` Successfully Added to Submodels');

            break;

            case 'test_photos':
                
                try {
                    // \Storage::move(storage_path("/storage/classified/cars/SM052300/0523_f42a37d.jpg"), storage_path("/storage/classified"));
                    $img = \Image::make("/public/storage/classified/cars/SM052300/0523_f42a37d.jpg");
                    $img->save("/storage/classified/cars/SM052300/newcar.jpg");
                    return 'Done..!';
                    if($files = $request->file('photo')){
                        foreach ($files as $file) {
                            # code...
                            $this->validate($request, [
                                'photo'  => 'max:1000'
                            ]);
                            $filenameWithExt = $file->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $fileExt = $file->getClientOriginalExtension();
                            $filenameToStore = date('my_').substr(md5(rand(1000, 10000)), 0, 7).'.'.$fileExt;
                            $img = Image::make($file);
                            // $img = Image::make($file)->insert('/Users/jbazz/Documents/Lara/carshop/public/maindir/images/maca_wt.png');
                            
                            // $img->save(\public_path($filenameToStore), 30);
                            $img->save(storage_path().$filenameToStore, 30);
                            // \Storage::move('public/0923_085ccad.jpg', 'public/new');
                            // \Storage::move('/Users/jbazz/Documents/Lara/carshop/public/0923_085ccad.jpg', 'public/classified');
                            // \Storage::disk('local')->put('public/classified', $file);
                            // \Storage::disk('local')->put('public/classified', 'public/'.$filenameToStore);
                            // $img->save(\Storage::disk('local')->put($filenameToStore,), 30);

                        }
                    }
                    return redirect(url()->previous())->with('success', 'Upload Successfull!');
                    
                } catch (Exception $ex) {
                    return $ex;
                    return redirect(url()->previous())->with('error', 'Ooops..! Check file type and size');
                }
                return redirect(url()->previous())->with('success', '`'.$add_submodel->sub_name.'` Successfully Added to Submodels');

            break;

            case 'add_vehicle':

                if ($request->input('year') == 0) {
                    return redirect(url()->previous())->with('error', 'Oops..! Select Year to Proceed');
                }

                $model_code = $request->input('model_code');
                $chassis_no = $request->input('chassis_no');
                $emp_check = Car::where('chassis_no', $chassis_no)->get();
                
                if (count($emp_check) > 0) {
                    return redirect(url()->previous())->with('error', 'Oops..! Details already exist');
                } else {
                
                    try {

                        $car_insert = Car::firstOrCreate([
                            'user_id' => auth()->user()->id,
                            'stock_id' => $request->input('stock_id'),
                            'chassis_no' => $request->input('chassis_no'),
                            'make_id' => $request->input('make_id'),
                            'submodel_id' => $request->input('submodel_id'),
                            'inv_loc' => $request->input('inv_loc'),
                            'model_code' => $model_code,
                            'price' => $request->input('price'),
                            'flash' => $request->input('flash'),
                            'year' => $request->input('year'),
                            'mileage' => $request->input('mileage'),
                            'color' => $request->input('color'),
                            'trans' => $request->input('trans'),
                            'drive' => $request->input('drive'),
                            'steer' => $request->input('steer'),
                            'seat' => $request->input('seat'),
                            'eng_type' => $request->input('eng_type'),
                            'door' => $request->input('door'),
                            'eng_size' => $request->input('eng_size'),
                            'body_type' => $request->input('body_type'),
                            'fuel' => $request->input('fuel'),
                            'body_len' => $request->input('body_len'),
                            'vweight' => $request->input('veh_weight'),
                            'gvweight' => $request->input('gross_weight'),
                            'max_load' => $request->input('max_load'),
                            'accessory' => $request->input('accessory')
                            // 'loan_date_started','loan_bal','loan_montly_ded'
                        ]);

                    // try {
                        if($files = $request->file('photo')){
                            foreach ($files as $file) {
                                # code...
                                $this->validate($request, [
                                    'photo'  => 'max:3000'
                                ]);
                                $filenameWithExt = $file->getClientOriginalName();
                                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                                $fileExt = $file->getClientOriginalExtension();
                                // $filenameToStore = date('my_').substr(md5(rand(1000, 10000)), 0, 7).'.'.$fileExt;
                                $filenameToStore = date('my_').substr(md5(rand(1000, 10000)), 0, 7).'.jpg';
                                // $path = $file->storeAs('public/classified/cars/'.$car_insert->stock_id, $filenameToStore);
                                
                                if (!is_dir(storage_path("app/public/classified/cars/".$car_insert->stock_id))) {
                                    mkdir(storage_path("app/public/classified/cars/".$car_insert->stock_id), 0775, true);
                                    // mkdir(storage_path("app/public/classified"), 0775, true);
                                }
                                // Upload (IMAGE INTERVENTION - LARAVEL)
                                $img = Image::make($file)->resize(500, 375)
                                ->insert(storage_path('app/public/classified/maca_wt.png'))
                                ->save(storage_path("app/public/classified/cars/".$car_insert->stock_id.'/'.$filenameToStore));
                                    
                                $gallery = Gallery::firstOrCreate([
                                    'user_id' => auth()->user()->id,
                                    'car_id' => $car_insert->id,
                                    'img' => $filenameToStore
                                ]);
                            }
                        }
                        return redirect(url()->previous())->with('success', 'Upload Successfull!');
                    } catch (\Throwable $th) {
                        throw $th;
                        return redirect(url()->previous())->with('error', 'Ooops..! Check inputs, file type and size');
                    }

                    return redirect(url()->previous())->with('success', 'Vehicle details successfully added');
                }                                                                                                                                                                                      

            break;

            case 'add_part':
                // return 100921;
                try {

                    $part_insert = Part::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'stock_id' => $request->input('stock_id'),
                        'name' => $request->input('name'),
                        'desc' => $request->input('desc')
                    ]);

                
                    if($files = $request->file('photo')){
                        foreach ($files as $file) {
                            # code...
                            $this->validate($request, [
                                'photo'  => 'max:3000'
                            ]);
                            $filenameWithExt = $file->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $fileExt = $file->getClientOriginalExtension();
                            $filenameToStore = date('my_').substr(md5(rand(1000, 10000)), 0, 7).'.jpg';
                            
                            if (!is_dir(storage_path("app/public/classified/parts/".$part_insert->stock_id))) {
                                mkdir(storage_path("app/public/classified/parts/".$part_insert->stock_id), 0775, true);
                            }
                            $img = Image::make($file)->resize(500, 375)
                            ->insert(storage_path('app/public/classified/maca_wt.png'))
                            ->save(storage_path("app/public/classified/parts/".$part_insert->stock_id.'/'.$filenameToStore));
                                
                            $gallery = Gallery::firstOrCreate([
                                'user_id' => auth()->user()->id,
                                'part_id' => $part_insert->id,
                                'img' => $filenameToStore
                            ]);
                        }
                    }
                    return redirect(url()->previous())->with('success', 'Vehicle Part Upload Successfull!');
                } catch (\Throwable $th) {
                    $part_insert->delete();
                    throw $th;
                    return redirect(url()->previous())->with('error', 'Ooops..! Check inputs, file type and size');
                }

                return redirect(url()->previous())->with('success', 'Vehicle part successfully added');

            break;

            case 'search_veh':

                // return 99;
                // Search Employee Data
                $src = $request->input('search_veh');
                // return $src;
                $cars = Car::where('stock_id', 'LIKE', '%'.$src.'%')->orwhere('model_code', 'LIKE', '%'.$src.'%')->orwhere('year', 'LIKE', '%'.$src.'%')->orwhere('color', 'LIKE', '%'.$src.'%')->orwhere('body_type', 'LIKE', '%'.$src.'%')->orwhere('fuel', 'LIKE', '%'.$src.'%')->paginate(20);
                $patch = [
                    'c' => 1,
                    'cars' => $cars,
                    'types' => Type::all(),
                    'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
                    // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
                    'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
                    // 'cars' => Car::where('del', 'no')->where('promote', 'yes')->where('flash', '0')->orderBy('id', 'DESC')->limit(10)->get()
                ];
                
                return view('showcase')->with($patch);
                // End Search

            break;

            case 'dash_search_veh':

                // Search Employee Data
                $src = $request->input('search_emp');
                // return $src;
                $cars = Car::where('stock_id', 'LIKE', '%'.$src.'%')->orwhere('model_code', 'LIKE', '%'.$src.'%')->orwhere('year', 'LIKE', '%'.$src.'%')->orwhere('color', 'LIKE', '%'.$src.'%')->orwhere('body_type', 'LIKE', '%'.$src.'%')->orwhere('fuel', 'LIKE', '%'.$src.'%')->paginate(20);
                $patch = [
                    'c' => 1,
                    'cars' => $cars,
                    'makes' => Make::orderBy('model_name', 'ASC')->get(),
                    'submodels' => Submodel::orderBy('sub_name', 'ASC')->get()
                ];
                return view('dash.car_vehicle_view')->with($patch);

            break;

            case 'inquire':

                try {
                    $inquire = Inquire::firstOrCreate([
                        'name' => $request->input('name'),
                        'phone' => $request->input('phone'),
                        'email' => $request->input('email'),
                        'message' => $request->input('message'),
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', 'Thank you '.$request->input('name').' for reaching out to us. Our customer service team will reach out to you soon on '.$request->input('email'));

            break;

            case 'add_about':

                try {
                    $about = About::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'title' => $request->input('title'),
                        'body' => $request->input('body'),
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', 'About Paragraph Added');

            break;

            case 'add_service':

                try {
                    $service = Service::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'title' => $request->input('title'),
                        'body' => $request->input('body'),
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', 'Service Paragraph Added');

            break;

            case 'add_variables':

                $check = Variable::where('item', $request->input('item'))->get();
                if ($request->input('item') == 'cont') {
                    $item = 'Container';
                } else {
                    $item = 'Roro';
                }
                if (count($check) > 0) {
                    return redirect(url()->previous())->with('error', 'Oops..! '.$item.' variables already added');
                }

                try {
                    $about = Variable::firstOrCreate([
                        'user_id' => auth()->user()->id,
                        'item' => $request->input('item'),
                        'freight' => $request->input('freight'),
                        'inspection' => $request->input('inspection'),
                        'insurance' => $request->input('insurance'),
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect(url()->previous())->with('success', 'Shipment Variables Added');

            break;

        }

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
        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
            'cars' => Car::where('make_id', $id)->where('del', 'no')->orderBy('id', 'DESC')->paginate(20)
        ];
        return view('showcase')->with($patch);
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
        // $car = Type::find($id)->get('name');
        // return $id;
        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
            'cars' => Car::where('body_type', 'LIKE', '%'.$id.'%')->where('del', 'no')->orderBy('id', 'DESC')->paginate(20)
        ];
        return view('showcase')->with($patch);
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
        switch ($request->input('update_action')) {

            // Update
            case 'update_make':
                $make = Make::find($id);
                $make->model_name = $request->input('model_name');
                $make->model_code = $request->input('model_code');
                $make->status = $request->input('status');
                $make->save();
                return redirect(url()->previous())->with('success', $make->model_name.' Successfully Updated!');
            break;

            case 'update_submodel':
                $submodel = Submodel::find($id);
                $submodel->make_id = $request->input('make_id');
                $submodel->sub_name = $request->input('sub_name');
                $submodel->sub_code = $request->input('sub_code');
                $submodel->status = $request->input('status');
                $submodel->save();
                return redirect(url()->previous())->with('success', $submodel->sub_name.' Successfully Updated!');
            break;

            case 'update_vehicle':
                // return 7;
                try {
                    $veh = Car::find($id);
                    // $veh->stock_id = $request->input('stock_id');
                    $veh->chassis_no = $request->input('chassis_no');
                    $veh->make_id = $request->input('make_id');
                    $veh->submodel_id = $request->input('submodel_id');
                    $veh->inv_loc = $request->input('inv_loc');
                    $veh->model_code = $request->input('model_code');
                    $veh->price = $request->input('price');
                    $veh->flash = $request->input('flash');
                    $veh->year = $request->input('year');
                    $veh->mileage = $request->input('mileage');
                    $veh->color = $request->input('color');
                    $veh->trans = $request->input('trans');
                    $veh->drive = $request->input('drive');
                    $veh->steer = $request->input('steer');
                    $veh->seat = $request->input('seat');
                    $veh->eng_type = $request->input('eng_type');
                    $veh->door = $request->input('door');
                    $veh->eng_size = $request->input('eng_size');
                    $veh->body_type = $request->input('body_type');
                    $veh->fuel = $request->input('fuel');
                    $veh->body_len = $request->input('body_len');
                    $veh->vweight = $request->input('veh_weight');
                    $veh->gvweight = $request->input('gross_weight');
                    $veh->max_load = $request->input('max_load');
                    $veh->accessory = $request->input('accessory');
                    $veh->save();
                    return redirect('/view_vehicle')->with('success', $request->input('model_code')."'s details successfully updated!");
                } catch (\Throwable $th) {
                    return redirect(url()->previous())->with('error', 'Oops..! Something went wrong');
                }
            break;

            case 'update_part':
                // return 7;
                try {
                    $veh = Part::find($id);
                    // $veh->stock_id = $request->input('stock_id');
                    $veh->name = $request->input('name');
                    $veh->desc = $request->input('desc');
                    $veh->save();
                    return redirect('/view_parts')->with('success', $request->input('name')."'s details successfully updated!");
                } catch (\Throwable $th) {
                    return redirect(url()->previous())->with('error', 'Oops..! Something went wrong');
                }
            break;

            case 'publish_car':
                $veh = Car::find($id);
                $veh->promote = 'yes';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Promoted to front page!');
            break;

            case 'unpublish_car':
                $veh = Car::find($id);
                $veh->promote = 'no';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Removed from front page!');
            break;

            case 'del_car':
                $veh = Car::find($id);
                $veh->del = 'yes';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Deleted!');
            break;

            case 'restore_car':
                $veh = Car::find($id);
                $veh->del = 'no';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Restored!');
            break;

            case 'del_part':
                $veh = Part::find($id);
                $veh->status = 'Inactive';
                $veh->del = 'yes';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Deleted!');
            break;

            case 'restore_part':
                $veh = Part::find($id);
                $veh->status = 'Active';
                $veh->del = 'no';
                $veh->save();
                return redirect(url()->previous())->with('success', $veh->model_code.' Restored!');
            break;

            case 'open_inq':
                $inq = Inquire::find($id);
                $inq->status = 'active';
                $inq->save();
                return redirect(url()->previous())->with('success', $inq->name.'`s inquiry status changed to `Not Read`!');
            break;

            case 'close_inq':
                $inq = Inquire::find($id);
                $inq->status = 'inactive';
                $inq->save();
                return redirect(url()->previous())->with('success', $inq->name.'`s inquiry status changed to `Read`!');
            break;

            case 'update_about':
                $inq = About::find($id);
                $inq->title = $request->input('title');
                $inq->body = $request->input('body');
                $inq->save();
                return redirect(url()->previous())->with('success', 'About paragraph updated');
            break;

            case 'update_service':
                $inq = Service::find($id);
                $inq->title = $request->input('title');
                $inq->body = $request->input('body');
                $inq->save();
                return redirect(url()->previous())->with('success', 'Service Updated');
            break;

            case 'update_variables':
                $inq = Variable::find($id);
                // $inq->item = $request->input('item');
                $inq->freight = $request->input('freight');
                $inq->inspection = $request->input('inspection');
                $inq->insurance = $request->input('insurance');
                $inq->save();
                return redirect(url()->previous())->with('success', 'Variables Successfully Updated');
            break;

        }

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
