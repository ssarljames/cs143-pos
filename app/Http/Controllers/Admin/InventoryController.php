<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class InventoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function __invoke(Request $request)
    {
        if ($request->has("critical")) {
            session()->put("criticalOnly", $request->critical === "1");
        }

        return view("admin.inventory.index");
    }
}
