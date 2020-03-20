<?php

use Illuminate\Database\Seeder;

class IdentitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Models\Identity::class, 10)->create();
        \App\Models\Identity::create([
            'first_name' => 'Seakmeng',
            'last_name' => 'Chheang',
            'email'=>'schheang4@paragoniu.edu.kh',
            'phone_number'=>'0963777711',
            'dob' => now(),
            'user_id' => 1,
        ]);

        \App\Models\Identity::create([
            'first_name' => 'Seakmeng',
            'last_name' => 'Chheang',
            'email'=>'schheang4@paragoniu.edu.kh',
            'phone_number'=>'0963777711',
            'dob' => now(),
            'user_id' => 2,
        ]);

        \App\Models\Identity::create([
            'first_name' => 'Seakmeng',
            'last_name' => 'Chheang',
            'email'=>'schheang4@paragoniu.edu.kh',
            'phone_number'=>'0963777711',
            'dob' => now(),
            'user_id' => 3,
        ]);
    }
}
