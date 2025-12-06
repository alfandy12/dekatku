import { Message } from '@/types/chat-bot';

export const STORAGE_KEY = 'chatbot_messages';

export const WELCOME_MESSAGE: Message = {
    id: Date.now().toString(),
    role: 'assistant',
    content:
        'Halo! 👋 Saya asisten AI untuk membantu Anda menemukan UMKM terdekat. Ada yang bisa saya bantu?',
    timestamp: new Date(),
};

export const TYPING_DELAY = 1000;

export const TEMP_RESPONSE =
    'Terima kasih! Saya sedang memproses pertanyaan Anda...';
