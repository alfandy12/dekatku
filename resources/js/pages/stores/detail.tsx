import { Breadcrumbs } from '@/components/breadcrumbs';
import ProductGrid from '@/components/ui/stores/product.grid';
import StoreHeader from '@/components/ui/stores/store-header';
import StoreMap from '@/components/ui/stores/store-map';
import { useStoreDetail } from '@/hooks/stores/use-nearby-stores';
import StoreLayout from '@/layouts/store-layout';
import { Link, usePage } from '@inertiajs/react';
import { ArrowLeft, Loader2 } from 'lucide-react';
import { useMemo } from 'react';

export default function Detail() {
    const { props } = usePage();
    const { data, isLoading, isError, error } = useStoreDetail(
        props.slug as string,
    );

    const breadcrumbs = useMemo(() => {
        if (!data) return [];

        return [
            { title: 'Home', href: '/' },
            { title: 'Toko', href: '/umkm' },
            { title: data.nama_toko, href: `/umkm/${data.slug}` },
        ];
    }, [data]);

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
                <div className="space-y-4">
                    <Link
                        href="/umkm"
                        className="inline-flex items-center gap-2 text-sm text-gray-400 transition-colors hover:text-white"
                    >
                        <ArrowLeft className="h-4 w-4" />
                        Kembali ke Daftar Toko
                    </Link>
                    <div className="rounded-2xl border border-red-500/20 bg-red-500/10 p-8 text-center">
                        <p className="text-red-400">
                            Gagal memuat detail toko:{' '}
                            {error instanceof Error
                                ? error.message
                                : 'Unknown error'}
                        </p>
                    </div>
                </div>
            </StoreLayout>
        );
    }

    if (!data) {
        return (
            <StoreLayout className="mt-32 max-w-6xl px-2 md:px-0">
                <div className="space-y-4">
                    <Link
                        href="/umkm"
                        className="inline-flex items-center gap-2 text-sm text-gray-400 transition-colors hover:text-white"
                    >
                        <ArrowLeft className="h-4 w-4" />
                        Kembali ke Daftar Toko
                    </Link>
                    <div className="rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                        <p className="text-gray-400">Toko tidak ditemukan</p>
                    </div>
                </div>
            </StoreLayout>
        );
    }

    return (
        <StoreLayout
            className="mt-32 max-w-6xl space-y-6 px-2 md:px-0"
            title={data.nama_toko}
        >
            <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <Link
                    href="/umkm"
                    className="inline-flex items-center gap-2 text-sm text-gray-400 transition-colors hover:text-white"
                >
                    <ArrowLeft className="h-4 w-4" />
                    Kembali ke Daftar Toko
                </Link>

                <Breadcrumbs breadcrumbs={breadcrumbs} />
            </div>

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
