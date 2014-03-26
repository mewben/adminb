<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		Role::insert([
			[
				'name' => 'superadmin',
				'desc' => 'Super Administrator'
			],
			[
				'name' => 'admin',
				'desc' => 'Administrator'
			]
		]);
		$u = User::create([
			'username' => 'superadmin',
			'email' => 'melvinsoldia@gmail.com',
			'password' => 'passwD',
			'confirmed' => true
		]);
		$u2 = User::create([
			'username' => 'user1',
			'email' => 'melvin_soldia@yahoo.com',
			'password' => 'passwD',
			'confirmed' => true
		]);

		$u->roles()->attach(1);
		$u2->roles()->attach(2);
	}
}