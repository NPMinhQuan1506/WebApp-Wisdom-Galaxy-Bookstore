<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = "discount";
    use HasFactory;

    public function product(){
        return $this->belongsToMany(Product::class, 'discount_detail', 'discount_id', 'product_id');
    }
}
