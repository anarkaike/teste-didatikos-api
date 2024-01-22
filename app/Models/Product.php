<?php

namespace App\Models;

// use App\Models\Scopes\BrandNameScope;
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

    protected $appends = [
        'brand_name',
        'city_name',
        'created_by_name',
        'updated_by_name'
    ];

    protected function getBrandNameAttribute()
    {
        return $this->brand()->first()?->name;
    }

    protected function getCityNameAttribute()
    {
        return $this->city()->first()?->name;
    }

    protected function getCreatedByNameAttribute()
    {
        return $this->createdByUser()->first()?->name;
    }

    protected function getUpdatedByNameAttribute()
    {
        return $this->updatedByUser()->first()?->name;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(related: Brand::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(related: City::class);
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by', ownerKey: 'id');
    }

    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'updated_by', ownerKey: 'id');
    }

//    protected static function booted(): void
//    {
//        static::addGlobalScope(scope: new BrandNameScope);
//    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->created_by = Auth::id();
        });
        static::updating(function ($product) {
            $product->updated_by = Auth::id();
        });
        static::saving(function ($product) {
            $product->updated_by = Auth::id();
        });
    }
}
