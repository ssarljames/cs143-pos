<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view("admin.transaction.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view("admin.transaction.create");
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Application|Factory|Response|View
     */
    public function show(Transaction $transaction)
    {

        $transaction->load([
            "items.product",
            "customer",
            "user"
        ]);

        return view("admin.transaction.show", [
            "transaction" => $transaction
        ]);
    }
}
