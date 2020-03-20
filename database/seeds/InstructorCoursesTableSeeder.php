<?php

use Illuminate\Database\Seeder;

class InstructorCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\InstructorCourse::class, 5)->create();
    }
}
