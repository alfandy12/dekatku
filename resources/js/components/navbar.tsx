import { Link } from '@inertiajs/react';
import { MapPin } from 'lucide-react';
import GradientButton from './ui/gradient-button';

export default function Navbar() {
    return (
        <nav className="fixed top-0 z-50 mt-5 w-full max-w-7xl">
            <div className="flex items-center justify-between rounded-4xl border-t-2 border-l border-white/20 bg-white/5 p-4 backdrop-blur-md">
                <div className="inter-700 flex items-center justify-center space-x-2 text-lg font-bold">
                    <span>
                        <MapPin />
                    </span>
                    <p>Dekatku</p>
                </div>

                <div className="flex items-center space-x-4">
                    <Link href={'#home'}>Home</Link>
                    <Link href={'#home'}>Tentang</Link>
                    <Link href={'#home'}>Toko</Link>
                    <div className="space-x-2.5">
                        <Link
                            href={'/login'}
                            className="inter-500 rounded-4xl border-t-2 border-l-2 border-t-white/10 border-l-white/10 px-4 py-2 backdrop-blur-md"
                        >
                            Login
                        </Link>
                        <Link
                            href={'/register'}
                            className="inter-500 rounded-4xl border-t-2 border-l-2 border-t-white/10 border-l-white/10 px-4 py-2"
                        >
                            Register
                        </Link>
                        <GradientButton className="py-2">
                            <Link>Jelajahi Toko</Link>
                        </GradientButton>
                    </div>
                </div>
            </div>
        </nav>
    );
}
