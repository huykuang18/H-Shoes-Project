<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function catalogs(){
    	return $this->belongsToMany(Catalog::class);
    }

    public function order_detail(){
    	return $this->hasMany('\App\Models\OrderDetail','product_id','id');
    }
}
