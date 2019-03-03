<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shop\StoreRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ShopController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
            'orderProducts', 'orderProducts.product',
        ]);

        $newProducts = Product::active()->whereNotIn('id', $order->orderProducts->pluck('product_id'))->get();
        return view('shop.index', compact('order', 'newProducts'));
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        //todo use firstOrNew here
        $order = Order::createdFor($request->user()->id)
            ->whereDate('for_date', today())
            ->first();

        if (!$order) {
            $order = new Order();
            $order->createdByUser()->associate($request->user());
            $order->createdForUser()->associate($request->user());
            $order->for_date = today();
        }

        if ($order->exists) {
            $order->orderProducts()->delete();
        }

        $order->fill($request->only(['customer_notes']));
        $order->save();

        $productsWithQuantity = collect($request->input('products', []))
            ->filter(function ($product) {
                return Arr::get($product, 'quantity');
            })->unique('id');

        $productsWithPrice = Product::active()->find($productsWithQuantity->pluck('id'));

        $productsWithPrice->each(function ($product, $key) use ($order, $productsWithQuantity) {
            $orderProduct = new OrderProduct();
            $orderProduct->fill([
                'quantity' => Arr::get($productsWithQuantity->where('id', $product->id)->first(), 'quantity'),
                'unit_price' => $product->unit_price,
            ]);
            $orderProduct->product()->associate($product);
            $order->orderProducts()->save($orderProduct);
        });

        DB::commit();

        alert()->success('Order was placed successfully.');
        return back();

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
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
