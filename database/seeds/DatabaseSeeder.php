<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('permission')->insert([
            [
                'sort' => '1',
                'group_name' => "Dashboard",
                'group_name_slug' => 'dashboard',
                'permission_name' => 'See Dashboard',
                'permission_name_slug' => 'dashboardShow',
            ]
        ]);

        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('role_user')->insert([
            'role_id' => "1",
            'user_id' => '1'
        ]);

        DB::table('role')->insert([
            [
                'name' => "Admin",
                'slug' => 'admin',
                'permissions' => '{"dashboardShow":true}'
            ],
            [
                'name' => "Author",
                'slug' => 'author',
                'permissions' => '{"dashboardShow":true}'
            ]
        ]);

    }
}
