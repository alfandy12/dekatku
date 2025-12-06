<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Informasi Toko
        </x-slot>

        <x-slot name="description">
            Detail informasi toko Anda
        </x-slot>

        <div class="space-y-4">
            @foreach ($storeData as $info)
                <div class="flex items-start gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-100 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400">
                        <x-filament::icon
                            :icon="$info['icon']"
                            class="h-5 w-5"
                        />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $info['label'] }}
                        </p>
                        <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $info['value'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>