
import { ProductDetail } from '@/types/store';
import { useState } from 'react';

interface ProductCardProps {
    product: ProductDetail;
    onClick: () => void;
}

export default function ProductCard({ product, onClick }: ProductCardProps) {
    const [isHovered, setIsHovered] = useState(false);

    const formatPrice = (price: string) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(Number(price));
    };

    return (
        <div
            className="group relative cursor-pointer overflow-hidden rounded-xl bg-white/5 transition-all hover:scale-105 hover:bg-white/10"
            onClick={onClick}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
        >
        
            <div className="aspect-square overflow-hidden">
                <img
                    src={`/storage/${product.image}`}
                    alt={product.title}
                    className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                    loading="lazy"
                />
            </div>

          
            <div
                className={`absolute inset-0 flex items-end bg-gradient-to-t from-black/90 via-black/50 to-transparent p-3 transition-opacity duration-300 ${
                    isHovered ? 'opacity-100' : 'opacity-0'
                }`}
            >
                <div className="w-full space-y-1">
                    <h3 className="line-clamp-2 text-sm font-semibold text-white">
                        {product.title}
                    </h3>
                    <p className="text-xs font-medium text-sky-400">
                        {formatPrice(product.price)}
                    </p>
                </div>
            </div>

     
            <div className="absolute right-2 top-2 rounded-lg bg-black/70 px-2 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                {formatPrice(product.price)}
            </div>
        </div>
    );
}