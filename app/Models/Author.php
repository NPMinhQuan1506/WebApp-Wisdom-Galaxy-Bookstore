<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = "author";
    use HasFactory;

    public function product(){
        return $this->belongsToMany(ProductDetail::class, 'product_author', 'author_id', 'product_id');
    }
}
