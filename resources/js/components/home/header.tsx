import { cn } from '@/lib/utils';
import { ChevronRight } from 'lucide-react';
import { AnimatedGradientText } from '../ui/animated-gradient-text';
import FeatureCards from '../ui/features';
import SearchBar from '../ui/search';

export default function Header() {
    return (
        <div className="flex h-full flex-col items-center justify-start">
            <div className="group m relative mx-auto mt-28 flex items-center justify-center rounded-full px-4 py-1.5 shadow-[inset_0_-8px_10px_#8fdfff1f] transition-shadow duration-500 ease-out hover:shadow-[inset_0_-5px_10px_#8fdfff3f]">
                <span
                    className={cn(
                        'absolute inset-0 block h-full w-full animate-gradient rounded-[inherit] bg-gradient-to-r from-[#ffaa40]/50 via-[#9c40ff]/50 to-[#ffaa40]/50 bg-[length:300%_100%] p-[1px]',
                    )}
                    style={{
                        WebkitMask:
                            'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)',
                        WebkitMaskComposite: 'destination-out',
                        mask: 'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)',
                        maskComposite: 'subtract',
                        WebkitClipPath: 'padding-box',
                    }}
                />
                <span className="h-2 w-2 rounded-full bg-gradient-to-br from-sky-500 via-purple-400 to-pink-400"></span>
                <hr className="mx-2 h-4 w-px shrink-0 bg-neutral-500" />
                <AnimatedGradientText className="text-sm font-medium">
                    30+ UMKM didekat Anda
                </AnimatedGradientText>
                <ChevronRight className="ml-1 size-4 stroke-neutral-500 transition-transform duration-300 ease-in-out group-hover:translate-x-0.5" />
            </div>
            <div className="mt-10">
                <h1 className="inter-700 text-5xl font-bold">
                    Jelajahi{' '}
                    <span className="bg-gradient-to-br from-sky-500 via-purple-500 to-pink-400 bg-clip-text font-black text-transparent">
                        UMKM
                    </span>{' '}
                    Sekitar Anda
                </h1>
            </div>
            <h3 className="inter-100 mb-3 text-3xl">
                Dapatkan rekomendasi lokasi yang relevan untuk kebutuhan Anda.
            </h3>
            <SearchBar />
            <FeatureCards />
        </div>
    );
}
