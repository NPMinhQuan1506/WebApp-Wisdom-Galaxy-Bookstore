<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier";
    use HasFactory;

    public function product(){
        return $this->hasMany(Product::class);
    }
    public function import(){
        return $this->hasMany(Import::class);
    }
}
