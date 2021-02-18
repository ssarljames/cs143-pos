<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect()->route("inventory");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $categories = Category::query()
            ->orderBy("name")
            ->get(["id", "name"]);

        return view("admin.products.create", [
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use (&$request) {

            $product = Product::create([
                "category_id" => $request->category_id,
                "name" => $request->name,
                "price" => $request->price,
                "unit_type" => $request->unit_type,
                "available_stock" => $request->available_stock,
                "critical_stock" => $request->critical_stock,
            ]);

        });

        return redirect()->route("inventory")->with([
            "message" => "Success"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Product $product)
    {
        return view("admin.products.show", [
            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function edit(Product $product)
    {
        $categories = Category::query()
            ->orderBy("name")
            ->get(["id", "name"]);

        return view("admin.products.edit", [
            "product" => $product,
            "categories" => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::transaction(function () use (&$request, &$product) {

            $product->update([
                "category_id" => $request->category_id,
                "name" => $request->name,
                "price" => $request->price,
                "unit_type" => $request->unit_type,
                "available_stock" => $request->available_stock,
                "critical_stock" => $request->critical_stock,
            ]);

        });

        return redirect()->route("products.show", $product->id)->with([
            "message" => "Success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
