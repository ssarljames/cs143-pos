<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view("admin.inventory.index");
    }
}
