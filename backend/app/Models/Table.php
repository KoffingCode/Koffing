<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

	protected $fillable = [
		'number',
		'state',
		'capacity',
		'type',
		'turn_id'
	];

	public function turn()
	{
		return $this->belongsTo(Turn::class);
	}
}
