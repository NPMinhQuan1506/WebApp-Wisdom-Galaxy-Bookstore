<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = "import";
    public $timestamps = false;
    use HasFactory;

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function product(){
        return $this->belongsToMany(Product::class, 'import_detail', 'import_id', 'product_id');
    }
}
