import StoreNavbar from '@/components/store-navbar';
import { cn } from '@/lib/utils';
import HomeLayout from './app/home-layout';

export default function StoreLayout({
    children,
    title,
    className,
}: {
    children: React.ReactNode;
    title?: string;
    className?: string;
}) {
    return (
        <HomeLayout title={title}>
            <div className="relative bg-zinc-950! px-2 md:px-0">
                <div className="flex w-full justify-center md:min-h-screen">
                    <StoreNavbar />
                    <div className={cn('mt-28 w-full max-w-7xl', className)}>
                        {children}
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
