<?php

namespace App\Models;

class Total extends Model
{
    protected $table = 'total';
    protected $fillable = [
        'id',
        'user',
        'total'
    ];
}
