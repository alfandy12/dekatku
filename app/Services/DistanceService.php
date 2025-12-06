<?php

namespace App\Services;

class DistanceService
{

    public function generateRandomDistance(int $storeId, string $sessionId): string
    {
        $seed = crc32($storeId . $sessionId);
        
        mt_srand($seed);
        $meters = mt_rand(500, 5000);
        mt_srand();
        
        if ($meters < 1000) {
            return $meters . 'm';
        }
        
        return round($meters / 1000, 1) . 'km';
    }


    public function distanceToMeters(string $distance): int
    {
        if (str_contains($distance, 'km')) {
            return (int) (floatval($distance) * 1000);
        }

        return (int) floatval($distance);
    }


    public function formatDistance(int $meters): string
    {
        if ($meters < 1000) {
            return $meters . 'm';
        }
        
        return round($meters / 1000, 1) . 'km';
    }
}