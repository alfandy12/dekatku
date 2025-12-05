<?php

namespace App\Transformers;

use App\Models\Store;

class StoreTransformer
{

    public function transformForList(Store $store, string $distance, ?int $distanceInMeters = null): array
    {
        return [
            'id' => $store->id,
            'nama_toko' => $store->title,
            'slug' => $store->slug,
            'description' => $store->description,
            'type' => $store->type,
            'jarak' => $distance,
            'jarak_meter' => $distanceInMeters,
            'url_media' => $store->url_media,
            'products' => $this->transformProducts($store->products),
        ];
    }

    public function transformForDetail(Store $store): array
    {
        return [
            'id' => $store->id,
            'nama_toko' => $store->title,
            'description' => $store->description,
            'type' => $store->type,
            'url_media' => $store->url_media,
            'location' => $store->location,
            'products' => $this->transformDetailProducts($store->products),
        ];
    }


    private function transformProducts($products): array
    {
        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'image' => $product->url_media,
            ];
        })->toArray();
    }

 
    private function transformDetailProducts($products): array
    {
        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'image' => $product->url_media,
                'price' => $product->price,
                'description' => $product->description,
                'categories' => $product->categories->pluck('name'),
            ];
        })->toArray();
    }
}