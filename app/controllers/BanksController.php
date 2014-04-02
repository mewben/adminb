<?php

class BanksController extends BaseController {

	protected $model;

	public function __construct(Bank$model)
	{
		$this->model = $model;
	}
}