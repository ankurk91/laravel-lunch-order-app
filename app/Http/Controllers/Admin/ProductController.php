<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\DeleteRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with(['createdByUser']);

        if ($request->filled('search')) {
            $products->where('name', 'ilike', '%' . $request->input('search') . '%')
                ->orWhere('description', 'ilike', '%' . $request->input('search') . '%');
        }

        if ($request->filled('active_status')) {
            if ($request->input('active_status') === 'active') {
                $products->active();
            } elseif ($request->input('active_status') === 'inactive') {
                $products->notActive();
            }
        } else {
            // Load only active items by default
            $products->active();
        }

        $products = $products->latest()
            ->paginate($request->input('per_page', 10));

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $product = new Product();
        $product->fill($request->validated());
        $product->save();

        alert()->success('Product was created successfully.');
        return redirect()->route('admin.products.edit', $product);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->active = $request->filled('active');
        $product->save();

        alert()->success('Product was updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(DeleteRequest $request, Product $product)
    {
        $product->delete();

        alert()->success('Product was deleted successfully.');
        return redirect()->route('admin.products.index');
    }
}
