/* eslint-disable @typescript-eslint/no-unused-vars */
import { Message } from '@/types/chat-bot';
import { router } from '@inertiajs/react';
import { Bot, User } from 'lucide-react';
import ReactMarkdown from 'react-markdown';
import remarkGfm from 'remark-gfm';

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
                className={`${isUser ? 'max-w-[75%] items-end' : 'max-w-full items-start'} flex flex-col gap-1`}
            >
                <div
                    className={`rounded-2xl px-4 py-2.5 ${
                        isUser
                            ? 'bg-gradient-to-br from-sky-500 via-purple-400 to-pink-500 text-white'
                            : 'bg-zinc-800 text-zinc-100'
                    }`}
                >
                    {isUser ? (
                        <p className="text-sm leading-relaxed whitespace-pre-wrap">
                            {message.content}
                        </p>
                    ) : (
                        <div className="prose prose-invert prose-sm max-w-none [&_a]:cursor-pointer [&_a]:text-sky-300 [&_a]:underline [&_a]:hover:text-sky-200 [&_code]:rounded [&_code]:bg-zinc-700 [&_code]:px-1 [&_code]:py-0.5 [&_code]:text-sm [&_li]:text-zinc-100 [&_ol]:space-y-1 [&_p]:mb-2 [&_p]:leading-relaxed [&_p]:text-zinc-100 [&_pre]:overflow-x-auto [&_pre]:rounded [&_pre]:bg-zinc-700 [&_pre]:p-2 [&_strong]:font-semibold [&_strong]:text-white [&_ul]:space-y-1">
                            <ReactMarkdown
                                remarkPlugins={[remarkGfm]}
                                components={{
                                    a: ({ node, ...props }) => {
                                        const href = props.href || '';

                                        if (!href.startsWith('/')) {
                                            return (
                                                <span className="text-zinc-400">
                                                    {props.children}
                                                </span>
                                            );
                                        }

                                        return (
                                            <a
                                                className="cursor-pointer text-sky-300 underline hover:text-sky-200"
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    router.visit(href);
                                                }}
                                            >
                                                {props.children}
                                            </a>
                                        );
                                    },

                                    script: () => null,
                                    iframe: () => null,
                                    object: () => null,
                                    embed: () => null,

                                    strong: ({ node, ...props }) => (
                                        <strong
                                            className="font-semibold text-white"
                                            {...props}
                                        />
                                    ),

                                    ul: ({ node, ...props }) => (
                                        <ul
                                            className="my-2 list-inside list-disc space-y-1"
                                            {...props}
                                        />
                                    ),

                                    ol: ({ node, ...props }) => (
                                        <ol
                                            className="my-2 list-inside list-decimal space-y-1"
                                            {...props}
                                        />
                                    ),

                                    img: ({ node, ...props }) => {
                                        const src = props.src || '';
                                        if (
                                            !src.startsWith('/') &&
                                            !src.startsWith(
                                                window.location.origin,
                                            )
                                        ) {
                                            return null;
                                        }
                                        return (
                                            <img
                                                {...props}
                                                className="my-2 h-auto max-w-full rounded"
                                                alt={props.alt || ''}
                                            />
                                        );
                                    },

                                    table: ({ node, ...props }) => (
                                        <div className="my-2 overflow-x-auto">
                                            <table
                                                {...props}
                                                className="w-full border-collapse text-sm"
                                            />
                                        </div>
                                    ),
                                    thead: ({ node, ...props }) => (
                                        <thead
                                            {...props}
                                            className="bg-zinc-700/50"
                                        />
                                    ),
                                    tbody: ({ node, ...props }) => (
                                        <tbody {...props} />
                                    ),
                                    tr: ({ node, ...props }) => (
                                        <tr
                                            {...props}
                                            className="border-b border-zinc-700"
                                        />
                                    ),
                                    th: ({ node, ...props }) => (
                                        <th
                                            {...props}
                                            className="px-3 py-2 text-left font-semibold"
                                        />
                                    ),
                                    td: ({ node, ...props }) => (
                                        <td {...props} className="px-3 py-2" />
                                    ),
                                }}
                            >
                                {message.content}
                            </ReactMarkdown>
                        </div>
                    )}
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
