<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Make;
use App\Models\Car;
use App\Models\Type;
use App\Models\User;
use App\Models\About;
use App\Models\Service;
use App\Models\Inquire;
use App\Models\SubModel;
use App\Models\Variable;
use Session;

class CarpagesController extends Controller
{
    //  
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function car_dashboard(){
        session::put('about', About::find(1));
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $patch = [
            'c' => 1,
            'pays' => '12,000',
            'analytics' => 277,
            'car_count' => Car::all()->count(),
            'user_count' => User::all()->count(),
        ];
        return view('dash.car_dashboard')->with($patch);
    }

    public function car_addabout(){

        $patch = [
            'c' => 1,
            'about' => About::orderBy('id', 'ASC')->paginate(20),
        ];
        return view('dash.car_addabout')->with($patch);
    }

    public function car_addservice(){

        $patch = [
            'c' => 1,
            'services' => Service::orderBy('id', 'ASC')->paginate(20),
        ];
        return view('dash.car_service')->with($patch);
    }

    public function car_adduser(){

        $users = User::orderBy('id', 'DESC')->paginate(20);
        $patch = [
            'c' => 1,
            'users' => $users,
        ];
        return view('dash.car_adduser')->with($patch);
    }

    public function car_new_entry(){
        session::put('about', About::find(1));
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $types = Type::where('status', 'active')->get();
        $makes = Make::orderBy('model_name', 'ASC')->get();
        $submodels = Submodel::orderBy('sub_name', 'ASC')->get();
        if (count($types) == 0) {
            return redirect(url()->previous())->with('error', 'Ooops..! Add vehicle types in order to make new entry');
        }
        if (count($types) == 0 || count($submodels) == 0) {
            return redirect(url()->previous())->with('error', 'Ooops..! Add vehicle Models & Submodels in order to make new entry');
        }
        $patch = [
            'c' => 1,
            'y' => 1,
            'cars_tot' => Car::all()->count(),
            'types' => $types,
            'makes' => $makes,
            'submodels' => $submodels,
        ];
        return view('dash.car_newentry')->with($patch);
    }

    public function car_company(){
        $company = Company::find(1);
        return view('dash.car_company')->with('company', $company);
    }

    public function car_model_mgt(){
        $company = Company::find(1);
        $patch = [
            'c' => 1,
            'y' => 1,
            'makes' => Make::orderBy('model_name', 'ASC')->get(),
            'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'makes_page' => Make::where('del', 'no')->orderBy('id', 'DESC')->paginate(10),
            'submodels_page' => Submodel::where('del', 'no')->orderBy('id', 'DESC')->paginate(10),
        ];
        return view('dash.car_model_mgt')->with($patch);
    }

    public function car_view_vehicle(){
        // $users = User::where('status', '!=', 'Student')->get();
        $cars = Car::orderBy('id', 'DESC')->paginate(20);
        $patch = [
            'c' => 1,
            'cars' => $cars,
            'makes' => Make::orderBy('model_name', 'ASC')->get(),
            'submodels' => Submodel::orderBy('sub_name', 'ASC')->get()
        ];
        return view('dash.car_vehicle_view')->with($patch);
    }

    public function car_vehicle_types(){
        $company = Make::find(1);
        $patch = [
            'c' => 1,
            'types' => Type::where('status', 'active')->get(),
        ];
        return view('dash.car_types')->with($patch);
    }

    public function car_inquire(){

        $inqs = Inquire::orderBy('id', 'DESC')->paginate(20);
        $patch = [
            'c' => 1,
            'inqs' => $inqs,
        ];
        return view('dash.car_inquiry')->with($patch);
    }

    public function car_variables(){

        $patch = [
            'c' => 1,
            'variables' => Variable::orderBy('id', 'ASC')->get(),
        ];
        return view('dash.car_variables')->with($patch);
    }
    
}
