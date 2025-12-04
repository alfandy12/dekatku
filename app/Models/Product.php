<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'title',
        'url_media',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Relasi many-to-one dengan Store
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Relasi many-to-many dengan Category melalui ProductCategories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Categories::class, 'product_categories', 'product_id', 'category_id')
            ->withTimestamps();
    }
}
