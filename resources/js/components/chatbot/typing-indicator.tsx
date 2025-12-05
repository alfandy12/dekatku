import { Bot } from 'lucide-react';

export default function TypingIndicator() {
    return (
        <div className="flex gap-3">
            <div className="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-zinc-800">
                <Bot className="h-4 w-4 text-white" />
            </div>
            <div className="rounded-2xl bg-zinc-800 px-4 py-3">
                <div className="flex gap-1">
                    {[0, 150, 300].map((delay) => (
                        <div
                            key={delay}
                            className="h-2 w-2 animate-bounce rounded-full bg-zinc-500"
                            style={{ animationDelay: `${delay}ms` }}
                        />
                    ))}
                </div>
            </div>
        </div>
    );
}
