<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';
    public $timestamps = false;
    protected $guarded = [];  

    public function product(){
    	return $this->hasMany('App\Models\Product','sale_id','id');
    }
}
