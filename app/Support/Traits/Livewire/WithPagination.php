<?php


namespace App\Support\Traits\Livewire;


use Livewire\WithPagination as LivewireWithPagination;

trait WithPagination
{
    use LivewireWithPagination;

    public $perPage = 10;

    /**
     *Go to first page when change pagination count
     */
    public function updatedPerPage()
    {
        $this->gotoPage(1);
    }
}