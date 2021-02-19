<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $items = [];

    public $total = 0;

    public $search = "";

    public $cash = "";

    public function mount()
    {
        $this->items[] = [
            "product" => Product::find(1),
            "quantity" => 5,
        ];
        $this->items[] = [
            "product" => Product::find(2),
            "quantity" => 3,
        ];
    }

    public function render()
    {
        $this->total = collect($this->items)->sum(function ($item) {
            return $item["quantity"] * $item["product"]["price"];
        });

        $products = $this->search
            ? Product::query()->search($this->search)->get()->toArray()
            : [];

        $this->validateItems();

        return view('livewire.admin.transaction.create', [
            "products" => $products
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

}
