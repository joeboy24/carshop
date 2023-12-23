<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','stock_id','name','desc','status','del'
    ];

    public function gallery(){
        return $this->HasMany('App\Models\Gallery');
    }
}
