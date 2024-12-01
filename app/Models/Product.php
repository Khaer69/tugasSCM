<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);  // Assuming Kategori model has a foreign key 'kategori_id'
    }
}
