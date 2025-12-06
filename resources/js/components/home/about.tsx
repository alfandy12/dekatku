import { MapPin, Sparkles, Store, Users } from 'lucide-react';
import ShinyText from '../ShinyText';
import { BorderBeam } from '../ui/border-beam';

export default function About() {
    return (
        <section id="about" className="w-full py-20">
            <div className="mx-auto max-w-7xl px-4 md:px-6">
                <div className="mb-16 text-center">
                    <ShinyText
                        className="inter-800 mb-4 text-4xl font-bold md:text-5xl"
                        text=" Tentang Dekatku"
                    />
                    <p className="mx-auto max-w-3xl text-lg leading-relaxed text-gray-400">
                        Platform yang menghubungkan masyarakat dengan UMKM lokal
                        terdekat. Kami percaya bahwa produk lokal berkualitas
                        ada di sekitar kita, tinggal bagaimana kita menemukannya
                        dengan mudah.
                    </p>
                </div>

                <div className="mb-16 grid gap-8 md:grid-cols-2">
                    <div className="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/5 p-8 backdrop-blur-md transition-all duration-300 hover:border-white/30 hover:bg-white/10">
                        <div className="absolute -top-8 -right-8 h-32 w-32 rounded-full bg-gradient-to-br from-sky-500/20 via-purple-400/20 to-pink-500/20 blur-2xl transition-all duration-300 group-hover:scale-150" />

                        <div className="relative">
                            <div className="mb-4 inline-flex rounded-xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 p-3">
                                <Users className="h-6 w-6 text-white" />
                            </div>

                            <h3 className="mb-3 text-2xl font-semibold text-gray-200">
                                Untuk Kamu yang Lagi Cari
                            </h3>

                            <p className="mb-6 leading-relaxed text-gray-300">
                                Butuh makanan enak di dekat rumah? Atau lagi
                                nyari jasa service terdekat? Dekatku bantu kamu
                                nemuin UMKM lokal yang kamu butuhin, tinggal
                                buka lokasi dan lihat yang paling deket dari
                                kamu.
                            </p>

                            <div className="space-y-3">
                                <div className="flex items-start gap-3">
                                    <MapPin className="mt-1 h-5 w-5 flex-shrink-0 text-sky-400" />
                                    <p className="text-sm text-gray-400">
                                        Lihat UMKM terdekat dari lokasimu secara
                                        real-time
                                    </p>
                                </div>
                                <div className="flex items-start gap-3">
                                    <Sparkles className="mt-1 h-5 w-5 flex-shrink-0 text-purple-400" />
                                    <p className="text-sm text-gray-400">
                                        Tanya AI assistant untuk rekomendasi
                                        yang pas
                                    </p>
                                </div>
                            </div>
                        </div>
                        <BorderBeam
                            duration={6}
                            size={400}
                            className="from-transparent via-pink-500 to-transparent"
                        />
                        <BorderBeam
                            duration={6}
                            delay={3}
                            size={400}
                            borderWidth={2}
                            className="from-transparent via-sky-500 to-transparent"
                        />
                    </div>

                    <div className="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/5 p-8 backdrop-blur-md transition-all duration-300 hover:border-white/30 hover:bg-white/10">
                        <div className="absolute -top-8 -right-8 h-32 w-32 rounded-full bg-gradient-to-br from-sky-500/20 via-purple-400/20 to-pink-500/20 blur-2xl transition-all duration-300 group-hover:scale-150" />

                        <div className="relative">
                            <div className="mb-4 inline-flex rounded-xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 p-3">
                                <Store className="h-6 w-6 text-white" />
                            </div>

                            <h3 className="mb-3 text-2xl font-semibold text-gray-200">
                                Untuk Pemilik UMKM
                            </h3>

                            <p className="mb-6 leading-relaxed text-gray-300">
                                Punya usaha tapi susah ditemukan pelanggan?
                                Daftarin tokomu di Dekatku, gratis! Biar
                                orang-orang di sekitar lokasi usahamu bisa
                                nemuin produk atau jasa yang kamu tawarkan
                                dengan lebih mudah.
                            </p>

                            <div className="space-y-3">
                                <div className="flex items-start gap-3">
                                    <MapPin className="mt-1 h-5 w-5 flex-shrink-0 text-sky-400" />
                                    <p className="text-sm text-gray-400">
                                        Muncul otomatis untuk user yang ada di
                                        sekitar tokomu
                                    </p>
                                </div>
                                <div className="flex items-start gap-3">
                                    <Sparkles className="mt-1 h-5 w-5 flex-shrink-0 text-purple-400" />
                                    <p className="text-sm text-gray-400">
                                        AI akan bantu rekomendasikan tokomu ke
                                        user yang cocok
                                    </p>
                                </div>
                            </div>
                        </div>
                        <BorderBeam
                            duration={6}
                            size={400}
                            className="from-transparent via-pink-500 to-transparent"
                        />
                        <BorderBeam
                            duration={6}
                            delay={3}
                            size={400}
                            borderWidth={2}
                            className="from-transparent via-sky-500 to-transparent"
                        />
                    </div>
                </div>

                <div className="relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/0 p-8 backdrop-blur-md md:p-12">
                    <div className="absolute inset-0 bg-gradient-to-br from-sky-500/5 via-purple-400/5 to-pink-500/5" />

                    <div className="relative text-center">
                        <h3 className="mb-4 text-2xl font-semibold text-white md:text-3xl">
                            Kenapa Dekatku Ada?
                        </h3>
                        <p className="mx-auto max-w-2xl text-lg leading-relaxed text-gray-300">
                            UMKM lokal memiliki produk berkualitas yang tidak
                            kalah dengan brand besar. UMKM membutuhkan platform
                            yang tepat untuk lebih mudah ditemukan. Kami hadir
                            untuk menghubungkan Anda dengan UMKM terbaik di
                            sekitar dengan cara yang praktis dan efisien.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    );
}
