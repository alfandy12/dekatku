import { MessageCircle } from 'lucide-react';

interface ChatButtonProps {
    onClick: () => void;
    unreadCount?: number;
}

export default function ChatButton({
    onClick,
    unreadCount = 1,
}: ChatButtonProps) {
    return (
        <button
            onClick={onClick}
            className="relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 shadow-lg transition-all hover:scale-110 hover:shadow-xl"
        >
            <MessageCircle className="h-6 w-6 text-white" />
            {unreadCount > 0 && (
                <span className="absolute -top-1 -right-1 flex h-5 w-5 animate-pulse items-center justify-center rounded-full bg-red-500 text-xs font-semibold text-white">
                    {unreadCount}
                </span>
            )}
        </button>
    );
}
