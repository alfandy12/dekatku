import { storesApi } from '@/api/stores';
import { useQuery } from '@tanstack/react-query';

export const useNearbyStores = () => {
    return useQuery({
        queryKey: ['nearby-stores'],
        queryFn: storesApi.getNearbyStores,
        staleTime: 1000 * 60 * 60,
        gcTime: 1000 * 60 * 60,
    });
};

export const useAllStores = () => {
    return useQuery({
        queryKey: ['all-stores'],
        queryFn: storesApi.getAllStore,
        staleTime: 1000 * 60 * 60,
        gcTime: 1000 * 60 * 60,
    });
};

export const useStoreDetail = (slug: string) => {
    return useQuery({
        queryKey: ['store-detail', slug],
        queryFn: () => storesApi.getStoreBySlug(slug),
        enabled: !!slug,
        staleTime: 1000 * 60 * 30,
    });
};
