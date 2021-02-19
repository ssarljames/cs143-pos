<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $items = [];

    public $total = 0;

    public $search = "";

    public $cash = "";

    public $settingCustomer = false;

    public $searchCustomer = "";

    public $customer = null;

    public $transactionSaved = false;

    public function mount()
    {

    }

    public function render()
    {
        $this->total = collect($this->items)->sum(function ($item) {
            return $item["quantity"] * $item["product"]["price"];
        });

        $products = $this->search
            ? Product::query()->search($this->search)
                ->orderBy("name")
                ->limit(10)->get()->toArray()
            : [];

        $this->validateItems();

        $customers = [];

        if ($this->settingCustomer && $this->searchCustomer) {
            $customers = Customer::search($this->searchCustomer, true)
                ->orderBy("first_name")
                ->orderBy("last_name")
                ->limit(2)
                ->get()
                ->toArray();
        }

        return view('livewire.admin.transaction.create', [
            "products" => $products,
            "customers" => $customers
        ]);
    }

    public function removeItem($index)
    {
        array_splice($this->items, $index, 1);
    }

    public function addItem($productId)
    {
        $productIndex = collect($this->items)->search(function ($item) use (&$productId) {
            return $item["product"]["id"] === $productId;
        });

        if ($productIndex !== false) {
           $this->items[$productIndex]["quantity"] += 1;
        }

        else
            $this->items[] = [
                "product" => Product::find($productId),
                "quantity" => 1,
            ];

        $this->search = "";
    }


    public function validateItems()
    {
        foreach ($this->items as $item) {
            if ($item["quantity"] <= 0)
                $item["quantity"] = 1;
        }
    }

    public function setCustomer($customerId)
    {
        $this->settingCustomer = false;
        $this->customer = Customer::find($customerId)->toArray();
    }

    public function updatedSettingCustomer()
    {
        $this->searchCustomer = "";
    }

    public function checkout()
    {
        $this->transactionSaved = DB::transaction(function () {

            $transaction = Transaction::create([
                "customer_id" => $this->customer ? $this->customer["id"] : null,
                "user_id" => auth()->id(),
                "or_number" => Transaction::getNewOR(),
                "total_amount" => $this->total,
                "reserved_at" => null,
            ]);

            foreach ($this->items as $item) {
                $transaction->items()->create([
                    "product_id" => $item["product"]["id"],
                    "quantity" => $item["quantity"],
                    "price" => $item["product"]["price"],
                    "amount" => $item["quantity"] * $item["product"]["price"],
                ]);

                Product::query()
                    ->where("id", $item["product"]["id"])
                    ->update([
                        "available_stock" => DB::raw("available_stock - {$item["quantity"]}")
                    ]);

            }


            return true;
        });

        if ($this->transactionSaved) {
            $this->reset([
                "items",
                "total",
                "search",
                "cash",
                "settingCustomer",
                "searchCustomer",
                "customer",
            ]);
        }


    }

}
