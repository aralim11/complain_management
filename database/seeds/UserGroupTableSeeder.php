<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = array (
            array ('id' => '1','name' => 'Chattagram', 'slug' => Str::slug('Chattagram'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '2','name' => 'Rajshahi', 'slug' => Str::slug('Rajshahi'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '3','name' => 'Khulna', 'slug' => Str::slug('Khulna'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '4','name' => 'Barisal', 'slug' => Str::slug('Barisal'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '5','name' => 'Sylhet', 'slug' => Str::slug('Sylhet'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '6','name' => 'Dhaka', 'slug' => Str::slug('Dhaka'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '7','name' => 'Rangpur', 'slug' => Str::slug('Rangpur'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array ('id' => '8','name' => 'Mymensingh', 'slug' => Str::slug('Mymensingh'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
        );

        DB::table('user_groups')->insert($groups);
    }
}
