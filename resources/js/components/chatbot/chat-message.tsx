import { Message } from '@/types/chat-bot';
import { Bot, User } from 'lucide-react';

interface ChatMessageProps {
    message: Message;
}

export default function ChatMessage({ message }: ChatMessageProps) {
    const isUser = message.role === 'user';

    return (
        <div
            className={`flex gap-3 ${isUser ? 'flex-row-reverse' : 'flex-row'}`}
        >
            <div
                className={`flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ${
                    isUser
                        ? 'bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500'
                        : 'bg-zinc-800'
                }`}
            >
                {isUser ? (
                    <User className="h-4 w-4 text-white" />
                ) : (
                    <Bot className="h-4 w-4 text-white" />
                )}
            </div>

            <div
                className={`max-w-[75%] ${isUser ? 'items-end' : 'items-start'} flex flex-col gap-1`}
            >
                <div
                    className={`rounded-2xl px-4 py-2.5 ${
                        isUser
                            ? 'bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 text-white'
                            : 'bg-zinc-800 text-zinc-100'
                    }`}
                >
                    <p className="text-sm leading-relaxed whitespace-pre-wrap">
                        {message.content}
                    </p>
                </div>
                <span className="px-1 text-xs text-zinc-500">
                    {message.timestamp.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                    })}
                </span>
            </div>
        </div>
    );
}
