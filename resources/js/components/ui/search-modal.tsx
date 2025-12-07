/* eslint-disable react-hooks/set-state-in-effect */
import {
    Dialog,
    DialogContent,

} from '@/components/ui/dialog';
import { Search, X } from 'lucide-react';
import { useEffect, useState } from 'react';
import { useStoreSearch } from '@/hooks/stores/use-store-search';

import { RecentSearch, SearchStore } from '@/types/search';
import { router } from '@inertiajs/react';
import SearchResults from './search-result';
interface SearchModalProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
}

export default function SearchModal({ open, onOpenChange }: SearchModalProps) {
    const [query, setQuery] = useState('');

    const {
        searchResults,
        isSearching,
        recentSearches,
        addToRecentSearches,
        clearRecentSearches,
        removeRecentSearch,
    } = useStoreSearch(query, open);



    useEffect(() => {
        if (!open) {
            setQuery('');
        }
    }, [open]);

    const handleSelectStore = (store: SearchStore | RecentSearch) => {
        addToRecentSearches({
            id: store.id,
            nama_toko: store.nama_toko,
            slug: store.slug,
            type: store.type,
            url_media: store.url_media,
            timestamp: Date.now(),
        });

        router.visit(`/umkm/${store.slug}`);
        onOpenChange(false);
    };

    return (
        
        <Dialog  open={open} onOpenChange={onOpenChange}>
            <DialogContent className="max-h-[85vh] max-w-2xl gap-0 overflow-hidden border-white/10 bg-zinc-900/98 p-0 backdrop-blur-xl">
                <div className="border-b border-white/10 p-4">
                    <div className="relative">
                        <Search className="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-white/70" />
                        <input
                            type="text"
                            value={query}
                            onChange={(e) => setQuery(e.target.value)}
                            placeholder="Cari toko UMKM..."
                            className="w-full rounded-xl border border-white/20 bg-white/5 py-3 pl-12 pr-12 text-white placeholder:text-white/50 focus:border-white/40 focus:bg-white/10 focus:outline-none"
                            autoFocus
                        />

                 
                        {query && (
                            <button
                                onClick={() => setQuery('')}
                                className="absolute right-4 top-1/2 -translate-y-1/2 text-white/50 transition-colors hover:text-white"
                            >
                                <X className="h-5 w-5" />
                            </button>
                        )}
                    </div>
                </div>

                <div className="max-h-[calc(85vh-80px)] overflow-y-auto">
                    <SearchResults
                        query={query}
                        results={searchResults?.stores}
                        recentSearches={recentSearches}
                        isSearching={isSearching}
                        onSelectStore={handleSelectStore}
                        onRemoveRecent={removeRecentSearch}
                        onClearRecent={clearRecentSearches}
                    />
                </div>

                <div className="border-t border-white/10 bg-white/5 px-4 py-3">
                    <div className="flex items-center justify-between text-xs text-gray-400">
                        <div className="flex items-center gap-4">
                            <div className="flex items-center gap-1.5">
                                <kbd className="rounded bg-white/10 px-1.5 py-0.5 font-mono">↑↓</kbd>
                                <span>Navigate</span>
                            </div>
                            <div className="flex items-center gap-1.5">
                                <kbd className="rounded bg-white/10 px-1.5 py-0.5 font-mono">Enter</kbd>
                                <span>Select</span>
                            </div>
                        </div>
                        <div className="flex items-center gap-1.5">
                            <kbd className="rounded bg-white/10 px-1.5 py-0.5 font-mono">Esc</kbd>
                            <span>Close</span>
                        </div>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    );
}