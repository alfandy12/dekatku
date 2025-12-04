import { useNearbyStores } from '@/hooks/stores/use-nearby-stores';
import { Link } from '@inertiajs/react';
import { SquareArrowOutUpRight } from 'lucide-react';
import { lazy, Suspense, useEffect, useRef } from 'react';
import StoreSkeleton from '../ui/stores/store-skeleton';
const StoreCard = lazy(() => import('../ui/stores/store-card'));

export default function Store() {
    const { data: stores, isLoading, isError, error } = useNearbyStores();
    const cardsRef = useRef<(HTMLDivElement | null)[]>([]);
    console.log('data', stores);

    useEffect(() => {
        if (!stores) return;

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px',
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        cardsRef.current.forEach((card) => {
            if (card) observer.observe(card);
        });

        return () => observer.disconnect();
    }, [stores]);

    if (isLoading) {
        return (
            <section id="toko" className="w-full py-20">
                <div className="mx-auto max-w-7xl px-4 md:px-6">
                    <div className="mb-12 text-center">
                        <h2 className="mb-3 bg-gradient-to-r from-sky-500 via-purple-400 to-pink-500 bg-clip-text text-4xl font-bold text-transparent md:text-5xl">
                            UMKM Terdekat
                        </h2>
                        <p className="text-gray-400">
                            Memuat toko di sekitar lokasimu...
                        </p>
                    </div>

                    <div className="space-y-6">
                        {[1, 2, 3, 4, 5].map((i) => (
                            <StoreSkeleton key={i} />
                        ))}
                    </div>
                </div>
            </section>
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

    if (!stores || stores.length === 0) {
        return (
            <section id="toko" className="w-full py-20">
                <div className="mx-auto max-w-7xl px-4 md:px-6">
                    <div className="rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                        <p className="text-gray-400">
                            Belum ada toko terdaftar di sekitar lokasimu
                        </p>
                    </div>
                </div>
            </section>
        );
    }

    return (
        <section id="toko" className="w-full py-20">
            <div className="mx-auto max-w-7xl px-4 md:px-6">
                <div className="mb-12 text-center">
                    <h2 className="mb-3 bg-gradient-to-r from-sky-500 via-purple-400 to-pink-500 bg-clip-text text-4xl font-bold text-transparent md:text-5xl">
                        UMKM Terdekat
                    </h2>
                    <p className="text-gray-400">
                        Temukan UMKM lokal di sekitar lokasimu
                    </p>
                </div>

                <div className="space-y-6">
                    <Suspense
                        fallback={
                            <>
                                {stores.map((_, i) => (
                                    <StoreSkeleton key={i} />
                                ))}
                            </>
                        }
                    >
                        {stores.map((store, index) => (
                            <div
                                key={store.id}
                                ref={(el) => {
                                    cardsRef.current[index] = el;
                                }}
                            >
                                <StoreCard store={store} index={index} />
                            </div>
                        ))}
                    </Suspense>
                </div>

                <Link
                    href="/umkm"
                    className="mt-5 flex items-center justify-center space-x-1.5 py-3 text-lg font-semibold md:text-xl"
                >
                    <p>Lihat Lebih Banyak</p>
                    <SquareArrowOutUpRight />
                </Link>
            </div>
        </section>
    );
}
