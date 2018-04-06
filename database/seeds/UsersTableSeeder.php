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
        // Create some dummy accounts
        factory(\App\Models\User::class, rand(50, 100))->create()->each(function ($user) use ($roles) {
            $user->assignRole($roles[array_rand($roles)]);
            if (rand(0, 1)) {
                $user->profile()->save(factory(App\Models\UserProfile::class)->make());
            }
        });
    }
}
