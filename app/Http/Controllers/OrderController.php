<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $orders = Order::with(['createdByUser', 'orderProducts'])
            ->createdFor(Auth::id())->withComputed('total');

        if ($request->filled('search')) {
            $orders->orWhereHas('createdByUser', function ($query) use ($request) {
                $query->where('email', 'ilike', '%' . $request->input('search') . '%');
            });

            $orders->orWhereHas('createdByUser.profile', function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'ilike', '%' . $request->input('search') . '%');
            });
        }

        $orders->whereYear('for_date', $request->input('order_year', today()->year))
            ->whereMonth('for_date', $request->input('order_month', today()->month));

        if ($request->filled('order_status')) {
            $orders->where('status', $request->input('order_status'));
        }

        $orders = $orders->orderBy('for_date', 'desc')
            ->paginate($request->input('per_page', 10));

        $years = Order::createdFor(Auth::id())->select(DB::raw('EXTRACT (year from for_date) as year'))
            ->groupBy('year')->get();

        return view('orders.index', compact('orders', 'years', 'months'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $order->loadMissing([
            'createdByUser', 'orderProducts', 'orderProducts.product'
        ]);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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
        //
    }
}
