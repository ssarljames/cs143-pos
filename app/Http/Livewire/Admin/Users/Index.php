<?php

namespace App\Http\Livewire\Admin\Users;

use App\Support\Traits\Livewire\HasStatusNotifier;
use App\Support\Traits\Livewire\Sortable;
use App\Support\Traits\Livewire\WithPagination;
use App\User;
use Livewire\Component;

class Index extends Component
{
    use Sortable, WithPagination, HasStatusNotifier;

    public $search = '';


    protected $listeners = ['deleteItem' => 'delete'];

    public function delete($id)
    {
        $status = User::query()->findOrFail($id)->delete();
        if ($status)
            $this->alert("deleted");
    }

    public function render()
    {
        $users = User::query()
            ->search($this->search)
            ->where("id", "<>", auth()->id())
            ->paginate();

        return view('livewire.admin.users.index', [
            "users" => $users
        ]);
    }
}
