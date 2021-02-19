<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    const COMPLETED = "completed";
    const RESERVED = "reserved";
    const CANCELLED = "cancelled";

    const STATUS = [
        self::COMPLETED,
        self::RESERVED,
        self::CANCELLED
    ];

    protected $fillable = [
        "customer_id",
        "user_id",
        "or_number",
        "total_amount",
        "reserved_at",
        "status",
        "completed_at",
    ];

    protected $dates = [
        "completed_at"
    ];

    public function scopeSearch(Builder $query, $search)
    {
        $search = trim($search);


        return empty($search)
            ? $query
            : $query->where(function (Builder $query) use (&$search) {
                $query->where("or_number", "like", "%$search%")
                    ->orWhereHas("customer", function (Builder $query) use (&$search) {
                        $query->search($search);
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

    public static function getNewOR()
    {
        $month = today()->format("m");
        $year = today()->format("Y");

        $count = Transaction::query()
            ->whereMonth("created_at", $month)
            ->whereYear("created_at", $year)
            ->count() + 1;

        return "OR-$year-$month-" . str_pad("$count", 6, "0", STR_PAD_LEFT);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, TransactionItem::class);
    }

    public function getColorAttribute()
    {
        switch ($this->status) {
            case self::COMPLETED:
                return "badge badge-success";
            case self::CANCELLED:
                return "badge badge-danger";
            case self::RESERVED:
                return "badge badge-warning";
        }
    }
}
