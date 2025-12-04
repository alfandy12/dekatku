import { cn } from '@/lib/utils';
import { Search } from 'lucide-react';

export default function SearchBar({className, inputStyle}: {className?:string, inputStyle: string}) {
    return (
        <div className={cn('relative w-full max-w-3xl ', className)}>
            <Search className="absolute left-4 top-1/2 h-5 w-5 z-10 -translate-y-1/2 text-white/70" />
            <input
                type="text"
                placeholder="Search..."
                className={cn('w-full rounded-2xl border border-white/20 bg-white/10 pl-12 pr-4 text-white backdrop-blur-md placeholder:text-white/50 focus:border-white/40 focus:bg-white/10 focus:outline-none transition-all duration-300', inputStyle)}
            />
        </div>
    );
}