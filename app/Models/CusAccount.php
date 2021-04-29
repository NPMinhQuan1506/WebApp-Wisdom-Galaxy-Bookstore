<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CusAccount extends Model
{
    protected $table = "cus_account";
    use HasFactory;

    public function account(){
        return $this->belongsTo(Customer::class);
    }
}
