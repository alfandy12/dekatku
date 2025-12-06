import { WELCOME_MESSAGE } from '@/constants/chat.constants';
import { chatStorage } from '@/lib/chat-storage';
import { Message } from '@/types/chat-bot';
import axios from 'axios';
import { useEffect, useState } from 'react';

interface ChatResponse {
    success: boolean;
    response: string;
    context?: {
        stores_count: number;
        has_location: boolean;
    };
}

export const useChatMessages = () => {
    const [messages, setMessages] = useState<Message[]>([]);
    const [isTyping, setIsTyping] = useState(false);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const savedMessages = chatStorage.getMessages();
        if (savedMessages && savedMessages.length > 0) {
            setMessages(savedMessages);
        } else {
            const welcomeMsg = {
                ...WELCOME_MESSAGE,
                id: Date.now().toString(),
            };
            setMessages([welcomeMsg]);
            chatStorage.saveMessages([welcomeMsg]);
        }
    }, []);

    useEffect(() => {
        if (messages.length > 0) {
            chatStorage.saveMessages(messages);
        }
    }, [messages]);

    const buildHistory = (
        currentMessages: Message[],
    ): Array<{ role: string; content: string }> => {
        return currentMessages
            .filter((msg) => msg.content !== WELCOME_MESSAGE.content)
            .slice(-5)
            .map((msg) => ({
                role: msg.role,
                content: msg.content,
            }));
    };

    const sendMessage = async (content: string) => {
        if (!content.trim()) return;

        setError(null);

        const userMessage: Message = {
            id: Date.now().toString(),
            role: 'user',
            content: content.trim(),
            timestamp: new Date(),
        };

        const updatedMessages = [...messages, userMessage];
        setMessages(updatedMessages);
        setIsTyping(true);

        try {
            const history = buildHistory(updatedMessages);

            const chatAxios = axios.create({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Inertia': 'false',
                },
            });

            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]',
            );
            if (csrfToken) {
                chatAxios.defaults.headers.common['X-CSRF-TOKEN'] =
                    csrfToken.getAttribute('content');
            }

            const { data } = await chatAxios.post<ChatResponse>('/chat', {
                message: content.trim(),
                history,
            });

            console.log('Chat response:', data);

            if (!data.success) {
                throw new Error(data.response || 'Failed to get response');
            }

            const botMessage: Message = {
                id: (Date.now() + 1).toString(),
                role: 'assistant',
                content: data.response,
                timestamp: new Date(),
            };

            setMessages((prev) => [...prev, botMessage]);
        } catch (err) {
            console.error('Chat error:', err);

            let errorMsg =
                'Maaf, terjadi kesalahan saat memproses pesan Anda. Silakan coba lagi. 🙏';

            if (axios.isAxiosError(err)) {
                if (err.response?.status === 419) {
                    errorMsg = 'Session expired. Silakan refresh halaman. 🔄';
                } else if (err.response?.data?.message) {
                    errorMsg = err.response.data.message;
                } else if (err.response?.data?.response) {
                    errorMsg = err.response.data.response;
                }
            }

            const errorMessage: Message = {
                id: (Date.now() + 1).toString(),
                role: 'assistant',
                content: errorMsg,
                timestamp: new Date(),
            };

            setMessages((prev) => [...prev, errorMessage]);
            setError(err instanceof Error ? err.message : 'Unknown error');
        } finally {
            setIsTyping(false);
        }
    };

    const clearMessages = () => {
        const welcomeMsg = { ...WELCOME_MESSAGE, id: Date.now().toString() };
        setMessages([welcomeMsg]);
        chatStorage.saveMessages([welcomeMsg]);
        setError(null);
    };

    return {
        messages,
        isTyping,
        error,
        sendMessage,
        clearMessages,
    };
};
