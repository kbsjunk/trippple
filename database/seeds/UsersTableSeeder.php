<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('users')->truncate();

		$data = array(
			array(
				'name'     => 'Kit Burton-Senior',
				'email'    => 'kit.burton.senior@gmail.com',
				'password' => bcrypt('password'),
				),
			);

		DB::table('users')->insert($data);
	}

}
