<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    /**
     * Gets the user that owns the administrator
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
