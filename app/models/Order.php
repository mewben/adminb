<?php

class Order extends BaseModel {

	protected $table = 'orders';
	protected $fillable = ['customer_id', 'date', 'price', 'status', 'business_id'];
	protected $softDelete = true;
	public $timestamps = true;

	public static $rules = [
		'customer_id' => 'required'
	];

	public function customer()
	{
		return $this->belongsTo('Customer');
	}

	public function details()
	{
		return $this->hasMany('OrderDetails');
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['customer'];
		$where = [['business_id', '=', Session::get('user.business.id')]];

		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		if (!Session::has('user.business.id'))	throw new Exception("No Business Selected!", 409);
		$d = $data;

		unset($data);
		$data = $d['order'];

		$data['business_id'] = Session::get('user.business.id');
		$data['date'] = date('Y-m-d H:i:s');

		$ret = parent::store($data, $id);

		if ($ret) {

			DB::table('order_details')->where('order_id', '=', $ret['id'])->delete();
			// save the order_details
			foreach ($d['items'] as $key => $value) {
				DB::table('order_details')->insert([
					'order_id' => $ret['id'],
					'product_id' => $value['id'],
					'unitprice' => $value['unitprice'],
					'quantity' => $value['quantity'],
					'discount' => $value['discount']
				]);
			}
		}
		return $ret;
	}

	public function getWithDetails($id)
	{
		$model = static::with('customer')->with('details')->findOrFail($id);
		$data = $model->toArray();

		return $data;
	}
}