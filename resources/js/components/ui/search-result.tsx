import { SearchStore, RecentSearch } from '@/types/search';
import { MapPin, Store, Clock, X, Loader2 } from 'lucide-react';

interface SearchResultsProps {
    query: string;
    results?: SearchStore[];
    recentSearches: RecentSearch[];
    isSearching: boolean;
    onSelectStore: (store: SearchStore | RecentSearch) => void;
    onRemoveRecent: (id: number) => void;
    onClearRecent: () => void;
}

export default function SearchResults({
    query,
    results,
    recentSearches,
    isSearching,
    onSelectStore,
    onRemoveRecent,
    onClearRecent,
}: SearchResultsProps) {
    const showRecent = !query && recentSearches.length > 0;
    const showResults = query.length >= 2;
    const showEmpty = !showRecent && !showResults;

    if (showEmpty) {
        return (
            <div className="flex flex-col items-center justify-center py-16 text-center">
                <Store className="mb-4 h-16 w-16 text-white/20" />
                <p className="mb-2 text-sm font-medium text-white/70">
                    Mulai ketik untuk mencari toko
                </p>
                <p className="text-xs text-white/40">
                    Cari berdasarkan nama toko atau kategori
                </p>
            </div>
        );
    }

    return (
        <div>
            {showRecent && (
                <div className="p-3">
                    <div className="mb-3 flex items-center justify-between px-3">
                        <h3 className="flex items-center gap-2 text-sm font-semibold text-gray-400">
                            <Clock className="h-4 w-4" />
                            Pencarian Terakhir
                        </h3>
                        <button
                            onClick={onClearRecent}
                            className="text-xs text-gray-500 transition-colors hover:text-gray-300"
                        >
                            Hapus Semua
                        </button>
                    </div>

                    <div className="space-y-1">
                        {recentSearches.map((store) => (
                            <div
                                key={store.id}
                                className="  flex items-center gap-3 rounded-xl p-3  hover:bg-white/5"
                            >
                                <button
                                    onClick={() => onSelectStore(store)}
                                    className="flex cursor-pointer flex-1 items-center gap-3"
                                >
                                    {store.url_media ? (
                                        <img
                                            src={`/storage/${store.url_media}`}
                                            alt={store.nama_toko}
                                            className="h-10 w-10 rounded-lg object-cover ring-1 ring-white/10"
                                        />
                                    ) : (
                                        <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-sky-500 to-purple-500">
                                            <Store className="h-5 w-5 text-white" />
                                        </div>
                                    )}

                                    <div className="flex-1 text-left">
                                        <p className="text-sm font-medium text-white">
                                            {store.nama_toko}
                                        </p>
                                        <p className="text-xs text-gray-500">
                                            {store.type === 'product' ? 'Penjual Produk' : 'Layanan Jasa'}
                                        </p>
                                    </div>
                                </button>

                                <button
                                    onClick={() => onRemoveRecent(store.id)}
                                    className="opacity-0 transition-opacity group-hover:opacity-100"
                                >
                                    <X className="h-4 w-4 text-gray-500 hover:text-red-400" />
                                </button>
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {showResults && (
                <div className="p-3">
                    {isSearching ? (
                        <div className="flex items-center justify-center py-12">
                            <Loader2 className="h-8 w-8 animate-spin text-sky-400" />
                        </div>
                    ) : results && results.length > 0 ? (
                        <div className="space-y-1">
                            {results.map((store) => (
                                <button
                                    key={store.id}
                                    onClick={() => onSelectStore(store)}
                                    className="flex cursor-pointer w-full items-center gap-3 rounded-xl p-3 text-left transition-colors hover:bg-white/5"
                                >
                                    {store.url_media ? (
                                        <img
                                            src={`/storage/${store.url_media}`}
                                            alt={store.nama_toko}
                                            className="h-12 w-12 rounded-lg object-cover ring-1 ring-white/10"
                                        />
                                    ) : (
                                        <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-sky-500 to-purple-500">
                                            <Store className="h-6 w-6 text-white" />
                                        </div>
                                    )}

                                    <div className="flex-1">
                                        <p className="text-sm font-medium text-white">
                                            {store.nama_toko}
                                        </p>
                                        <div className="flex items-center gap-2 text-xs text-gray-400">
                                            <MapPin className="h-3 w-3" />
                                            <span>{store.jarak}</span>
                                        </div>
                                    </div>

                                    <div className="rounded-full bg-sky-500/20 px-2.5 py-1 text-xs font-medium text-sky-400">
                                        {store.type === 'product' ? 'Produk' : 'Jasa'}
                                    </div>
                                </button>
                            ))}
                        </div>
                    ) : (
                        <div className="py-12 text-center">
                            <Store className="mx-auto mb-3 h-12 w-12 text-white/20" />
                            <p className="mb-1 text-sm font-medium text-white/70">
                                Tidak ada toko ditemukan
                            </p>
                            <p className="text-xs text-white/40">
                                Coba kata kunci lain untuk "{query}"
                            </p>
                        </div>
                    )}
                </div>
            )}
        </div>
    );
}