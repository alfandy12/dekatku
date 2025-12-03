import { Link } from '@inertiajs/react';
import {
    Facebook,
    Instagram,
    Mail,
    MapPin,
    Phone,
    Twitter,
} from 'lucide-react';

export default function Footer() {
    return (
        <footer className="flex w-full items-center justify-center border-t border-white/10">
            <div className="w-full max-w-7xl px-4 py-12 md:px-6">
                <div className="grid gap-8 md:grid-cols-4">
                    <div className="md:col-span-2">
                        <h3 className="inter-700 mb-3 bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 bg-clip-text text-2xl font-bold text-transparent">
                            Dekatku
                        </h3>
                        <p className="mb-4 leading-relaxed text-gray-400">
                            Platform yang menghubungkan masyarakat dengan UMKM
                            lokal terdekat. Temukan produk dan jasa berkualitas
                            di sekitarmu.
                        </p>

                        <div className="flex gap-3">
                            <a
                                href="#"
                                className="rounded-lg border border-white/10 bg-white/5 p-2 text-gray-400 transition-all hover:border-white/20 hover:bg-white/10 hover:text-white"
                            >
                                <Instagram className="h-5 w-5" />
                            </a>
                            <a
                                href="#"
                                className="rounded-lg border border-white/10 bg-white/5 p-2 text-gray-400 transition-all hover:border-white/20 hover:bg-white/10 hover:text-white"
                            >
                                <Facebook className="h-5 w-5" />
                            </a>
                            <a
                                href="#"
                                className="rounded-lg border border-white/10 bg-white/5 p-2 text-gray-400 transition-all hover:border-white/20 hover:bg-white/10 hover:text-white"
                            >
                                <Twitter className="h-5 w-5" />
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 className="mb-4 font-semibold text-white">
                            Tautan Cepat
                        </h4>
                        <ul className="space-y-2">
                            <li>
                                <a
                                    href="#home"
                                    className="text-gray-400 transition-colors hover:text-white"
                                >
                                    Home
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#about"
                                    className="text-gray-400 transition-colors hover:text-white"
                                >
                                    Tentang
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#toko"
                                    className="text-gray-400 transition-colors hover:text-white"
                                >
                                    UMKM Terdekat
                                </a>
                            </li>
                            <li>
                                <Link
                                    className="text-gray-400 transition-colors hover:text-white"
                                    href={'/umkm'}
                                >
                                    Explore UMKM
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 className="mb-4 font-semibold text-white">
                            Kontak
                        </h4>
                        <ul className="space-y-3">
                            <li className="flex items-start gap-2 text-gray-400">
                                <Mail className="mt-0.5 h-4 w-4 flex-shrink-0" />
                                <span className="text-sm">
                                    info@dekatku.com
                                </span>
                            </li>
                            <li className="flex items-start gap-2 text-gray-400">
                                <Phone className="mt-0.5 h-4 w-4 flex-shrink-0" />
                                <span className="text-sm">
                                    +62 812-3456-7890
                                </span>
                            </li>
                            <li className="flex items-start gap-2 text-gray-400">
                                <MapPin className="mt-0.5 h-4 w-4 flex-shrink-0" />
                                <span className="text-sm">
                                    Jakarta, Indonesia
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div className="mt-12 border-t border-white/10 pt-8 text-center text-sm text-gray-400">
                    <p>
                        &copy; {new Date().getFullYear()} Dekatku. All rights
                        reserved.
                    </p>
                </div>
            </div>
        </footer>
    );
}
