import { Link } from '@inertiajs/react';
import { MapPin, SquareArrowOutUpRight } from 'lucide-react';
import { useEffect, useRef } from 'react';

const stores = [
    {
        id: 1,
        name: 'Warung Makan Bu Siti',
        profile:
            'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop',
        description:
            'Warung makan rumahan dengan menu nusantara yang lezat dan harga terjangkau. Spesial nasi goreng kambing dan soto ayam yang selalu ramai pembeli setiap hari.',
        distance: 350,
        products: [
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&h=300&fit=crop',
        ],
    },
    {
        id: 2,
        name: 'Toko Kue Manis Jaya',
        profile:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop',
        description:
            'Menyediakan berbagai kue tradisional dan modern untuk segala acara. Bisa custom pesanan sesuai keinginan dengan harga bersaing.',
        distance: 580,
        products: [
            'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&h=300&fit=crop',
        ],
    },
    {
        id: 3,
        name: 'Bengkel Motor Jaya Abadi',
        profile:
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop',
        description:
            'Bengkel motor terpercaya dengan mekanik berpengalaman lebih dari 15 tahun. Melayani service rutin, ganti oli, dan perbaikan besar kecil dengan garansi.',
        distance: 750,
        products: [
            'https://images.unsplash.com/photo-1558981852-426c6c22a060?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=400&h=300&fit=crop',
        ],
    },
    {
        id: 4,
        name: 'Laundry Express 24 Jam',
        profile:
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop',
        description:
            'Layanan laundry kiloan dan satuan dengan hasil bersih maksimal. Buka 24 jam untuk kemudahan Anda.',
        distance: 1200,
        products: [
            'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?w=400&h=300&fit=crop',
        ],
    },
    {
        id: 5,
        name: 'Toko Bunga Cantik Indah',
        profile:
            'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&h=200&fit=crop',
        description:
            'Menjual berbagai jenis bunga segar untuk dekorasi, hadiah, dan segala keperluan acara spesial Anda. Tersedia rangkaian bunga custom dengan desain menarik dan elegan.',
        distance: 1850,
        products: [
            'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1487070183336-b863922373d4?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=400&h=300&fit=crop',
        ],
    },
];

export default function Store() {
    const cardsRef = useRef<(HTMLDivElement | null)[]>([]);

    useEffect(() => {
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
    }, []);

    const truncateText = (text: string, maxLength: number) => {
        if (text.length <= maxLength) return text;
        return text.slice(0, maxLength) + '...';
    };

    const getProductGrid = (product: string[]) => {
        const count = product.length;

        if (count === 2) {
            return 'grid-cols-2';
        } else if (count === 3) {
            return 'grid-cols-3';
        } else if (count === 4) {
            return 'grid-cols-2';
        } else {
            return 'grid-cols-3';
        }
    };
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
                    {stores.map((store, index) => (
                        <div
                            key={store.id}
                            ref={(el) => {
                                cardsRef.current[index] = el;
                            }}
                            className="store-card group relative cursor-pointer overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/0 p-6 backdrop-blur-sm transition-all duration-300 hover:border-white/20 hover:bg-white/10"
                            style={{ animationDelay: `${index * 0.1}s` }}
                        >
                            <div className="absolute -top-20 -right-20 h-40 w-40 rounded-full bg-gradient-to-br from-sky-500/10 via-purple-400/10 to-pink-500/10 blur-3xl transition-all duration-500 group-hover:scale-150" />

                            <div className="relative">
                                <div className="mb-4 flex items-start gap-4">
                                    <img
                                        src={store.profile}
                                        alt={store.name}
                                        className="h-16 w-16 flex-shrink-0 rounded-full border-2 border-white/20 object-cover"
                                    />

                                    <div className="flex-1">
                                        <h3 className="mb-1 text-xl font-semibold text-white">
                                            {store.name}
                                        </h3>
                                        <div className="flex items-center gap-1.5 text-sm text-gray-400">
                                            <MapPin className="h-4 w-4 text-sky-400" />
                                            <span>
                                                {store.distance < 1000
                                                    ? `${store.distance}m`
                                                    : `${(store.distance / 1000).toFixed(1)}km`}{' '}
                                                dari lokasimu
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <p className="mb-4 leading-relaxed text-gray-300">
                                    {truncateText(store.description, 120)}
                                </p>

                                {store.products.length > 0 && (
                                    <div
                                        className={`grid gap-2 ${getProductGrid(store.products)}`}
                                    >
                                        {store.products.map((product, idx) => (
                                            <div
                                                key={idx}
                                                className={`overflow-hidden rounded-lg ${
                                                    store.products.length ===
                                                        5 && idx === 0
                                                        ? 'col-span-2 row-span-2'
                                                        : store.products
                                                                .length === 4 &&
                                                            idx < 2
                                                          ? 'col-span-1'
                                                          : ''
                                                }`}
                                            >
                                                <img
                                                    src={product}
                                                    alt={`Product ${idx + 1}`}
                                                    className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                    style={{
                                                        aspectRatio:
                                                            store.products
                                                                .length === 5 &&
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
                    ))}
                </div>
                <Link
                    href={'/umkm'}
                    className="mt-5 flex items-center justify-center space-x-1.5 py-3 text-lg font-semibold md:text-xl"
                >
                    <p>Lihat Lebih Banyak</p>
                    <SquareArrowOutUpRight />
                </Link>
            </div>
        </section>
    );
}
