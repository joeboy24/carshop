<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','car_id','part_id','img','status'
    ];

    public function car(){
        return $this->belongsTo('App\Models\Car');
    }

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }

}
