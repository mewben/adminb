<?php

class BusinessTableSeeder extends Seeder {

	public function run()
	{
		Business::insert([
			'name' => 'Dummy Business',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
	}
}