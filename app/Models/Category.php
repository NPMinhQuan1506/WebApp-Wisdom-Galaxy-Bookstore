<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    use HasFactory;

    public function product(){
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

}
