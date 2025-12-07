import { Link } from '@inertiajs/react';
import { Store } from 'lucide-react';
import GradientButton from '../ui/gradient-button';

export default function CallToAction() {
    return (
        <section className="w-full py-20">
            <div className="mx-auto max-w-7xl px-4 text-center md:px-6">
                <div className="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/5 to-white/0 p-12 backdrop-blur-sm md:p-16">
                    <div className="absolute -top-20 -left-20 h-60 w-60 rounded-full bg-gradient-to-br from-sky-500/20 via-purple-400/20 to-pink-500/20 blur-3xl" />
                    <div className="absolute -right-20 -bottom-20 h-60 w-60 rounded-full bg-gradient-to-br from-pink-500/20 via-purple-400/20 to-sky-500/20 blur-3xl" />

                    <div className="relative">
                        <div className="mb-6 inline-flex rounded-2xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 p-4">
                            <Store className="h-8 w-8 text-white" />
                        </div>

                        <h2 className="mb-4 text-3xl font-bold text-white md:text-4xl">
                            Punya UMKM? Yuk Daftar Sekarang!
                        </h2>

                        <p className="mb-8 text-lg leading-relaxed text-gray-300">
                            Daftarkan toko atau usahamu secara gratis dan mulai
                            jangkau lebih banyak pelanggan di sekitarmu. Biarkan
                            mereka menemukan produk dan jasamu dengan mudah!
                        </p>

                        <GradientButton className="px-8 py-4 text-lg">
                            <Link href={'/register'}>Daftar Sekarang</Link>
                        </GradientButton>
                    </div>
                </div>
            </div>
        </section>
    );
}
