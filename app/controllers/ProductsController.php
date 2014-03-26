<?php

class ProductsController extends BaseController {

	protected $model;

	public function __construct(Product $model)
	{
		$this->model = $model;
	}
}