import { SearchResult } from '@/types/search';
import { Store, StorePaginateResponse } from '@/types/store';
import axios from 'axios';

const api = axios.create({
    baseURL: '/',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export const storesApi = {
    getNearbyStores: async (): Promise<Store[]> => {
        const response = await api.get<Store[]>('/');
        return response.data;
    },

    getAllStores: async (
        page = 1,
        perPage = 10,
    ): Promise<StorePaginateResponse> => {
        const response = await api.get<StorePaginateResponse>('/umkm', {
            params: { page, per_page: perPage },
        });
        return response.data;
    },

    getStoreBySlug: async (slug: string): Promise<Store> => {
        const response = await api.get<Store>(`/umkm/${slug}`);
        return response.data;
    },

    seachStores: async (query: string): Promise<SearchResult> => {
        const response = await api.get<SearchResult>('/umkm/search/q', {
            params: { q: query },
        });
        return response.data;
    },
};
