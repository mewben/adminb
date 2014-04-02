<?php

class OrdersController extends BaseController {

	protected $model;

	public function __construct(Order $model)
	{
		$this->model = $model;
	}

	public function show($id)
	{
		return Response::json($this->model->getWithDetails($id));
	}
}