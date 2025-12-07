/* eslint-disable react-hooks/set-state-in-effect */
import { storesApi } from '@/api/stores';
import { RecentSearch } from '@/types/search';
import { useQuery } from '@tanstack/react-query';
import { useCallback, useEffect, useState } from 'react';

const RECENT_SEARCH_KEY = 'recent_store_searches';
const MAX_RECENT_SEARCHES = 5;

export const useStoreSearch = (query: string, enabled: boolean = true) => {
    const [recentSearches, setRecentSearches] = useState<RecentSearch[]>([]);

    useEffect(() => {
        const stored = localStorage.getItem(RECENT_SEARCH_KEY);
        if (stored) {
            try {
                setRecentSearches(JSON.parse(stored));
            } catch (error) {
                console.error('Failed to parse recent searches:', error);
                localStorage.removeItem(RECENT_SEARCH_KEY);
            }
        }
    }, []);

    const searchQuery = useQuery({
        queryKey: ['store-search', query],
        queryFn: () => storesApi.seachStores(query),
        enabled: enabled && query.length >= 2,
        staleTime: 1000 * 60 * 5,
        gcTime: 1000 * 60 * 10,
    });

    const addToRecentSearches = useCallback((store: RecentSearch) => {
        setRecentSearches((prev) => {
            const filtered = prev.filter((item) => item.id !== store.id);

            const updated = [
                { ...store, timestamp: Date.now() },
                ...filtered,
            ].slice(0, MAX_RECENT_SEARCHES);
            localStorage.setItem(RECENT_SEARCH_KEY, JSON.stringify(updated));

            return updated;
        });
    }, []);

    const clearRecentSearches = useCallback(() => {
        setRecentSearches([]);
        localStorage.removeItem(RECENT_SEARCH_KEY);
    }, []);

    const removeRecentSearch = useCallback((id: number) => {
        setRecentSearches((prev) => {
            const updated = prev.filter((item) => item.id !== id);
            localStorage.setItem(RECENT_SEARCH_KEY, JSON.stringify(updated));
            return updated;
        });
    }, []);

    return {
        searchResults: searchQuery.data,
        isSearching: searchQuery.isLoading,
        searchError: searchQuery.error,
        recentSearches,
        addToRecentSearches,
        clearRecentSearches,
        removeRecentSearch,
    };
};
