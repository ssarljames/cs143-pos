<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable;

    public $search = "";

    public function mount()
    {
        $this->sortField = "name";
        $this->sortAsc = true;
    }

    public function render()
    {
        $customers = Customer::query()
            ->search($this->search)
            ->withCount("transactions")
            ->when($this->sortField === "name", function (Builder $query) {

                $query->orderBy("customers.first_name", $this->sortAsc ? "asc" : "desc")
                    ->orderBy("customers.last_name", $this->sortAsc ? "asc" : "desc");

            }, function (Builder $query) {
                $query->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc");
            })
            ->paginate();

        return view('livewire.admin.customer.index', [
            "customers" => $customers
        ]);
    }
}
