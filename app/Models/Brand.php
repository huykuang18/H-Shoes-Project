<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';
    public $timestamps = false;

    public function product(){
    	return $this->hasMany('App\Models\Product','brand_id','id');
    }
    protected $guarded = [];  
}
