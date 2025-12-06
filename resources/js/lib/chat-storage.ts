/* eslint-disable @typescript-eslint/no-explicit-any */
import { STORAGE_KEY } from '@/constants/chat.constants';
import { Message } from '@/types/chat-bot';

export const chatStorage = {
    getMessages(): Message[] | null {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (!saved) return null;
        const parsed = JSON.parse(saved);
        return parsed.map((msg: any) => ({
            ...msg,
            timestamp: new Date(msg.timestamp),
        }));
    },

    saveMessages(messages: Message[]): void {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(messages));
    },

    clearMessages(): void {
        localStorage.removeItem(STORAGE_KEY);
    },
};
