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
