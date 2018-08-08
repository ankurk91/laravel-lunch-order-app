<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding: Environment - ' . config('app.env'));

        // Reset cached roles and permissions
        app('cache')->forget('spatie.permission.cache');

        $this->call(RolesTableSeeder::class);

        // Don't seed these tables when in production
        if (!app()->environment('production')) {
            $this->call([
                UsersTableSeeder::class,
                SuppliersTableSeeder::class,
                ProductsTableSeeder::class,
                OrdersTableSeeder::class
            ]);
        }

    }
}
