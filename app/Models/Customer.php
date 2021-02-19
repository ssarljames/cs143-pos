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

    protected $appends = [
        "name"
    ];

    public function scopeSearch(Builder $query, $search, $nameOnly = false)
    {
        $search = trim($search);

        return empty($search)
            ? $query
            : $query->where(function (Builder $query) use (&$search, &$nameOnly) {
                $query->where("first_name", "like", "%$search%")
                    ->orWhere("last_name", "like", "%$search%");

                if ($nameOnly === false)
                    $query->orWhere("address", "like", "%$search%")
                        ->orWhere("contact_number", "like", "%$search%");
            });
    }

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
