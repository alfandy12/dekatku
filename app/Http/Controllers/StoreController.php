<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class StoreController extends Controller
{
    public function home(Request $request) {
        $data = $this->getNearbyStores($request, 5);

        if ($request->wantsJson()){
            return response()->json($data);
        }

        return Inertia::render('welcome', [
            'canRegister' => Features::enabled(Features::registration()),
         ]);
    }

    public function index(Request $request) {
        $data = $this->getNearbyStores($request);
        
        if($request->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('stores/index');
    }

     public function show(Request $request, string $slug)
    {
        $data = $this->getStoreDetail($slug);
        
        if ($request->wantsJson()) {
            return response()->json($data);
        }
        
        return Inertia::render('umkm/detail', ['slug' => $slug]);
    }

    private function getNearbyStores(Request $request, ?int $limit = null) {
        $sessionId = $request->session()->getId();
        $cacheKey = "nearby_stores_{$sessionId}";

        return Cache::remember($cacheKey, 3600, function() use ($limit) {
            $stores = Store::with(['products' => function ($query) {
                $query->select('id', 'store_id', 'title', 'url_media')->limit(3);
            }])
            ->get()
            ->map(function ($store) {
                return [
                    'id' => $store->id,
                    'nama_toko' => $store->title,
                    'slug' => $store->slug,
                    'description' => $store->description,
                    'type' => $store->type,
                    'jarak' => $this->generateRandomDistance(),
                    'jarak_meter' => null,
                    'url_media' => $store->url_media,
                    'products' =>  $store->products->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'title' => $product->title,
                            'image' => $product->url_media,
                        ];
                    })
                ];
            })
            ->sortBy(function ($store) {
                return $this->distanceToMeters($store['jarak']);
            })
            ->values()
            ->map(function ($store) {
                $store['jarak_meter'] = $this->distanceToMeters($store['jarak']);
                return $store;
            });
            return $limit ? $stores->take($limit) : $stores;
        });
    }

    private function getStoreDetail(string $slug) {
        $store = Store::where('slug', $slug)
        ->with(['products.categories', 'users'])
        ->firstOrFail();

        return [
            'id' => $store->id,
            'nama_toko' => $store->title,
            'description' => $store->description,
            'type' => $store->type,
            'url_media' => $store->url_media,
            'location' => $store->location,
            'products' => $store->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'image' => $product->url_media,
                    'price' => $product->price,
                    'description' => $product->description,
                    'categories' => $product->categories->pluck('name'),
                ];
            })
        ];
    }


    private function generateRandomDistance(): string {
        $meters = rand(500, 5000);

        if ($meters < 1000) {
            return $meters . 'm';
        }

        return round($meters / 1000, 1) . 'km';
    }

    private function distanceToMeters(string $distance): int {
        if (str_contains($distance, 'km')) {
            return (int) (floatval($distance) * 1000); 
        }

        return (int) floatval($distance);
    }
}
