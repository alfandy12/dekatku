<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Http\Requests\SearchStoreRequest;
use App\Services\ChatService;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Features;

class StoreController extends Controller
{
    public function __construct(
        private ChatService $chatService,
        private StoreService $storeService,
       
    ) {
        Log::info('StoreController: Services injected successfully');
    }

    public function chat(ChatRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $sessionId = $request->session()->getId();
            
            $nearbyStores = $this->storeService->getStoresForChatWithFullDetails($sessionId);
            
            Log::info('Stores loaded:', ['count' => count($nearbyStores)]);

            $context = [
                'nearby_stores' => $nearbyStores,
                'user_location' => $request->session()->get('user_location'),
            ];

            if (isset($validated['history']) && count($validated['history']) > 0) {
                $messages = $validated['history'];
                $messages[] = [
                    'role' => 'user',
                    'content' => $validated['message'],
                ];
                
                $result = $this->chatService->chatWithHistory($messages, $context);
            } else {
                $result = $this->chatService->chat($validated['message'], $context);
            }

            Log::info('Chat result:', $result);

            return response()->json([
                'success' => $result['success'],
                'response' => $result['message'],
                'context' => [
                    'stores_count' => count($nearbyStores),
                    'has_location' => $request->session()->has('user_location'),
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('=== CHAT ERROR ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'response' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function home(Request $request): JsonResponse|Response
    {
        $sessionId = $request->session()->getId();
        $data = $this->storeService->getNearbyStores($sessionId, limit: 5);

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('welcome', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    }

    public function index(Request $request): JsonResponse|Response
    {
        $sessionId = $request->session()->getId();
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        
        $data = $this->storeService->getPaginatedNearbyStores(
            $sessionId, 
            $page, 
            $perPage
        );
        
        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('stores/index');
    }

 
    public function show(Request $request, string $slug): JsonResponse|Response
    {
        $sessionId = $request->session()->getId();
        $data = $this->storeService->getStoreDetail($slug, $sessionId);
        
        if ($request->wantsJson()) {
            return response()->json($data);
        }
        
        return Inertia::render('stores/detail', ['slug' => $slug]);
    }

    public function search(SearchStoreRequest $request): JsonResponse
    {
        $sessionId = $request->session()->getId();
        $query = $request->getQuery();
        
        $data = $this->storeService->searchStores($query, $sessionId);
        
        return response()->json([
            'stores' => $data,
            'query' => $query
        ]);
    }
}