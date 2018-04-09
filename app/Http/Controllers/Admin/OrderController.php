<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::active()->get();
        return view('admin.orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load(['orderForUser', 'orderForUser.profile']);
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
        //
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
        $order->delete();
        alert()->success('Order was deleted successfully.');
        return redirect()->route('admin.orders.index');
    }
}
