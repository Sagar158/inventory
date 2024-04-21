<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public static $status = ['available' => 'Available', 'not_available' => 'Not Available'];

    public function details()
    {
        return $this->hasMany(ProductDetails::class,'product_id','id');
    }

    public function category()
    {
        return $this->hasOne(Categories::class,'id','category_id');
    }
    public function supplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function relatedProducts()
    {
        return $this->hasMany(Products::class, 'category_id', 'category_id')->where('id', '!=', $this->id)->orderBy('id','desc')->limit(6);
    }
    public function primaryImage(){
        return $this->hasOne(ProductDetails::class,'product_id');
    }
}
