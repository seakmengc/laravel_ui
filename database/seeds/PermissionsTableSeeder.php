<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crud = ['create', 'edit', 'view', 'delete'];
        $things = ['faculties', 'departments', 'users', 'courses', 'roles', 'student_courses',
            'user_roles', 'instructor_courses', 'identities'];

        foreach ($crud as $op) {
            foreach ($things as $thing) {
                if(($thing == 'student_courses' || $thing == 'instructor_courses')
                && $op == 'edit')
                    continue;
                elseif($thing == 'identities' && ($op == 'delete' || $op == 'create'))
                    continue;

                Permission::create(
                    [
                        'name' => $op . ' ' . $thing,
                        'guard_name' => 'web'
                    ]
                );
            }
        }

        for($i = 0; $i < 4; ++$i)
            Permission::create(
                [
                    'name' =>  'restore ' . $things[$i],
                    'guard_name' => 'web'
                ]
            );
    }
}
