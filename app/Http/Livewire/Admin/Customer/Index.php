<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable;

    public $search = "";

    public function render()
    {
        $customers = Customer::query()
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
            ->paginate();

        return view('livewire.admin.customer.index', [
            "customers" => $customers
        ]);
    }
}
