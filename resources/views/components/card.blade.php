<div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h4 class="text-lg font-semibold text-gray-800 dark:te">
                {{ $title }}
            </h4>
            @if($buttonText && $buttonLink)
                <a href="{{ url($buttonLink) }}" 
                   class="px-4 py-2 bg-yellow-300 hover:bg-red-700 text-white text-sm font-medium no-underline rounded-lg transition">
                    {{ $buttonText }}
                </a>
            @endif
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-300">
            {{ $slot }}
        </div>
    </div>
</div>
