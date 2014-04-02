<?php

class Transaction extends BaseModel {

	protected $table = 'transactions';
	protected $fillable = ['type', 'date', 'amount', 'notes', 'status', 'business_id'];

	public static $rules = [
		'type' => 'required',
		'date' => 'required',
		'amount' => 'required'
	];

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$where = [['business_id', '=', Session::get('user.business.id')]];

		if (isset($filters['search']))
			$where[] = ['name', 'LIKE', '%'. $filters['search'] . '%'];

		$count = (isset($filters['count']) AND is_numeric($filters['count'])) ? $filters['count'] : 200;
		if (isset($filters['filter']) AND $filters['filter'] == 'active')		unset($filters['filter']);

		$model = new static;

		// with
		if (isset($with))		$model = $model->with($with);

		// where
		if (isset($where) AND is_array($where)) {
			foreach ($where as $key => $value) {
				$model = $model->where($value[0], $value[1], $value[2]);
			}
		}

		// filters
		if (isset($filters['filter']) AND $filters['filter'] != '') {
			if ($filters['filter'] == 'trashed')	$model = $model->onlyTrashed();
			else 									$model = $model->where('status', '=', strtolower($filters['filter']));
		} else {
			$model = $model->where(function($query) {
				$query->where('status', '!=', 'blocked')
					  ->orWhereNull('status');
			});
		}

		$model = $model->orderBy('date');

		$data = $model->paginate($count)->toArray();

		$balance = 0;
		foreach ($data['data'] as $key => $value) {
			if ($value['type'] == 'expense')
				$balance -= $value['amount'];
			else
				$balance += $value['amount'];
		}
		$data['balance'] = $balance;

		return $data;

	}

	public function store($data, $id = NULL)
	{
		if (!Session::has('user.business.id'))	throw new Exception("No Business Selected!", 409);
		$data['business_id'] = Session::get('user.business.id');

		return parent::store($data, $id);
	}
}