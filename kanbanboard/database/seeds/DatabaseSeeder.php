<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SwimlanesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        // Tries to get projects from teamforge
        \App\Project::refresh_all_artifacts_from_teamforge();

        /*
        //To insert random data... work, but lets have propper static data instead.
        factory(App\User::class, 3)->create();
        factory(App\Swimlane::class, 7)->create();
        factory(App\Category::class, 7)->create();
		*/
    }
}
