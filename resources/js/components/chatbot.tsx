import { useChatMessages } from '@/hooks/chatbot/use-chat-messages';
import { useState } from 'react';
import ChatButton from './chatbot/chat-button';
import ChatWindow from './chatbot/chat-window';

export default function ChatBot() {
    const [isOpen, setIsOpen] = useState(false);
    const { messages, isTyping, sendMessage, clearMessages } =
        useChatMessages();

    return (
        <div
            className={`fixed z-50 ${
                isOpen
                    ? 'inset-0 flex items-center justify-center bg-zinc-950/70'
                    : 'right-5 bottom-5'
            }`}
        >
            {isOpen && (
                <ChatWindow
                    messages={messages}
                    isTyping={isTyping}
                    onSend={sendMessage}
                    onClose={() => setIsOpen(false)}
                    onClear={clearMessages}
                />
            )}

            {!isOpen && <ChatButton onClick={() => setIsOpen(true)} />}
        </div>
    );
}
