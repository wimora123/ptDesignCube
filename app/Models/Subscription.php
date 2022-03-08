<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Subscription extends Model
{
    use HasFactory;


	protected $casts = [
    'created_at' => 'datetime:j F Y',
	];
}
