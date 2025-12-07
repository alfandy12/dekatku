import { MapPin } from 'lucide-react';

const NavbarLayout = ({ children }: { children: React.ReactNode }) => {
    return (
        <nav className="fixed top-0 z-40 mt-5 w-full max-w-7xl px-2">
            <div className="flex items-center justify-between gap-2.5 rounded-4xl border-t-2 border-l border-white/20 bg-white/5 p-4 backdrop-blur-md">
                <div className="inter-700 flex items-center justify-center space-x-2 text-lg font-bold text-white">
                    <span>
                        <MapPin />
                    </span>
                    <p>Dekatku</p>
                </div>
                {children}
            </div>
        </nav>
    );
};

export default NavbarLayout;
