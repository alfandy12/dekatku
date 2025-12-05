import GradientButton from '@/components/ui/gradient-button';
import { Head } from '@inertiajs/react';
import { MessageCircle } from 'lucide-react';

export default function HomeLayout({
    children,
    title,
}: {
    children: React.ReactNode;
    title?: string;
}) {
    return (
        <>
            <Head title={`Dekatku - ${title}`}>
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
            <div className="relative">
                {children}
                <div className="fixed right-5 bottom-5 z-50">
                    <GradientButton className="flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-transparent bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500">
                        <MessageCircle className="h-14 w-14 text-white" />
                    </GradientButton>
                </div>
            </div>
        </>
    );
}
