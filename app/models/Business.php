<?php

class Business extends BaseModel {

	protected $table = 'businesses';
	protected $softDelete = true;
	protected $fillable = ['name', 'website', 'status'];

	public static $rules = [
		'name' => 'required',
	];

	public function getList()
	{
		$model = new static;

		$model = $model->whereNull('status');
		$model = $model->orderBy('name');

		return $model->lists('name', 'id');
	}
}