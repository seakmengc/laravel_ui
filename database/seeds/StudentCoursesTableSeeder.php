<?php

use Illuminate\Database\Seeder;

class StudentCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\StudentCourse::class, 5)->create();

    }
}
