<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password','tanggal_lahir','no_hp','alamat','user_id'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
