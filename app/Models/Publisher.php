<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = "publisher";
    use HasFactory;

    public function product(){
        return $this->hasMany(ProductDetail::class, 'publisher_id', 'id');
    }
}
