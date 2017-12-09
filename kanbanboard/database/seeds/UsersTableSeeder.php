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
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'username' => 'localuser',
	            'password' => bcrypt('localuser'),
	            'isadmin' => false,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
        	]
        ]);
    }
}
