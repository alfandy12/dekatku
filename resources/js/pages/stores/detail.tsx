import ProductGrid from '@/components/ui/stores/product.grid';
import StoreHeader from '@/components/ui/stores/store-header';
import StoreMap from '@/components/ui/stores/store-map';
import { useStoreDetail } from '@/hooks/stores/use-nearby-stores';
import StoreLayout from '@/layouts/store-layout';
import { usePage } from '@inertiajs/react';
import { Loader2 } from 'lucide-react';

export default function Detail() {
    const { props } = usePage();
    const { data, isLoading, isError, error } = useStoreDetail(
        props.slug as string,
    );

    if (isLoading) {
        return (
            <StoreLayout className="mt-32 max-w-6xl px-2 md:px-0">
                <div className="flex min-h-[60vh] items-center justify-center">
                    <div className="space-y-4 text-center">
                        <Loader2 className="mx-auto h-12 w-12 animate-spin text-sky-400" />
                        <p className="text-gray-400">Memuat detail toko...</p>
                    </div>
                </div>
            </StoreLayout>
        );
    }

    if (isError) {
        return (
            <StoreLayout className="mt-32 max-w-6xl px-2 md:px-0">
                <div className="rounded-2xl border border-red-500/20 bg-red-500/10 p-8 text-center">
                    <p className="text-red-400">
                        Gagal memuat detail toko:{' '}
                        {error instanceof Error
                            ? error.message
                            : 'Unknown error'}
                    </p>
                </div>
            </StoreLayout>
        );
    }

    if (!data) {
        return (
            <StoreLayout className="mt-32 max-w-6xl px-2 md:px-0">
                <div className="rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                    <p className="text-gray-400">Toko tidak ditemukan</p>
                </div>
            </StoreLayout>
        );
    }

    return (
        <StoreLayout
            className="mt-32 max-w-6xl space-y-8 px-2 md:px-0"
            title={data.nama_toko}
        >
            <StoreHeader store={data} />

            {data.products.length > 0 ? (
                <ProductGrid products={data.products} />
            ) : (
                <div className="rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                    <p className="text-gray-400">Belum ada produk tersedia</p>
                </div>
            )}

            <StoreMap location={data.location} storeName={data.nama_toko} />
        </StoreLayout>
    );
}
