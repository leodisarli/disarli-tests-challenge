<?php

namespace App\Repositories;

use App\Models\Triangle;

class TriangleRepository
{
	private $triangle;

	public function __construct(Triangle $triangle)
	{
		$this->triangle = $triangle;
	}

	public function get(int $id): Triangle
	{
		$triangle = $this->triangle->find($id);
		if (!$triangle) {
			throw new Exception('Triângulo não encontrado', 404);
		}

		return $triangle;
	}

	public function save(Triangle $triangle): Triangle
	{
		return $triangle->save();
	}
}
