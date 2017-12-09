<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'username' => 'localadmin',
	            'password' => bcrypt('localadmin'),
	            'isadmin' => true,
        	],
        	[
	            'username' => 'localuser',
	            'password' => bcrypt('localuser'),
	            'isadmin' => false,
        	]
        ]);
    }
}
