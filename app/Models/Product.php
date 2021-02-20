<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    CONST PIECES = "pieces";
    CONST WEIGHT = "weight";

    const UNIT_TYPES = [
        self::PIECES => "By Pieces",
        self::WEIGHT => "By Weight"
    ];

    protected $fillable = [
        "category_id",
        "name",
        "price",
        "unit_type",
        "available_stock",
        "critical_stock",
    ];

    protected $appends = [
        "available_stock_formatted"
    ];

    public function scopeSearch(Builder $query, $search)
    {
        $search = trim($search);

        return empty($search)
            ? $query
            : $query->where(function (Builder $query) use (&$search) {
                $query->where("products.name", "like", "%$search%");
            });
    }

    protected function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsByPiecesAttribute()
    {
        return $this->unit_type === self::PIECES;
    }

    public function getAvailableStockFormattedAttribute()
    {
        return $this->is_by_pieces
            ? (int) $this->available_stock
            : number_format($this->available_stock, 2);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, TransactionItem::class)
            ->orderBy("transactions.created_at", "desc");
    }

    public function scopeCriticalStock(Builder $query)
    {
        return $query->whereRaw("products.available_stock <= products.critical_stock");
    }
}
