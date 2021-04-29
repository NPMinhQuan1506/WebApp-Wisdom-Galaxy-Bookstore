<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employee";
    use HasFactory;

    public function image(){
        return $this->hasOne(Image::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function account(){
        return $this->hasOne(EmployeeAccount::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
    public function import(){
        return $this->hasMany(Import::class);
    }
}
