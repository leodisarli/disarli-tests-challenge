<?php

namespace App\Models;

class Rectangle extends Model
{
    protected $table = 'rectangle';
    protected $fillable = [
        'id',
        'height',
        'width',
        'area'
    ];
}
