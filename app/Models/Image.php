<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "image";
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class, 'image_id', 'id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class, 'image_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'image_id', 'id');
    }
}
