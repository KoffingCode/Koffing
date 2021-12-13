<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 
        'email', 
        'password', 
        'role'
    ];

    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}
