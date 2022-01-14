<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paydraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_pd',
        'user_id'
    ];
}
