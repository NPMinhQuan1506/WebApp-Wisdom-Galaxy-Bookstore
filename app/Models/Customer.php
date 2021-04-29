<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    use HasFactory;

    public function image(){
        return $this->hasOne(Image::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function type(){
        return $this->belongsTo(CustomerType::class);
    }
    public function account(){
        return $this->hasOne(CustomerAccount::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
}
