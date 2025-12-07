import { Store  } from '@/types/store';
import { MapPin, StoreIcon } from 'lucide-react';


interface StoreHeaderProps {
    store: Store;
}

export default function StoreHeader({ store }: StoreHeaderProps) {
    return (
        <div className="space-y-4 rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm">
           
            <div className="flex items-start gap-4">
                {store.url_media ? (
                    <img
                        src={`/storage/${store.url_media}`}
                        alt={store.nama_toko}
                        className="h-20 w-20 rounded-xl object-cover ring-2 ring-white/10"
                    />
                ) : (
                    <div className="flex h-20 w-20 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-purple-500">
                        <StoreIcon className="h-10 w-10 text-white" />
                    </div>
                )}

                <div className="flex-1 space-y-2">
                    <h1 className="bg-gradient-to-r from-sky-400 to-purple-400 bg-clip-text text-3xl font-bold text-transparent">
                        {store.nama_toko}
                    </h1>
                    
                    <div className="flex items-center gap-2 text-sm text-gray-400">
                        <MapPin className="h-4 w-4" />
                        <span>{store.jarak} dari lokasimu</span>
                    </div>

                    <div className="inline-flex rounded-full bg-sky-500/20 px-3 py-1 text-xs font-medium text-sky-400">
                        {store.type === 'product' ? 'Penjual Produk' : 'Layanan Jasa'}
                    </div>
                </div>
            </div>

           
            {store.description && (
                <div className="border-t border-white/10 pt-4">
                    <p className="text-gray-300 leading-relaxed">
                        {store.description}
                    </p>
                </div>
            )}
        </div>
    );
}