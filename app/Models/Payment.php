<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    public $timestamps = false;
    protected $guarded = [];  

    public function order()
    {
		return $this->hasMany('\App\Models\Order','payment_id','id');
	}
}
