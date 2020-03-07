<?php

namespace App\Repositories;

use App\Models\Rectangle;

class RectangleRepository
{
	private $rectangle;

	public function __construct(Rectangle $rectangle)
	{
		$this->rectangle = $rectangle;
	}

	public function get(int $id): Rectangle
	{
		$rectangle = $this->rectangle->find($id);
		if (!$rectangle) {
			throw new Exception('Retangulo não encontrado', 404);
		}

		return $rectangle;
	}

	public function save(Rectangle $rectangle): Rectangle
	{
		return $rectangle->save();
	}
}
