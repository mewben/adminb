<?php

/**
* Utility classes
*/
class Utility extends BaseModel {

	public static function getSession()
	{
		if (!Session::has('user')) {
			Session::put('user', Confide::user()->toArray());
			Session::put('user.roles', Confide::user()->roles->toArray());

			/*if ($sem = Configuration::get('current_semester', Session::get('user.campus_id')))
				Session::put('user.sem', Semester::findOrFail($sem['value'])->toArray());

			if (Session::get('user.campus_id') == NULL) {
				Session::put('user.campuses', (new Campus)->getList());
				Session::put('user.campus', Campus::first()->toArray());
			} else {
				Session::put('user.campus', Campus::findOrFail(Session::get('user.campus_id'))->toArray());
			}*/

			Session::put('user.menu', static::getMenu());
		}

		return Session::get('user');
	}

	public static function setSession($data)
	{
		// change campus
		if (isset($data['campus_id_g'])) {
			if (!$campus = Campus::whereNull('status')->findOrFail($data['campus_id_g']))	throw new Exception('Campus not found.');

			Session::put('user.campus', $campus->toArray());
		}

		// change semester
		if (isset($data['sy_g']) AND isset($data['sem_g'])) {
			if (!$sem = Semester::where('sy', '=', $data['sy_g'])
							->where('sem', '=', $data['sem_g'])
							->where('campus_id', '=', Session::get('user.campus.id'))
							->whereNull('status')
							->first()
				)
				Session::put('user.sem', NULL);
			else
				Session::put('user.sem', $sem->toArray());
		}

		return true;
	}

	public static function getMenu()
	{
		$min = App::environment('dev') ? 'partials' : 'partials-min';

		$menu = [
			'products' => [
				'url' => '/admin/products',
				'baseurl' => '/admin/products',
				'ctrl' => 'ProductCtrl',
				'temp' => "/ang/{$min}/admin/products.html",
				'icon' => 'fa-lemon-o'
			],
			'customers' => [
				'url' => '/admin/customers',
				'baseurl' => '/admin/customers',
				'ctrl' => 'CustomerCtrl',
				'temp' => "/ang/{$min}/admin/customers.html",
				'icon' => 'fa-users'
			],
			'orders' => [
				'url' => '/admin/orders',
				'baseurl' => '/admin/orders',
				'ctrl' => 'OrderCtrl',
				'temp' => "/ang/{$min}/admin/orders.html",
				'icon' => 'fa-plane'
			],
			'sales' => [
				'url' => '/admin/sales',
				'baseurl' => '/admin/sales',
				'ctrl' => 'SalesCtrl',
				'temp' => "/ang/{$min}/admin/sales.html",
				'icon' => 'fa-money'
			],
			'transactions' => [
				'url' => '/admin/transactions',
				'baseurl' => '/admin/transactions',
				'ctrl' => 'TransactionCtrl',
				'temp' => "/ang/{$min}/admin/transactions.html",
				'icon' => 'fa-suitcase'
			],
			'banks' => [
				'url' => '/admin/banks',
				'baseurl' => '/admin/banks',
				'ctrl' => 'BankCtrl',
				'temp' => "/ang/{$min}/admin/banks.html",
				'icon' => 'fa-credit-card'
			]
		];

		return $menu;
	}
}