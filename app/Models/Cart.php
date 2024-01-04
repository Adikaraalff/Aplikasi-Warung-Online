<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users', 'id_products', 'amount',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_users');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_products');
    }

    public function showCart()
    {
        $carts = Cart::with('product')->where('id_users', Auth::id())->get();

        return view('carts', compact('carts'));
    }
}
