<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    use HasFactory;

    public function image(){
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
    public function gender(){
        return $this->belongsTo(Gender::class, 'id', 'gender_id');
    }
    public function type(){
        return $this->belongsTo(CustomerType::class, 'id', 'customer_type_id');
    }
    public function account(){
        return $this->hasOne(CusAccount::class, 'id', 'account_id');
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
}
