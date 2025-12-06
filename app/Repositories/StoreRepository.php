<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Support\Collection;

class StoreRepository
{
    public function getAllWithProducts(): Collection
    {
        return Store::with(['products' => function ($query) {
            $query->select('id', 'store_id', 'title', 'url_media')->limit(3);
        }])->get();
    }

    public function findBySlugWithRelations(string $slug): Store
    {
        return Store::where('slug', $slug)
            ->with(['products.categories', 'users'])
            ->firstOrFail();
    }

    public function getStoresByIds(array $ids): Collection
    {
        return Store::whereIn('id', $ids)
            ->with(['products' => function ($query) {
                $query->select('id', 'store_id', 'title', 'url_media')->limit(3);
            }])
            ->get();
    }
}