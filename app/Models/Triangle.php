<?php

namespace App\Models;

class Triangle extends Model
{
    protected $table = 'triangle';
    protected $fillable = [
        'id',
        'height',
        'base',
        'area'
    ];
}
