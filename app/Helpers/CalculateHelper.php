<?php

namespace App\Helpers;

class CalculateHelper
{
	public function calcArea(int $height, int $width)
	{
		return $height * $width;
	}

	public function calcAreaTriangle(int $height, int $base)
	{
		return ($height * $base) / 2;
	}
}
