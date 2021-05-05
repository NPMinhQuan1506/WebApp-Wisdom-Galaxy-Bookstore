<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = "gender";
    use HasFactory;

    public function customer(){
        return $this->hasMany(Customer::class, 'gender_id', 'id');
    }
    public function employee(){
        return $this->hasMany(Employee::class, 'gender_id', 'id');
    }
}
