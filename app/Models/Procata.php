<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procata extends Model
{
    protected $table = 'product_catalog';

    public function product(){
    	return $this->hasMany('App\Models\Product','product_id','id');
    }

    public function catalog(){
    	return $this->hasMany('App\Models\Product','catalog_id','id');
    }
}
