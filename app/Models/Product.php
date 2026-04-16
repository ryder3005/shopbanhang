<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $primaryKey ='product_id';
    protected $table = 'products';
    public function brand(){
        return $this->belongsTo(Brand::class,'brands_id','brand_id');
    }
}
