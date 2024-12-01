<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $guarded = ['id'];


    public function products(){
        return $this->hasMany(Product::class);  // Assuming Product model has a foreign key 'kategori_id'
    }
}
