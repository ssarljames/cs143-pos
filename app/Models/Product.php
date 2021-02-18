<?php

namespace App\Models;

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
}
