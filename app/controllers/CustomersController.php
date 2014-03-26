<?php

class CustomersController extends BaseController {

	protected $model;

	public function __construct(Customer $model)
	{
		$this->model = $model;
	}
}