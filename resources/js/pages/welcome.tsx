import FloatingLines from '@/components/FloatingLines';
import HomeNavbar from '@/components/home-navbar';
import About from '@/components/home/about';
import CallToAction from '@/components/home/call-to-action';
import Footer from '@/components/home/footer';
import Header from '@/components/home/header';
import Store from '@/components/home/store';
import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function Welcome() {
    const [showBackground, setShowBackground] = useState(true);
    const isMobile = typeof window !== 'undefined' && window.innerWidth < 768;

    const [lineCount] = useState<number[]>(
        isMobile ? [30, 20, 12] : [10, 15, 12],
    );
    const [lineDistance] = useState<number[]>(
        isMobile ? [25, 10, 4] : [2, 40, 4],
    );

    useEffect(() => {
        const handleScroll = () => {
            const scrollY = window.scrollY;
            const viewPortHeight = window.innerHeight;

            setShowBackground(scrollY < viewPortHeight);
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);
    return (
        <>
            <Head title="Deketku">
                <link rel="preconnect" href="https://fonts.googleapis.com" />
                <link
                    rel="preconnect"
                    href="https://fonts.gstatic.com"
                    crossOrigin="anonymous"
                />
                <link
                    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
                    rel="stylesheet"
                />
            </Head>
            <div className="relative w-full">
                <div
                    className={`absolute top-0 h-screen w-full [mask-image:linear-gradient(to_bottom,#000000_0%,#000000_50%,rgba(0,0,0,0.5)_94%,transparent_100%)] transition-opacity duration-700 ease-in-out md:h-[110vh] ${
                        showBackground ? 'opacity-100' : 'hidden opacity-0'
                    }`}
                    style={{ height: '100vh' }}
                >
                    <FloatingLines
                        enabledWaves={['top', 'bottom']}
                        lineCount={lineCount}
                        lineDistance={lineDistance}
                        bendRadius={3}
                        bendStrength={-0.5}
                        interactive={true}
                        parallax={true}
                    />
                </div>

                <div className="relative z-10">
                    <div className="flex w-full justify-center md:min-h-screen">
                        <HomeNavbar />
                        <div className="w-full max-w-7xl md:p-3">
                            <Header />
                        </div>
                    </div>

                    <div className="w-full bg-zinc-950!">
                        <div className="mx-auto w-full max-w-7xl p-2 md:p-3">
                            <About />
                            <Store />
                            <CallToAction />
                        </div>
                    </div>
                </div>
                <Footer />
            </div>
        </>
    );
}
