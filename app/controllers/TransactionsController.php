<?php

class TransactionsController extends BaseController {

	protected $model;

	public function __construct(Transaction $model)
	{
		$this->model = $model;
	}
}