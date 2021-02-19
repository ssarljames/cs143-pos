<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "customer_id",
        "user_id",
        "or_number",
        "total_amount",
        "reserved_at",
    ];



    public function scopeSearch(Builder $query, $search)
    {
        $search = trim($search);

        return empty($search)
            ? $query
            : $query->where(function (Builder $query) use (&$search) {
                $query->where("or_number", "like", "%$search%")
                    ->orWhereHas("customer", function (Builder $query) use (&$search) {
                        $query->search($query);
                    });
            });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
