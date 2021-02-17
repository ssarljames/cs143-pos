<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {

        $query = Category::query()
            ->where("name", "like", "%{$request->q}%")
            ->withCount("products");

        $categories = $query->paginate();

        return view("admin.categories.index", [
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:categories,name|max:50"
        ]);

        Category::create([
            "name" => $request->name
        ]);

        return response()->json([
            "status" => "OK"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required|max:50|unique:categories,name,{$category->id}"
        ]);

        $category->update([
            "name" => $request->name
        ]);

        return response()->json([
            "status" => "OK"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
