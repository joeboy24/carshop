<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','car_id','img','status'
    ];

    public function car(){
        return $this->belongsTo('App\Models\Car');
    }

}
