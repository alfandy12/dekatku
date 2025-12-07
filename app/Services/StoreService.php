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

 
    public function getStoreDetail(string $slug, string $sessionId): array
    {
        $cacheKey = "store_detail_{$slug}_{$sessionId}";
        
        return Cache::remember($cacheKey, 3600, function() use ($slug, $sessionId) {
            $store = $this->repository->findBySlugWithRelations($slug);
            
            
            $distance = $this->distanceService->generateRandomDistance(
                $store->id, 
                $sessionId
            );
            
            $distanceInMeters = $this->distanceService->distanceToMeters($distance);
            
            return $this->transformer->transformForDetail($store, $distance, $distanceInMeters);
        });
    }

    public function getStoresForChatWithFullDetails(string $sessionId, int $limit = 15): array
    {
        $cacheKey = "ai_stores_{$sessionId}_full_details";
        
        return Cache::remember($cacheKey, 3600, function() use ($sessionId, $limit) {
            $stores = $this->repository->getAllWithFullProductDetails();
            
            $transformedStores = $stores->map(function ($store) use ($sessionId) {
                $distance = $this->distanceService->generateRandomDistance(
                    $store->id, 
                    $sessionId
                );
                
                return $this->transformer->transformForAI($store, $distance);
            });

            $sortedStores = $transformedStores->sortBy(function ($store) {
                return $this->distanceService->distanceToMeters($store['jarak']);
            })->values();

            return $sortedStores->take($limit)->toArray();
        });
    }

    

    private function getCacheKey(string $sessionId, ?int $limit = null): string
    {
        if ($limit) {
            return "nearby_stores_{$sessionId}_limit_{$limit}";
        }
        
        return "nearby_stores_{$sessionId}_all";
    }

    public function searchStores(string $query, string $sessionId, int $limit = 10): array
    {
    
        $query = trim($query);
        
        if (empty($query)) {
            return [];
        }

        $cacheKey = "store_search_" . md5($query . $sessionId . $limit);
        
        return Cache::remember($cacheKey, 1800, function() use ($query, $sessionId, $limit) {
            $stores = $this->repository->search($query, $limit);
            
            if ($stores->isEmpty()) {
                return [];
            }

            $transformedStores = $stores->map(function ($store) use ($sessionId) {
                $distance = $this->distanceService->generateRandomDistance(
                    $store->id, 
                    $sessionId
                );
                
                $distanceInMeters = $this->distanceService->distanceToMeters($distance);
                
                return $this->transformer->transformForSearch(
                    $store, 
                    $distance, 
                    $distanceInMeters
                );
            });

            return $transformedStores
                ->sortBy('jarak_meter')
                ->values()
                ->toArray();
        });
    }
}