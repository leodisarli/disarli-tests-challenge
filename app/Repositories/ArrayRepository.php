<?php

namespace App\Repositories;

use App\Models\MyArrayModel;

class ArrayRepository
{
    public function __construct(MyArrayModel $myArrayModel)
    {
        $this->myArrayModel = $myArrayModel;
    }

    public function generateRandomArray($size, $min, $max)
    {
        $result = [];
        for ($i=0; $i < $size ; $i++) { 
            $result[] = rand($min, $max);
        }
        return $result;
    }

    public function getMyArrays()
    {
        return $this->myArrayModel
            ->where('active', 1)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
    }

}