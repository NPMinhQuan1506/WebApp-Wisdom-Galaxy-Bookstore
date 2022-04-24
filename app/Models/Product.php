<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = "sku";
    use HasFactory;

    public function category(){
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }
    public function discount(){
        return $this->belongsToMany(Discount::class, 'discount_detail', 'product_id', 'discount_id');
    }
    public function order(){
        return $this->belongsToMany(Order::class, 'order_detail', 'product_id', 'order_id');
    }
    public function import(){
        return $this->belongsToMany(Import::class, 'import_detail', 'product_id', 'import_id');
    }
    public function product_detail(){
        return $this->hasOne(ProductDetail::class,'sku','sku');
    }
    public function image(){
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
