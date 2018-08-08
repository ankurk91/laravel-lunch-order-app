<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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

        // Create user for each of the roles
        foreach ($roles as $role) {
            $user = User::create([
                'email' => $role . '@example.com',
                'password' => bcrypt('password@123')
            ]);
            $user->assignRole($role);
        }

        factory(\App\Models\User::class, rand(50, 100))->create()->each(function ($user) use ($roles) {
            $user->assignRole(array_random($roles));
            if (rand(0, 1)) {
                $user->profile()->save(factory(App\Models\UserProfile::class)->make());
            }
        });
    }
}
