<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <span class="text-lg font-semibold">Aksi Cepat</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">Akses cepat ke fitur yang sering digunakan</span>
            </div>
        </x-slot>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($this->getActions() as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="group relative flex flex-col items-center justify-center gap-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 p-6 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:border-{{ $action['color'] }}-400 dark:hover:border-{{ $action['color'] }}-500"
                >
                    <!-- Icon -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-{{ $action['color'] }}-400 dark:bg-{{ $action['color'] }}-500 rounded-xl blur-lg opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-xl bg-{{ $action['color'] }}-100 dark:bg-{{ $action['color'] }}-500/20 text-{{ $action['color'] }}-600 dark:text-{{ $action['color'] }}-400 group-hover:bg-{{ $action['color'] }}-500 group-hover:text-white transition-all duration-300 group-hover:rotate-6 group-hover:scale-110">
                            <x-filament::icon
                                :icon="$action['icon']"
                                class="h-7 w-7"
                            />
                        </div>
                    </div>
                    
                    <!-- Label -->
                    <div class="text-center space-y-1">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-{{ $action['color'] }}-600 dark:group-hover:text-{{ $action['color'] }}-400 transition-colors">
                            {{ $action['label'] }}
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                            {{ $action['description'] }}
                        </p>
                    </div>

                    <!-- Hover Arrow -->
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-{{ $action['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>