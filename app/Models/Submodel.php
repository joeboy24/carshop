<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','make_id','sub_name','sub_code','status'
    ];

    public function make(){
        return $this->belongsTo('App\Models\Make');
    }

}
