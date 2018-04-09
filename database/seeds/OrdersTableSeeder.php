<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Models\Product::active()->get()->pluck('id');

        \App\Models\User::with('roles')->get()->each(function ($user) use ($products) {
            if ($user->hasRole('customer')) {
                $user->orders()
                    ->saveMany(factory(App\Models\Order::class, rand(1, 5))
                        ->make(
                            [
                                'created_by' => $user->id,
                            ]
                        ))
                    ->each(function ($order) use ($products) {
                        // shuffle products for each order
                        $ids = collect($products)->shuffle();
                        $order->orderProducts()
                            ->saveMany(factory(App\Models\OrderProduct::class, rand(1, 5))
                                ->make()
                                ->each(function ($orderProduct) use ($ids) {
                                    // prevent duplicate product id within order
                                    $orderProduct->product_id = $ids->pop();
                                })
                            );
                    });
            }
        });
    }
}
