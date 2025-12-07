
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Badge } from '@/components/ui/badge';
import { ProductDetail } from '@/types/store';

interface ProductDetailModalProps {
    product: ProductDetail | null;
    onClose: () => void;
}

export default function ProductDetailModal({
    product,
    onClose,
}: ProductDetailModalProps) {
    if (!product) return null;

    const formatPrice = (price: string) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(Number(price));
    };

    return (
        <Dialog open={!!product} onOpenChange={onClose}>
            <DialogContent className="max-h-[90vh] max-w-2xl overflow-y-auto border-white/10 bg-zinc-950/95 text-white backdrop-blur-xl">
                <DialogHeader>
                    <DialogTitle className="text-2xl font-bold">
                        {product.title}
                    </DialogTitle>
                </DialogHeader>

                <div className="space-y-6">
                 
                    <div className="overflow-hidden rounded-xl">
                        <img
                            src={`/storage/${product.image}`}
                            alt={product.title}
                            className="h-auto w-full object-cover"
                        />
                    </div>

          
                    <div className="flex items-center justify-between rounded-xl border border-white/10 bg-white/5 p-4">
                        <span className="text-sm text-gray-400">Harga</span>
                        <span className="text-2xl font-bold text-sky-400">
                            {formatPrice(product.price)}
                        </span>
                    </div>


                    {product.categories.length > 0 && (
                        <div className="space-y-2">
                            <h3 className="text-sm font-semibold text-gray-400">
                                Kategori
                            </h3>
                            <div className="flex flex-wrap gap-2">
                                {product.categories.map((category, idx) => (
                                    <Badge
                                        key={idx}
                                        variant="secondary"
                                        className="bg-purple-500/20 text-purple-300 hover:bg-purple-500/30"
                                    >
                                        {category}
                                    </Badge>
                                ))}
                            </div>
                        </div>
                    )}

                    <div className="space-y-2">
                        <h3 className="text-sm font-semibold text-gray-400">
                            Deskripsi Produk
                        </h3>
                        <p className="leading-relaxed text-gray-300">
                            {product.description}
                        </p>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    );
}