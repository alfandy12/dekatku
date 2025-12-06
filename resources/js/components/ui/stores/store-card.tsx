import { MapPin } from 'lucide-react';
import { Store } from '@/types/store';
import { memo } from 'react';
import { MagicCard } from '../magic-card';

interface StoreCardProps {
    store: Store;
    index: number;
}

const StoreCard = memo(({ store, index }: StoreCardProps) => {
    const truncateText = (text: string, maxLength: number) => {
        if (text.length <= maxLength) return text;
        return text.slice(0, maxLength) + '...';
    };

    

    const getProductGrid = (productCount: number) => {
        if (productCount === 2) return 'grid-cols-2';
        if (productCount === 3) return 'grid-cols-3';
        if (productCount === 4) return 'grid-cols-2';
        return 'grid-cols-3';
    };

    return (
        <MagicCard
            gradientColor={ "#262626" }
            className="p-0.5 rounded-2xl"
        >
        <div
            className="group relative cursor-pointer overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/0 p-6 backdrop-blur-sm transition-all duration-300 hover:border-white/20 hover:bg-white/10"
            style={{ animationDelay: `${index * 0.1}s` }}
        >
          
            <div className="absolute -top-20 -right-20 h-40 w-40 rounded-full bg-gradient-to-br from-sky-500/10 via-purple-400/10 to-pink-500/10 blur-3xl transition-all duration-500 group-hover:scale-150" />
            <div className="relative">
    
                <div className="mb-4 flex items-start gap-4">
                    <img
                        src={`/storage/${store.url_media}` }
                        alt={store.nama_toko}
                        className="h-16 w-16 flex-shrink-0 rounded-full border-2 border-white/20 object-cover"
                        loading="lazy"
                    />

                    <div className="flex-1">
                        
                        <h3 className="mb-1 text-xl font-semibold text-white">
                            {store.nama_toko}
                        </h3>
                        <div className="flex items-center gap-1.5 text-sm text-gray-400">
                            <MapPin className="h-4 w-4 text-sky-400" />
                            <span>{store.jarak} dari lokasimu</span>
                        </div>
                    </div>
                </div>

                <p className="mb-4 leading-relaxed text-gray-300">
                    {truncateText(store.description, 120)}
                </p>

         
                {store.products.length > 0 && (
                    <div
                        className={`grid gap-2 ${getProductGrid(store.products.length)}`}
                    >
                        {store.products.map((product, idx) => (
                            <div
                                key={product.id}
                                className={`overflow-hidden rounded-lg ${
                                    store.products.length === 5 && idx === 0
                                        ? 'col-span-2 row-span-2'
                                        : store.products.length === 4 &&
                                            idx < 2
                                          ? 'col-span-1'
                                          : ''
                                }`}
                            >
                                <img
                                    src={`/storage/${product.image}`}
                                    alt={product.title || `Product ${idx + 1}`}
                                    className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy"
                                    style={{
                                        aspectRatio:
                                            store.products.length === 5 &&
                                            idx === 0
                                                ? '1/1'
                                                : '4/3',
                                    }}
                                />
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </div>
        </MagicCard>
    );
});

StoreCard.displayName = 'StoreCard';

export default StoreCard;