<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Store extends Model implements HasName, HasAvatar
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Store memiliki banyak Role
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
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

    public function getFilamentAvatarUrl(): ?string
    {
        if (!$this->url_media) {
            return null;
        }

        $disk = Storage::disk('public');

        return $disk->exists($this->url_media)
            ? $disk->url($this->url_media)
            : null;
    }
}
