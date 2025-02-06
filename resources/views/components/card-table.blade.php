<div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-black">
                {{ $title }}
            </h4>
            @if($buttonText && $buttonLink)
                <a href="{{ url($buttonLink) }}" 
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    {{ $buttonText }}
                </a>
            @endif
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-300">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-black">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                            <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
                            <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
