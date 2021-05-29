<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];  

    public function catalog()
    {
    	return $this->belongsTo('App\Models\Catalog','catalog_id','id');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Models\Brand','brand_id','id');
    }

    public function order_detail()
    {
    	return $this->hasMany('\App\Models\OrderDetail','product_id','id');
    }

    public function rate()
    {
        return $this->hasMany('\App\Models\Rate','product_id','id');
    }

    public function sale()
    {
    	return $this->belongsTo('App\Models\Sale','sale_id','id');
    }

    public function productDetail()
    {
    	return $this->belongsTo('App\Models\ProductDetail','product_id','id');
    } 
}
