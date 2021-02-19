<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        "first_name",
        "last_name",
        "address",
        "contact_number",
    ];

    public function scopeSearch(Builder $query, $search)
    {
        $search = trim($search);

        return empty($search)
            ? $query
            : $query->where(function (Builder $query) use (&$search) {
                $query->where("first_name", "like", "%$search%")
                    ->orWhere("last_name", "like", "%$search%")
                    ->orWhere("address", "like", "%$search%")
                    ->orWhere("contact_number", "like", "%$search%");
            });
    }

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
