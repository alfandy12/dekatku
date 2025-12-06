
import { ProductDetail } from '@/types/store';
import { useState } from 'react';
import ProductCard from './product-card';
import ProductDetailModal from './product-detail-modal';


interface ProductGridProps {
    products: ProductDetail[];
}

export default function ProductGrid({ products }: ProductGridProps) {
    const [visibleCount, setVisibleCount] = useState(6);
    const [selectedProduct, setSelectedProduct] = useState<ProductDetail | null>(null);

    const visibleProducts = products.slice(0, visibleCount);
    const hasMore = visibleCount < products.length;

    const handleLoadMore = () => {
        setVisibleCount(prev => Math.min(prev + 6, products.length));
    };

    return (
        <div className="space-y-4">
            <div className="flex items-center justify-between">
                <h2 className="text-xl font-semibold text-white">
                    Produk ({products.length})
                </h2>
            </div>

      
            <div className="max-h-[600px] space-y-3 overflow-y-auto rounded-2xl border border-white/10 bg-white/5 p-4 pr-2 backdrop-blur-sm scrollbar-thin scrollbar-track-white/5 scrollbar-thumb-white/20">
                <div className="grid grid-cols-2 gap-3 pr-2 md:grid-cols-3">
                    {visibleProducts.map((product) => (
                        <ProductCard
                            key={product.id}
                            product={product}
                            onClick={() => setSelectedProduct(product)}
                        />
                    ))}
                </div>

  
                {hasMore && (
                    <button
                        onClick={handleLoadMore}
                        className="w-full rounded-xl border border-white/20 bg-white/5 py-3 text-sm font-medium text-white transition-all hover:bg-white/10"
                    >
                        Lihat {Math.min(6, products.length - visibleCount)} Produk Lainnya
                    </button>
                )}
            </div>

         
            <ProductDetailModal
                product={selectedProduct}
                onClose={() => setSelectedProduct(null)}
            />
        </div>
    );
}