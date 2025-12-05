import { Message } from '@/types/chat-bot';
import ChatHeader from './chat-header';
import ChatInput from './chat-input';
import ChatMessagesList from './chat-messages-list';

interface ChatWindowProps {
    messages: Message[];
    isTyping: boolean;
    onSend: (message: string) => void;
    onClose: () => void;
    onClear: () => void;
}

export default function ChatWindow({
    messages,
    isTyping,
    onSend,
    onClose,
    onClear,
}: ChatWindowProps) {
    return (
        <div className="mb-4 flex h-[600px] w-96 flex-col overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900 shadow-2xl">
            <ChatHeader onClose={onClose} onClear={onClear} />
            <ChatMessagesList messages={messages} isTyping={isTyping} />
            <ChatInput onSend={onSend} disabled={isTyping} />
        </div>
    );
}
