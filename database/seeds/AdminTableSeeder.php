<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
			[
				'username'=>'bin',
				'password'=>bcrypt('123456'),
			],
			[
				'username'=>'hui',
				'password'=>bcrypt('123456'),
			]
		]);
    }
}
