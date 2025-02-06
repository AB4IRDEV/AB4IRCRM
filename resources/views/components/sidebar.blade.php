<aside class="w-64 bg-black text-white h-screen flex flex-col absolute z-10">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center py-4 border-b border-gray-700  ">
        <img src="{{ asset('ab4irlogo.png') }}" alt="logo" class="w-10 h-10">
        
    </div>

    <!-- Sidebar Links -->
    <nav class="flex-1 px-4 py-4 overflow-y-auto">
        @foreach ($menus as $section => $items)
            <h4 class="text-xs uppercase font-semibold text-gray-400 mb-2">{{ $section }}</h4>
            <div class="border-b border-gray-700 mb-2"></div>

            @foreach ($items as $item)
                <a href="{{ route($item['route']) }}" 
                   class="flex items-center px-4 py-2 mb-2 rounded-lg hover:bg-gray-700">
                    <span class="material-symbols-outlined mr-3 text-lg">{{ $item['icon'] }}</span>
                    <span class="text-sm">{{ $item['name'] }}</span>
                </a>
            @endforeach
        @endforeach
    </nav>

    <!-- User Account Section -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center">
            <img src="{{ asset('profile-img.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full">
            <div class="ml-3">
                <h3 class="text-sm font-semibold">{{ $user->name ?? 'Guest' }}</h3>
                <span class="text-xs text-gray-400">{{ $user->role ?? 'User' }}</span>
            </div>
        </div>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" 
                class="w-full flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded">
                <span class="material-symbols-outlined mr-2">logout</span> Logout
            </button>
        </form>
    </div>
</aside>
