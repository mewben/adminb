<?php

class Product extends BaseModel {

	protected $table = 'products';
	protected $fillable = ['name', 'description', 'unitprice', 'unit', 'unitsinstock', 'discount', 'status', 'business_id'];
	protected $softDeletes = true;
	public $timestamps = false;

	public static $rules = [
		'name' => 'required',
		'unitprice' => 'required',
		'unit' => 'required'
	];

	public function getList()
	{
		$model = new static;

		$model = $model->whereNull('status');
		$model = $model->orderBy('name');

		return $model->lists('name', 'id');
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$where = [['business_id', '=', Session::get('user.business.id')]];
		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		if (!Session::has('user.business.id'))	throw new Exception("No Business Selected!", 409);
		$data['business_id'] = Session::get('user.business.id');

		return parent::store($data, $id);
	}
}