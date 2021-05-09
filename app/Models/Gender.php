<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = "gender";
    use HasFactory;

    public function customer(){
        return $this->hasMany(Customer::class);
    }
    public function employee(){
        return $this->hasMany(Employee::class);
    }
}
