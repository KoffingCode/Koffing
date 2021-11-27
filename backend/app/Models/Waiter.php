<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;

    /**
     * Gets the user that owns the waiter
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function turns()
    {
        return $this->belongsToMany(Turn::class);
    }
}
