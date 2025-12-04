<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\HasName;

class Store extends Model implements HasName
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'url_media',
        'location',
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public function users(): BelongsToMany
    {
        // Pivot table store_user
        return $this->belongsToMany(User::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getTenants($user): array
    {
        return $user->stores->all();
    }
    public function getFilamentName(): string
    {
        return "{$this->title}";
    }
}
