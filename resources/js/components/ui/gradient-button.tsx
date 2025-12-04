import { cn } from "@/lib/utils";
import { ReactNode } from "react";


export default function GradientButton({children, className}: {children: ReactNode, className?: string}) {
    return (
        <button className={cn('inter-500 10 rounded-xl border-t-2 border-l-2 bg-gradient-to-br from-sky-500 via-purple-500 to-pink-500 p-5', className)}>
            {children}
        </button>
    )
}