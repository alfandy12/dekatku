import { Bot, X } from 'lucide-react';

interface ChatHeaderProps {
    onClose: () => void;
    onClear: () => void;
}

export default function ChatHeader({ onClose, onClear }: ChatHeaderProps) {
    return (
        <div className="flex items-center justify-between bg-gradient-to-r from-sky-500 via-purple-400 to-pink-500 p-4">
            <div className="flex items-center gap-3">
                <div className="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
                    <Bot className="h-6 w-6 text-white" />
                </div>
                <div>
                    <h3 className="font-semibold text-white">
                        Asisten Dekatku
                    </h3>
                    <p className="text-xs text-white/80">Online</p>
                </div>
            </div>
            <div className="flex items-center gap-2">
                <button
                    onClick={onClear}
                    className="rounded px-2 py-1 text-xs text-white/80 transition-colors hover:bg-white/10 hover:text-white"
                >
                    Clear
                </button>
                <button
                    onClick={onClose}
                    className="text-white/80 transition-colors hover:text-white"
                >
                    <X className="h-5 w-5" />
                </button>
            </div>
        </div>
    );
}
