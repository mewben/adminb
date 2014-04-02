<?php

class Bank extends BaseModel {

	protected $table = 'banks';
	protected $fillable = ['name', 'website', 'account', 'status', 'business_id'];
	public $timestamps = false;

	public static $rules = [
		'name' => 'required',
		'website'=> 'required'
	];

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$where = [['business_id', '=', Session::get('user.business.id')]];

		if (isset($filters['search']))
			$where[] = ['name', 'LIKE', '%'. $filters['search'] . '%'];

		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		if (!Session::has('user.business.id'))	throw new Exception("No Business Selected!", 409);
		$data['business_id'] = Session::get('user.business.id');

		return parent::store($data, $id);
	}
}