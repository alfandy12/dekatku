export default function StoreSkeleton() {
    return (
        <div className="overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/0 p-6 backdrop-blur-sm">
            <div className="mb-4 flex items-start gap-4">
                <div className="h-16 w-16 flex-shrink-0 animate-pulse rounded-full bg-white/10" />
                <div className="flex-1 space-y-2">
                    <div className="h-6 w-2/3 animate-pulse rounded bg-white/10" />
                    <div className="h-4 w-1/3 animate-pulse rounded bg-white/10" />
                </div>
            </div>

            <div className="mb-4 space-y-2">
                <div className="h-4 w-full animate-pulse rounded bg-white/10" />
                <div className="h-4 w-4/5 animate-pulse rounded bg-white/10" />
            </div>
            <div className="grid grid-cols-3 gap-2">
                {[1, 2, 3].map((i) => (
                    <div
                        key={i}
                        className="aspect-[4/3] animate-pulse rounded-lg bg-white/10"
                    />
                ))}
            </div>
        </div>
    );
}