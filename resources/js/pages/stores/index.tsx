import StoreSkeleton from '@/components/ui/stores/store-skeleton';
import { useAllStores } from '@/hooks/stores/use-nearby-stores';
import StoreLayout from '@/layouts/store-layout';
import { lazy } from 'react';
const StoreCard = lazy(() => import('@/components/ui/stores/store-card'));

export default function Index() {
    const { data: stores, isLoading, isError, error } = useAllStores();

    if (isLoading) {
        return (
            <StoreLayout>
                <div className="space-y-6">
                    {[1, 2, 3, 4, 5].map((i) => (
                        <StoreSkeleton key={i} />
                    ))}
                </div>
            </StoreLayout>
        );
    }

    if (isError) {
        return (
            <section id="toko" className="w-full py-20">
                <div className="mx-auto max-w-7xl px-4 md:px-6">
                    <div className="rounded-2xl border border-red-500/20 bg-red-500/10 p-8 text-center">
                        <p className="text-red-400">
                            Gagal memuat data toko:{' '}
                            {error instanceof Error
                                ? error.message
                                : 'Unknown error'}
                        </p>
                    </div>
                </div>
            </section>
        );
    }

    return (
        <StoreLayout>
            <div className="grid grid-cols-2 gap-5">
                {stores?.map((store) => (
                    <div key={store.id}>
                        <StoreCard store={store} index={store.id} />
                    </div>
                ))}
            </div>
        </StoreLayout>
    );
}
