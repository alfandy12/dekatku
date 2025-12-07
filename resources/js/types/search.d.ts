export interface SearchStore {
    id: number;
    nama_toko: string;
    slug: string;
    type: string;
    url_media: string | null;
    jarak: string;
    jarak_meter: number;
}

export interface SearchResult {
    stores: SearchStore[];
    query: string;
}

export interface RecentSearch {
    id: number;
    nama_toko: string;
    slug: string;
    type: string;
    url_media: string | null;
    timestamp: number;
}
