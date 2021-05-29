<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rate';
    protected $guarded = [];  

    public function product()
    {
        return $this->belongsTo('\App\Models\Product','product_id','id');
    }
}
