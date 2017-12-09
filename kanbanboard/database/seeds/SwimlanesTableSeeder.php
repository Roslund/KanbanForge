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
        	],
        	[
	            'name' => 'Post mortem analysis',
	            'sortnumber' => 2,
        	],
        	[
	            'name' => 'Continual improvement',
	            'sortnumber' => 3,
        	],
        	[
	            'name' => 'Tasks and bugfixes',
	            'sortnumber' => 4,
        	]
        ]);
    }
}
