<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";

    protected $fillable = [
        'id', 'id_users', 'total', 'payment_method', 'status',
    ];

    public function User() {
        return $this->hasOne(User::class, 'id', 'id_users');
    }
}
