<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','model_name','model_code','logo','status'
    ];

    public function car(){
        return $this->hasMany('App\Models\Car');
    }

}
