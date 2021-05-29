<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $guarded = []; 
    
    public function order()
    {
        return $this->hasMany('\App\Models\Order','customer_id','id');
    } 
}
