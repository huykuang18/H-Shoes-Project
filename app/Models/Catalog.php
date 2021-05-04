<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';

    public function products(){
    	return $this->belongsTo(Product::class);
    }
}
