import StoreNavbar from '@/components/store-navbar';
import HomeLayout from './app/home-layout';

export default function StoreLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    return (
        <HomeLayout>
            <div className="relative bg-zinc-950! px-2 md:px-0">
                <div className="flex w-full justify-center md:min-h-screen">
                    <StoreNavbar />
                    <div className="mt-28 w-full max-w-7xl">{children}</div>
                </div>
            </div>
        </HomeLayout>
    );
}
