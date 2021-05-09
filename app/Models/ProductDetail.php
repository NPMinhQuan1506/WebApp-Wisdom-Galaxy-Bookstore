<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = "product_detail";
    protected $primaryKey = "sku";
    use HasFactory;

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function author(){
        return $this->belongsToMany(Author::class, 'product_author', 'product_id', 'author_id');
    }
}
