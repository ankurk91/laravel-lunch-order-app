<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shop\StoreRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $order = Order::createdFor(Auth::id())
            ->whereDate('for_date', today())
            ->first();

        if ($order && $order->status === 'cancelled') {
            return view('shop.index', compact('order'));
        }

        if (!$order) {
            $products = Product::active()->get();
            return view('shop.index', compact('products'));
        }

        $order->loadMissing([
            'orderProducts', 'orderProducts.product'
        ]);

        $newProducts = Product::active()->whereNotIn('id', $order->orderProducts->pluck('product_id'))->get();
        return view('shop.index', compact('order', 'newProducts'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        $order = Order::createdFor(Auth::id())
            ->whereDate('for_date', today())
            ->first();

        if (!$order) {
            $order = new Order();
            $order->createdByUser()->associate(Auth::user());
            $order->createdForUser()->associate(Auth::user());
            $order->for_date = today();
        }

        if ($order->exists) {
            $order->orderProducts()->delete();
        }

        $order->fill($request->only(['customer_notes']));
        $order->save();

        $productsWithQuantity = collect($request->input('products', []))
            ->filter(function ($product) {
                return array_get($product, 'quantity');
            })->unique('id');

        $productsWithPrice = Product::active()->find($productsWithQuantity->pluck('id'));

        $productsWithPrice->each(function ($product, $key) use ($order, $productsWithQuantity) {
            $orderProduct = new OrderProduct();
            $orderProduct->fill([
                'quantity' => array_get($productsWithQuantity->where('id', $product->id)->first(), 'quantity'),
                'unit_price' => $product->unit_price
            ]);
            $orderProduct->product()->associate($product);
            $order->orderProducts()->save($orderProduct);
        });

        DB::commit();

        alert()->success('Order was placed successfully.');
        return back();

    }

    public function cancel()
    {
        $order = Order::createdFor(Auth::id())
            ->whereDate('for_date', today())
            ->firstOrFail();

        $order->status = 'cancelled';
        $order->save();

        alert()->success('You order was cancelled successfully.');
        return back();
    }

    public function restore()
    {
        $order = Order::createdFor(Auth::id())
            ->whereDate('for_date', today())
            ->firstOrFail();

        $order->status = 'pending';
        $order->save();

        alert()->success('You order was restored successfully.');
        return back();
    }
}
