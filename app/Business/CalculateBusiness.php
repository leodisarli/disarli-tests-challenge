<?php

namespace App\Business;

use App\Repositories\NumberRepository;
use App\Repositories\RectangleRepository;
use App\Repositories\TriangleRepository;
use App\Helpers\CalculateHelper;
use App\Helpers\JocinhaHelper;
use App\Models\Rectangle;
use App\Models\Triangle;

class CalculateBusiness
{
	private $numberRepository;
	private $rectangleRepository;
	private $calculateHelper;
	private $triangleRepository;

    public function __construct(
    	NumberRepository $numberRepository,
    	RectangleRepository $rectangleRepository,
    	CalculateHelper $calculateHelper,
    	TriangleRepository $triangleRepository
    ) {
    	$this->numberRepository = $numberRepository;
    	$this->rectangleRepository = $rectangleRepository;
    	$this->calculateHelper = $calculateHelper;
    	$this->triangleRepository = $triangleRepository;
    }

	public function incrementUserTotal(int $userId): Rectangle
	{
		$totalModel = $this->numberRepository->getTotal($userId);

		$totalModel->total += 1;

		return $this->numberRepository->save($totalModel);
	}

	public function updateRectangleArea(int $id, array $params): Rectangle
	{
		try {
			if (!count($parms)) {
				return null;
			}

			$rectangleModel = $this->rectangleRepository->get($id);
			$rectangleModel->height = $params['height'];
			$rectangleModel->width = $params['width'];
			$rectangleModel->area = $this->calculateHelper->calcArea($params['height'], $params['width']);

			return $this->rectangleRepository->save($rectangleModel);
		} catch (\Exception $e) {
			return 'Ocorreu um erro ao tentar atualizar a área do retangulo enviado';
		}
	}

	public function updateTriangleArea(int $id, array $params): Triangle
	{
		try {
			if (!count($parms)) {
				return null;
			}

			$triangleModel = $this->triangleRepository->get($id);
			$triangleModel->height = $params['height'];
			$triangleModel->base = $params['base'];
			$triangleModel->area = $this->calculateHelper->calcAreaTriangle($params['height'], $params['base']);

			return $this->triangleRepository->save($triangleModel);
		} catch (\Exception $e) {
			return 'Ocorreu um erro ao tentar atualizar a área do triângulo enviado';
		}
	}

	public function getJocinhaIs()
	{
		return $this->newJocinha()->is();
	}

	public function newJocinha()
	{
		return new JocinhaHelper;
	}
}
