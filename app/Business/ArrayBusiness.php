<?php

namespace App\Business;

use App\Repositories\ArrayRepository;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class ArrayBusiness
{
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function generateRandomArray($size, $min, $max)
    {
        $arrayRepository = $this->container->make(ArrayRepository::class);
        return $arrayRepository->generateRandomArray($size, $min, $max);
    }

    public function returnDaysArrays()
    {
        $carbon = new Carbon();
        $result['yesterday'] = $carbon->now()->subDay()->format('Y-m-d');
        $result['today'] = $carbon->now()->format('Y-m-d');
        $result['tomorrow'] = $carbon->now()->addDay()->format('Y-m-d');
        return $result;
    }

    public function returnUuids($number = 1)
    {
        $result = [];
        for ($i=0; $i < $number ; $i++) { 
            $result[] = Uuid::uuid4()->toString();
        }
        return $result;
    }
}