<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_address',
        // tambahkan kolom lain sesuai kebutuhan
    ];

    // Definisikan relasi dengan model User jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
