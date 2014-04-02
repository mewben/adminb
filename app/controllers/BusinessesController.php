<?php

class BusinessesController extends BaseController {

	protected $model;

	public function __construct(Business $model)
	{
		$this->model = $model;
	}
}