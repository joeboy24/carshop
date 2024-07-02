<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Company;
use App\Models\Car;
// use App\Models\NewsBlog;
// use App\Models\Program;
use Session;
use Auth;

class load_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (Auth::check()) {
        // }else {
            // $company = Company::find(1);
            // $program = Program::all();
            // $event = Event::where('del', 'no')->latest()->first();
            // $newsblog = NewsBlog::orderBy('id', 'DESC')->where('del', 'no')->limit(2)->get();
            // $newsblog6 = NewsBlog::orderBy('id', 'DESC')->where('del', 'no')->limit(6)->get();
            // $homepage = Homepage::where('del', 'no')->Latest()->first();
            // // $newsblog = 5;
            // Session::put('program', $program);
            // Session::put('company', $company);
            // Session::put('newsblog', $newsblog);
            // Session::put('newsblog6', $newsblog6);
            // Session::put(['homepage' => $homepage, 'event' => $event]);
            
            if (session::get('cars') != '') {} else {
                # code...
            
                $available = Car::select(['id','make_id'])->distinct('make_id')->limit(5)->get();
                $car_color = Car::select('color')->distinct('color')->get();
                $car_year = Car::select('year')->distinct('year')->get();
                
                session::put('about', About::find(1));
                session::put('avail', $available);
                session::put('car_color', $car_color);
                session::put('company', Company::find(1));
                session::put('cars', Car::where('del', 'no')->limit(3)->get());
            }
        
            return $next($request);
            // return redirect('/uiuytyu');
        // }
    }
}
