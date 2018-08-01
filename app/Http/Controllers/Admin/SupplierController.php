<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Supplier\CreateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::query();

        if ($request->filled('search')) {
            $suppliers->where('first_name', 'ilike', '%' . $request->input('search') . '%')
                ->orWhere('last_name', 'ilike', '%' . $request->input('search') . '%')
                ->orWhere('email', 'ilike', '%' . $request->input('search') . '%');
        }

        if ($request->filled('active_status')) {
            if ($request->input('active_status') === 'active') {
                $suppliers->active();
            } elseif ($request->input('active_status') === 'inactive') {
                $suppliers->notActive();
            }
        } else {
            // Load only active items by default
            $suppliers->active();
        }

        $suppliers = $suppliers->latest()
            ->paginate($request->input('per_page', 10));

        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $supplier = new Supplier();
        $supplier->fill($request->validated());
        $supplier->createdByUser()->associate($request->user());
        $supplier->save();

        alert()->success('Supplier was created successfully.');
        return redirect()->route('admin.suppliers.edit', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}