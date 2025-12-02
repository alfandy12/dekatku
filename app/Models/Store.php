<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Definisikan relasi 'tenants' untuk Model Tenant.
     * Dalam kasus ini, siapa saja yang memiliki akses ke 'Store' ini.
     */
    public function users(): BelongsToMany
    {
        // Pivot table default-nya adalah 'store_user'
        return $this->belongsToMany(User::class);
    }

    /**
     * Dapatkan daftar semua model yang terkait dengan 'Store' ini.
     * Contoh: Produk-produk yang dimiliki oleh toko ini.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Metode ini diperlukan oleh kontrak HasTenants.
    public function getTenants($user): array
    {
        return $user->stores->all();
    }
}
