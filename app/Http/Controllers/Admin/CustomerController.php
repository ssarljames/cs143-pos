<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view("admin.customers.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view("admin.customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomerRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreCustomerRequest $request)
    {
        DB::transaction(function () use (&$request) {
            Customer::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "address" => $request->address,
                "contact_number" => $request->contact_number,
            ]);
        });

        return redirect()->route("customers.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|Response|View
     */
    public function show(Customer $customer)
    {

        $transactions = $customer->transactions()
            ->paginate();

        return view("admin.customers.show", [
            "customer" => $customer,
            "transactions" => $transactions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|Response|View
     */
    public function edit(Customer $customer)
    {
        return view("admin.customers.edit", [
            "customer" => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        DB::transaction(function () use (&$request, &$customer) {
            $customer->update([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "address" => $request->address,
                "contact_number" => $request->contact_number,
            ]);
        });

        return redirect()->route("customers.show", $customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
