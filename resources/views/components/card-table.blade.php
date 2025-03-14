<div class="max-w-8xl pl-5 mt-6 sm:px-6 lg:px-8 transform ">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-black">
                {{ $title }}
            </h4>
            <div class="flex space-x-3">
                <input type="text" id="search" placeholder="Search..." 
                       class="border border-gray-300 dark:border-gray-600 px-3 py-1 rounded text-sm focus:ring">
                @if($buttonText && $buttonLink)
                    <a href="{{ url($buttonLink) }}" 
                       class="btn btn-primary px-4 py-2 hover:bg-blue-300 text-white text-xs font-medium rounded">
                        {{ $buttonText }}
                    </a>
                @endif
            </div>
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-300">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-black">
                        <tr>
                            {{ $headers }}
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search");
        const tableBody = document.getElementById("tableBody");

        searchInput.addEventListener("input", function () {
            const searchText = searchInput.value.toLowerCase();
            const rows = tableBody.getElementsByTagName("tr");

            for (let row of rows) {
                const cells = row.getElementsByTagName("td");
                let found = false;

                for (let cell of cells) {
                    if (cell.textContent.toLowerCase().includes(searchText)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? "" : "none";
            }
        });
    });
</script>
