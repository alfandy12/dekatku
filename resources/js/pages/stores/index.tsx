import StoreSkeleton from '@/components/ui/stores/store-skeleton';
import { useAllStores } from '@/hooks/stores/use-nearby-stores';

import StoreLayout from '@/layouts/store-layout';
import { lazy, useEffect, useRef } from 'react';
const StoreCard = lazy(() => import('@/components/ui/stores/store-card'));

export default function Index() {
    const {
        data,
        isLoading,
        isError,
        error,
        fetchNextPage,
        hasNextPage,
        isFetchingNextPage,
    } = useAllStores(10);

    const observerTarget = useRef<HTMLDivElement>(null);

    useEffect(() => {
        const observer = new IntersectionObserver(
            (entries) => {
                if (
                    entries[0].isIntersecting &&
                    hasNextPage &&
                    !isFetchingNextPage
                ) {
                    fetchNextPage();
                }
            },
            { threshold: 0.5, rootMargin: '100px' },
        );

        const currentTarget = observerTarget.current;
        if (currentTarget) {
            observer.observe(currentTarget);
        }

        return () => {
            if (currentTarget) {
                observer.unobserve(currentTarget);
            }
        };
    }, [fetchNextPage, hasNextPage, isFetchingNextPage]);

    if (isLoading) {
        return (
            <StoreLayout>
                <div className="grid grid-cols-2 gap-5">
                    {[1, 2, 3, 4, 5, 6].map((i) => (
                        <StoreSkeleton key={i} />
                    ))}
                </div>
            </StoreLayout>
        );
    }

    if (isError) {
        return (
            <StoreLayout>
                <div className="rounded-2xl border border-red-500/20 bg-red-500/10 p-8 text-center">
                    <p className="text-red-400">
                        Gagal memuat data toko:{' '}
                        {error instanceof Error
                            ? error.message
                            : 'Unknown error'}
                    </p>
                </div>
            </StoreLayout>
        );
    }

    const allStores = data?.pages.flatMap((page) => page.data) ?? [];

    return (
        <StoreLayout>
            <div className="space-y-6">
                <div className="grid grid-cols-1 gap-5 md:grid-cols-2">
                    {allStores.map((store, index) => (
                        <div key={`${store.id}-${index}`}>
                            <StoreCard store={store} index={index} />
                        </div>
                    ))}
                </div>

                {isFetchingNextPage && (
                    <div className="grid grid-cols-1 gap-5 md:grid-cols-2">
                        {[1, 2].map((i) => (
                            <StoreSkeleton key={i} />
                        ))}
                    </div>
                )}

                <div ref={observerTarget} className="h-10" />

                {!hasNextPage && allStores.length > 0 && (
                    <div className="py-8 text-center">
                        <p className="text-sm text-muted-foreground">
                            Semua toko sudah ditampilkan
                        </p>
                    </div>
                )}

                {allStores.length === 0 && (
                    <div className="py-20 text-center">
                        <p className="text-muted-foreground">
                            Belum ada toko tersedia
                        </p>
                    </div>
                )}
            </div>
        </StoreLayout>
    );
}
