<?php


namespace App\Support\Traits\Livewire;


trait Sortable
{
    public $sortField = "created_at";
    public $sortAsc = false;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
}