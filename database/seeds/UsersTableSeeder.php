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
        $roles = config('project.available_roles');

        $admin = \App\Models\User::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password@123')
        ]);

        $admin->assignRole($roles);

        $staff = \App\Models\User::create([
            'email' => 'staff@example.com',
            'password' => bcrypt('password@123')
        ]);

        $staff->assignRole(['staff']);

        factory(\App\Models\User::class, rand(50, 100))->create()->each(function ($user) use ($roles) {
            $user->assignRole(array_random($roles));
            if (rand(0, 1)) {
                $user->profile()->save(factory(App\Models\UserProfile::class)->make());
            }
        });
    }
}
