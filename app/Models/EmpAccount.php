<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpAccount extends Model
{
    protected $table = "emp_account";
    use HasFactory;

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
