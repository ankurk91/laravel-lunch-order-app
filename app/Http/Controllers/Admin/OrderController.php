<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Order\AdminOrderStoreRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with(['orderForUser', 'orderProducts']);

        if ($request->filled('search')) {
            $orders->orWhereHas('orderForUser', function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->input('search') . '%');
            });

            $orders->orWhereHas('orderForUser.profile', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('search') . '%');
            });
        }

        if ($request->filled('order_status')) {
            $orders->where('status', $request->input('order_status'));
        }

        if ($request->filled('order_year')) {
            $orders->whereYear('created_at', $request->input('order_year'));
        } else {
            $orders->whereYear('created_at', today()->year);
        }

        if ($request->filled('order_month')) {
            $orders->whereMonth('created_at', $request->input('order_month'));
        } else {
            $orders->whereMonth('created_at', today()->month);
        }

        $orders = $orders->latest()
            ->paginate($request->filled('per_page') ? $request->input('per_page') : 10);

        $years = Order::select(DB::raw('EXTRACT(year from created_at) as year'))->groupBy('year')->get();

        return view('admin.orders.index', compact('orders', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $products = Product::active()->get();
        return view('admin.orders.create', compact('products', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminOrderStoreRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function store(AdminOrderStoreRequest $request, User $user)
    {
        //todo order create policy for today
        DB::beginTransaction();

        $order = new Order();
        $order->fill($request->only(['staff_notes', 'customer_notes']));
        $order->orderByUser()->associate(Auth::user());
        $order->orderForUser()->associate($user);
        $order->save();

        $productIds = array_unique(array_filter($request->input('products', [])));
        $products = Product::active()->whereIn('id', array_keys($productIds))->get();

        $products->each(function ($product) use ($productIds, $order) {
            $orderProduct = new OrderProduct();
            $orderProduct->fill([
                'unit_price' => $product->unit_price,
                'quantity' => array_get($productIds,$product->id)
            ]);
            $orderProduct->product()->associate($product);
            $order->orderProducts()->save($orderProduct);
        });

        DB::commit();
        //todo send email to customer
        alert()->success('Order was created successfully.');
        return redirect()->route('admin.orders.edit', $order->id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load(['orderForUser', 'orderForUser.profile', 'orderProducts', 'orderProducts.product']);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //todo order delete policy
        //toto email customer
        $order->delete();
        alert()->success('Order was deleted successfully.');
        return redirect()->route('admin.orders.index');
    }
}
