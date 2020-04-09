<?php

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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'user_group_id' => '0',
            'phone' => '01675342612',
            'user_role' => '1',
            'password' => Hash::make('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Supervisor',
            'email' => 'super@gmail.com',
            'user_group_id' => '1',
            'phone' => '01675342612',
            'user_role' => '2',
            'password' => Hash::make('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'user_group_id' => '1',
            'phone' => '01675342612',
            'user_role' => '3',
            'password' => Hash::make('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'user_group_id' => '0',
            'phone' => '01675342612',
            'user_role' => '4',
            'password' => Hash::make('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
