import ChatBot from '@/components/chatbot';
import { Head } from '@inertiajs/react';

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

            <div className="relative h-full">
                {children}
                <ChatBot />
            </div>
        </>
    );
}
