<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Models\Role::class, 10)->create();
        Role::create(
            [
                'name' => 'admin',
                'description'=>'abc',
                'guard_name' => 'web',
            ]
        );

        Role::create(
            [
                'name' => 'student',
                'description'=>'abc',
                'guard_name' => 'web',
            ]
        );

        Role::create(
            [
                'name' => 'staff',
                'description'=>'abc',
                'guard_name' => 'web',
            ]
        );

        Role::create(
            [
                'name' => 'instructor',
                'description'=>'abc',
                'guard_name' => 'web',
            ]
        );
    }
}
