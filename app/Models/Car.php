<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','stock_id','make_id','submodel_id','inv_loc','model_code','year',
        'mileage','color','trans','drive','steer','seat','eng_type','door','eng_size',
        'body_type','fuel','body_len','vweight','gvweight','max_load','accessory','price','flash','promote'
    ];

    public function make(){
        return $this->belongsTo('App\Models\Make');
    }

    public function submodel(){
        return $this->belongsTo('App\Models\Submodel');
    }

    public function gallery(){
        return $this->hasMany('App\Models\Gallery');
    }

}
