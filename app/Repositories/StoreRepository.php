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

    public function getAllWithFullProductDetails(): Collection
    {
        return Store::with(['products' => function ($query) {
            $query->select('id', 'store_id', 'title', 'price', 'description', 'url_media')
                ->with('categories:id,name'); 
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

    public function search(string $query, int $limit = 10): Collection
    {
        return Store::query()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('type', 'LIKE', "%{$query}%");
            })
            ->select('id', 'title', 'slug', 'description', 'type', 'url_media')
            ->limit($limit)
            ->get();
    }
}