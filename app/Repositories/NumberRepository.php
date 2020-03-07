<?php

namespace App\Repositories;

use App\Models\Total;

class NumberRepository
{
	private $total;

	public function __construct(Total $total)
	{
		$this->total = $total;
	}

	public function getTotal(int $userId)
	{
		return $this->total->where('user', $userId)->first();
	}

	public function save(Total $total)
	{
		return $total->save();
	}
}
