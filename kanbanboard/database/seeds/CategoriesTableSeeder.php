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
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Analysis',
	            'limit' => 5,
	            'sortnumber' => 2,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Ready for design review',
	            'limit' => 5,
	            'sortnumber' => 3,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Design Review',
	            'limit' => 5,
	            'sortnumber' => 4,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Ready for implementation',
	            'limit' => 5,
	            'sortnumber' => 5,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Implementation',
	            'limit' => 5,
	            'sortnumber' => 6,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Ready for Verification',
	            'limit' => 5,
	            'sortnumber' => 7,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Verification',
	            'limit' => 2,
	            'sortnumber' => 8,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	],
        	[
	            'name' => 'Done',
	            'limit' => 0,
	            'sortnumber' => 9,
	            'parentcategory' => NULL,
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
        	]
        ]);
    }
}
