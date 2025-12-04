import { Store } from '@/types/store';
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

    getAllStore: async (): Promise<Store[]> => {
        const response = await api.get<Store[]>('/umkm');
        return response.data;
    },

    getStoreBySlug: async (slug: string): Promise<Store> => {
        const response = await api.get<Store>(`/umkm/${slug}`);
        return response.data;
    },
};
