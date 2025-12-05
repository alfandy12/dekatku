<?php

namespace App\Services;

use App\Repositories\StoreRepository;
use App\Transformers\StoreTransformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class StoreService
{
    public function __construct(
        private StoreRepository $repository,
        private StoreTransformer $transformer,
        private DistanceService $distanceService
    ) {}


    public function getNearbyStores(string $sessionId, ?int $limit = null): Collection
    {
        $cacheKey = $this->getCacheKey($sessionId, $limit);

        return Cache::remember($cacheKey, 3600, function() use ($sessionId, $limit) {
            $stores = $this->repository->getAllWithProducts();
            
            $transformedStores = $stores->map(function ($store) use ($sessionId) {
                $distance = $this->distanceService->generateRandomDistance(
                    $store->id, 
                    $sessionId
                );
                
                return $this->transformer->transformForList($store, $distance);
            });

        
            $sortedStores = $transformedStores->sortBy(function ($store) {
                return $this->distanceService->distanceToMeters($store['jarak']);
            })->values();

        
            $sortedStores = $sortedStores->map(function ($store) {
                $store['jarak_meter'] = $this->distanceService->distanceToMeters($store['jarak']);
                return $store;
            });

            if ($limit) {
                return $sortedStores->take($limit);
            }

            return $sortedStores;
        });
    }

    public function getPaginatedNearbyStores(string $sessionId, int $page = 1, int $perPage = 10): array
    {
        $cacheKey = "nearby_stores_{$sessionId}_page_{$page}_per_{$perPage}";

        return Cache::remember($cacheKey, 3600, function() use ($sessionId, $page, $perPage) {
            $allStores = $this->getNearbyStores($sessionId);
            
            $total = $allStores->count();
            $offset = ($page - 1) * $perPage;
            $paginatedStores = $allStores->slice($offset, $perPage)->values();
            
            return [
                'data' => $paginatedStores,
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => (int)ceil($total / $perPage),
                    'has_more' => $offset + $perPage < $total,
                ]
            ];
        });
    }


    public function getStoreDetail(string $slug): array
    {
        $store = $this->repository->findBySlugWithRelations($slug);
        return $this->transformer->transformForDetail($store);
    }

    public function getStoresForChat(string $sessionId, int $limit = 15): array
    {
        $cacheKey = "nearby_stores_{$sessionId}_for_chat";
        
        return Cache::remember($cacheKey, 3600, function() use ($sessionId, $limit) {
            return $this->getNearbyStores($sessionId, $limit)->toArray();
        });
    }

  
    private function getCacheKey(string $sessionId, ?int $limit = null): string
    {
        if ($limit) {
            return "nearby_stores_{$sessionId}_limit_{$limit}";
        }
        
        return "nearby_stores_{$sessionId}_all";
    }
}