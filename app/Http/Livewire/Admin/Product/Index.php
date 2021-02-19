<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable;


    public $search = "";

    public $productsWithCriticalStock;

    public $criticalOnly = false;

    public function mount()
    {
        $this->criticalOnly = session("criticalOnly") ?? false;
        $this->productsWithCriticalStock = Product::whereRaw("available_stock <= critical_stock")->count();
    }

    public function render()
    {
        $products = Product::query()
            ->search($this->search)
            ->when($this->criticalOnly, function (Builder $query) {
                $query->whereRaw("available_stock <= critical_stock");
            })
            ->when($this->sortField === "category", function (Builder $query) {
                $query->join("categories", "categories.id", "=", "products.category_id")
                    ->orderBy("categories.name", $this->sortAsc ? "asc" : "desc")
                    ->selectRaw("products.*");
            }, function (Builder $query) {
                $query->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc");
            })
            ->paginate();

        return view('livewire.admin.product.index', [
            "products" => $products
        ]);
    }

    public function updatedCriticalOnly()
    {
        session()->put("criticalOnly", $this->criticalOnly);
    }
}
