import { useEffect, useRef } from 'react';

import { Message } from '@/types/chat-bot';
import ChatMessage from './chat-message';
import TypingIndicator from './typing-indicator';

interface ChatMessagesListProps {
    messages: Message[];
    isTyping: boolean;
}

export default function ChatMessagesList({
    messages,
    isTyping,
}: ChatMessagesListProps) {
    const messagesEndRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
    }, [messages]);

    return (
        <div className="flex-1 space-y-4 overflow-y-auto bg-zinc-900 p-4">
            {messages.map((message) => (
                <ChatMessage key={message.id} message={message} />
            ))}

            {isTyping && <TypingIndicator />}

            <div ref={messagesEndRef} />
        </div>
    );
}
