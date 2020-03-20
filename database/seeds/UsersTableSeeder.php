<?php

use App\Models\User;
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
//        factory(\App\Models\User::class, 10)->create()->each(function ($user) {
//            $user->identity()->save(factory(\App\Models\Identity::class)->make());
//            $user->user_roles()->save(factory(\App\Models\UserRole::class)->make());
//            $user->student_courses()->save(factory(\App\Models\StudentCourse::class)->make());
//            $user->instructor_courses()->save(factory(\App\Models\InstructorCourse::class)->make());
//        });

//        factory(\App\Models\User::class, 10)->create();

        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'username' => 'mengs',
            'password' => bcrypt('meng'),
        ]);

        $user->assignRole('student');

        $user = User::create([
            'username' => 'mengi',
            'password' => bcrypt('meng'),
        ]);

        $user->assignRole('instructor');
    }

}
