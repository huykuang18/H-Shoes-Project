<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';
    public $timestamps = false;

    public function product(){
    	return $this->hasMany('App\Models\Product','catalog_id','id');
    }
    protected $guarded = [];  
}
