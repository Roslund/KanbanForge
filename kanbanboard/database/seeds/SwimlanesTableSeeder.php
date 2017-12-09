<?php

use Illuminate\Database\Seeder;

class SwimlanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('swimlanes')->insert([
        	[
	            'name' => 'Fix failing build',
	            'sortnumber' => 1,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Post mortem analysis',
	            'sortnumber' => 2,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Continual improvement',
	            'sortnumber' => 3,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Tasks and bugfixes',
	            'sortnumber' => 4,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	]
        ]);
    }
}
