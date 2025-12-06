import { storesApi } from '@/api/stores';
import { useInfiniteQuery, useQuery } from '@tanstack/react-query';

export const useNearbyStores = () => {
    return useQuery({
        queryKey: ['nearby-stores'],
        queryFn: storesApi.getNearbyStores,
        staleTime: 1000 * 60 * 60,
        gcTime: 1000 * 60 * 60,
    });
};

export const useAllStores = (perPage = 10) => {
    return useInfiniteQuery({
        queryKey: ['stores', 'infinite', perPage],
        queryFn: async ({ pageParam }) => {
            return await storesApi.getAllStores(pageParam, perPage);
        },
        getNextPageParam: (lastPage) => {
            return lastPage.meta.has_more
                ? lastPage.meta.current_page + 1
                : undefined;
        },
        initialPageParam: 1,
        staleTime: 1000 * 60 * 5,
        gcTime: 1000 * 60 * 10,
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
