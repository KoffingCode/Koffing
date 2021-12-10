<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable = [
		'type',
		'date',
		'startingHour',
		'endingHour'
	];

    public function waiters()
    {
        return $this->belongsToMany(Waiter::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
