<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Transaction;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    use WithPagination, Sortable;

    public $search = "";

    public $period;

    public function mount()
    {
        $this->period = today()->startOfMonth()->format("m/d/Y") . " - " . today()->endOfMonth()->format("m/d/Y");
    }

    public function render()
    {

        $period = explode(" - ", $this->period);

        $transactions = Transaction::query()
            ->search($this->search)
            ->when($this->sortField === "customer" || $this->sortField === "user", function (Builder $query) {

                if ($this->sortField === "customer")
                    $query->leftJoin("customers", "customers.id", "=", "transactions.customer_id")
                        ->orderBy("customers.first_name", $this->sortAsc ? "asc" : "desc")
                        ->orderBy("customers.last_name", $this->sortAsc ? "asc" : "desc")
                        ->selectRaw("transactions.*");

                if ($this->sortField === "user")
                    $query->leftJoin("users", "users.id", "=", "transactions.user_id")
                        ->orderBy("users.username", $this->sortAsc ? "asc" : "desc")
                        ->selectRaw("transactions.*");

            }, function (Builder $query) {
                $query->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc");
            })
            ->where("transactions.created_at", ">=", Carbon::createFromFormat("m/d/Y", $period[0]))
            ->where("transactions.created_at", "<=", Carbon::createFromFormat("m/d/Y", $period[1]))
            ->with("customer")
            ->paginate();

        return view('livewire.admin.transaction.index', [
            "transactions" => $transactions
        ]);
    }
}
