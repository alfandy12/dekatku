import { Send } from 'lucide-react';
import { useState } from 'react';

interface ChatInputProps {
    onSend: (message: string) => void;
    disabled?: boolean;
}

export default function ChatInput({
    onSend,
    disabled = false,
}: ChatInputProps) {
    const [input, setInput] = useState('');

    const handleSend = () => {
        if (!input.trim() || disabled) return;
        onSend(input);
        setInput('');
    };

    const handleKeyPress = (e: React.KeyboardEvent) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            handleSend();
        }
    };

    return (
        <div className="border-t border-zinc-800 bg-zinc-800/50 p-4">
            <div className="flex gap-2">
                <input
                    type="text"
                    value={input}
                    onChange={(e) => setInput(e.target.value)}
                    onKeyPress={handleKeyPress}
                    placeholder="Ketik pesan..."
                    className="flex-1 rounded-xl bg-zinc-800 px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:ring-2 focus:ring-purple-400 focus:outline-none"
                />
                <button
                    onClick={handleSend}
                    disabled={!input.trim() || disabled}
                    className="rounded-xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 px-4 py-2.5 text-white transition-opacity hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <Send className="h-5 w-5" />
                </button>
            </div>
            <p className="mt-2 text-center text-xs text-zinc-500">
                Tekan Enter untuk mengirim
            </p>
        </div>
    );
}
