<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Transaction;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable;

    public $search = "";

    public function render()
    {
        $transactions = Transaction::query()
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
            ->paginate();

        return view('livewire.admin.transaction.index', [
            "transactions" => $transactions
        ]);
    }
}
