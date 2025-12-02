import { Link } from '@inertiajs/react';
import { MapPin, Menu } from 'lucide-react';
import { useState } from 'react';
import {
    Drawer,
    DrawerContent,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from './ui/drawer';
import GradientButton from './ui/gradient-button';

export default function Navbar() {
    const [open, setOpen] = useState(false);

    return (
        <nav className="fixed top-0 z-50 mt-5 w-full max-w-7xl px-4">
            <div className="flex items-center justify-between rounded-4xl border-t-2 border-l border-white/20 bg-white/5 p-4 backdrop-blur-md">
                <div className="inter-700 flex items-center justify-center space-x-2 text-lg font-bold text-white">
                    <span>
                        <MapPin />
                    </span>
                    <p>Dekatku</p>
                </div>

                <div className="hidden items-center space-x-4 md:flex">
                    <a
                        href="#home"
                        className="text-white transition-colors hover:text-gray-300"
                    >
                        Home
                    </a>
                    <a
                        href="#about"
                        className="text-white transition-colors hover:text-gray-300"
                    >
                        Tentang
                    </a>
                    <a
                        href="#toko"
                        className="text-white transition-colors hover:text-gray-300"
                    >
                        UMKM Terdekat
                    </a>
                    <div className="flex items-center space-x-2.5">
                        <Link
                            href={'/login'}
                            className="inter-500 rounded-4xl border-t-2 border-l-2 border-t-white/10 border-l-white/10 px-4 py-2 text-white backdrop-blur-md transition-all hover:bg-white/10"
                        >
                            Login
                        </Link>
                        <Link
                            href={'/register'}
                            className="inter-500 rounded-4xl border-t-2 border-l-2 border-t-white/10 border-l-white/10 px-4 py-2 text-white transition-all hover:bg-white/10"
                        >
                            Register
                        </Link>
                        <GradientButton className="px-4 py-2">
                            <Link href="/explore">Jelajahi UMKM</Link>
                        </GradientButton>
                    </div>
                </div>

                <Drawer open={open} onOpenChange={setOpen}>
                    <DrawerTrigger asChild>
                        <button className="rounded-lg p-2 text-white hover:bg-white/10 md:hidden">
                            <Menu className="h-6 w-6" />
                        </button>
                    </DrawerTrigger>
                    <DrawerContent className="border-white/10 bg-black/95 backdrop-blur-xl">
                        <DrawerHeader>
                            <DrawerTitle className="flex items-center justify-center gap-2 text-white">
                                <MapPin className="h-5 w-5" />
                                <span>Dekatku</span>
                            </DrawerTitle>
                        </DrawerHeader>
                        <div className="px-4 pb-8">
                            <div className="mb-6 space-y-2">
                                <a
                                    href="#home"
                                    onClick={() => setOpen(false)}
                                    className="block rounded-lg px-4 py-3 text-white transition-colors hover:bg-white/10"
                                >
                                    Home
                                </a>
                                <a
                                    href="#about"
                                    onClick={() => setOpen(false)}
                                    className="block rounded-lg px-4 py-3 text-white transition-colors hover:bg-white/10"
                                >
                                    Tentang
                                </a>
                                <a
                                    href="#toko"
                                    onClick={() => setOpen(false)}
                                    className="block rounded-lg px-4 py-3 text-white transition-colors hover:bg-white/10"
                                >
                                    UMKM Terdekat
                                </a>
                            </div>

                            <div className="space-y-3 border-t border-white/10 pt-6">
                                <Link
                                    href={'/login'}
                                    className="block rounded-lg border border-white/20 bg-white/5 px-4 py-3 text-center text-white backdrop-blur-md transition-all hover:bg-white/10"
                                >
                                    Login
                                </Link>
                                <Link
                                    href={'/register'}
                                    className="block rounded-lg border border-white/20 bg-white/5 px-4 py-3 text-center text-white backdrop-blur-md transition-all hover:bg-white/10"
                                >
                                    Register
                                </Link>
                                <Link href="/explore">
                                    <GradientButton className="w-full px-4 py-3">
                                        Jelajahi UMKM
                                    </GradientButton>
                                </Link>
                            </div>
                        </div>
                    </DrawerContent>
                </Drawer>
            </div>
        </nav>
    );
}
