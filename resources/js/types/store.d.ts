export interface ProductDetail {
    id: number;
    title: string;
    image: string;
    price: string;
    description: string;
    categories: string[];
}

export interface MapLocation {
    lat: number;
    lng: number;
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
    location: string;
    products: ProductDetail[];
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
