<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\BelongsTo,
    Model,
};

class Product extends Model
{
    use HasFactory;

//    protected $guarded = [];
    protected $fillable = [
        'name',
        'price',
        'brand_id',
        'stock',
        'city_id',
        'created_by_by',
        'updated_by',
    ];

    protected $cast = [
        'price' => 'decimal:2',
        'stock' => 'decimal:2',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(related: Brand::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(related: City::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->created_by = Auth::id();
        });
        static::updating(function ($product) {
            $product->updated_by = Auth::id();
        });
    }
}
