<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Models\UserRole::class, 10)->create();
            \App\Models\UserRole::create([
               'user_id' => 1,
               'role_id' => 1
            ]);
    }
}
