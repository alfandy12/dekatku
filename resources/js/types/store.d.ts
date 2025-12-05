export interface Product {
    id: number;
    title: string;
    image: string;
}

export interface Store {
    id: number;
    nama_toko: string;
    slug: string;
    description: string;
    type: string;
    jarak: string;
    jarak_meter: number;
    url_media: string | null;
    products: Product[];
}

export interface NearbyStoresResponse {
    data: Store[];
}

export interface StorePaginateResponse {
    data: Store[];
    meta: {
        current_page: number;
        per_page: number;
        total: number;
        last_page: number;
        has_more: boolean;
    };
}
