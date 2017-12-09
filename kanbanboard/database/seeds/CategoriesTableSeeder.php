<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	[
	            'name' => 'Planned',
	            'limit' => 4,
	            'sortnumber' => 1,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Analysis',
	            'limit' => 5,
	            'sortnumber' => 2,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Ready for design review',
	            'limit' => 5,
	            'sortnumber' => 3,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Design Review',
	            'limit' => 5,
	            'sortnumber' => 4,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Ready for implementation',
	            'limit' => 5,
	            'sortnumber' => 5,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Implementation',
	            'limit' => 5,
	            'sortnumber' => 6,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Ready for Verification',
	            'limit' => 5,
	            'sortnumber' => 7,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Verification',
	            'limit' => 2,
	            'sortnumber' => 8,
	            'parentcategory' => NULL,
        	],
        	[
	            'name' => 'Done',
	            'limit' => 0,
	            'sortnumber' => 9,
	            'parentcategory' => NULL,
        	]
        ]);
    }
}
