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
        $products = \App\Models\Product::active()->get();

        \App\Models\User::with('roles')->get()->each(function ($user) use ($products) {
            if ($user->hasRole('customer')) {
                $ordersCount = rand(1, 5);
                $ordersCountRange = collect(range(1, $ordersCount));
                $user->orders()
                    ->saveMany(factory(App\Models\Order::class, $ordersCount)
                        ->make(
                            [
                                'created_by' => $user->id,
                            ]
                        )->each(function ($order) use ($ordersCountRange) {
                            // a customer can only order once in a day
                            $order->for_date = today()->subDays($ordersCountRange->pop());
                        }))
                    ->each(function ($order) use ($products) {
                        // shuffle products for each order
                        // assuming that we have more than 5 active products
                        $shuffledProducts = $products->shuffle();
                        $order->orderProducts()
                            ->saveMany(factory(App\Models\OrderProduct::class, rand(1, 5))
                                ->make()
                                ->each(function ($orderProduct) use ($order, $shuffledProducts) {
                                    // prevent duplicate product id within order
                                    $popProduct = $shuffledProducts->pop();
                                    $orderProduct->product_id = $popProduct->id;
                                    $orderProduct->quantity = rand(1, $popProduct->max_quantity);
                                })
                            );
                    });
            }
        });
    }
}
