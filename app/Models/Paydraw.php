<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paydraw extends Model
{
    use HasFactory;

    protected $table = 'pay_draw';

    protected $fillable = [
        'type_pd',
        'user_id',
        'value'
    ];

    public function getType()
    {
        return $this->hasOne('App\Models\TypePayDraw', 'id', 'type_pd');
    }
}
