import { cn } from '@/lib/utils';
import { Search } from 'lucide-react';
import { useEffect, useState } from 'react';
import SearchModal from './search-modal';

interface SearchBarProps {
    className?: string;
    inputStyle?: string;
    placeholder?: string;
}

export default function SearchBar({
    className,
    inputStyle,
    placeholder = 'Cari toko...',
}: SearchBarProps) {
    const [isModalOpen, setIsModalOpen] = useState(false);

    useEffect(() => {
        const handleKeyDown = (e: KeyboardEvent) => {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                setIsModalOpen(true);
            }
        };

        document.addEventListener('keydown', handleKeyDown);
        return () => document.removeEventListener('keydown', handleKeyDown);
    }, []);

    return (
        <>
            <button
                onClick={() => setIsModalOpen(true)}
                className={cn('relative w-full max-w-3xl text-left', className)}
            >
                <Search className="absolute left-4 top-1/2 z-10 h-5 w-5 -translate-y-1/2 text-white/70" />
                <div
                    className={cn(
                        'w-full rounded-2xl border border-white/20 bg-white/10 pl-12 pr-16 text-white/50 backdrop-blur-md transition-all duration-300 hover:border-white/30 hover:bg-white/15',
                        inputStyle
                    )}
                >
                    {placeholder}
                </div>

                <div className="absolute right-4 top-1/2 -translate-y-1/2">
                    <kbd className="hidden rounded-lg border border-white/20 bg-white/10 px-2 py-1 text-xs font-medium text-white/50 md:inline-block">
                        ⌘K
                    </kbd>
                </div>
            </button>
            {isModalOpen && (
                <SearchModal open={isModalOpen} onOpenChange={setIsModalOpen} />
            )}
        </>
    );
}