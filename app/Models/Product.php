<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $fillable = [
        'id', 'nama_products', 'price', 'keterangan', 'file', 'id_kategoris',
    ];

    public function Kategori() {
        return $this->hasOne(Kategori::class, 'id', 'id_kategoris');
    }
}
