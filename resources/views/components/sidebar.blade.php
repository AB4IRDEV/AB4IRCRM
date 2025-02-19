<aside class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <img src="{{ asset('ab4irlogo.png') }}" alt="logo" class="w-10 h-10">
        
    </div>

    <!-- Sidebar Links -->
    <ul class="sidebar-links">
        @foreach ($menus as $section => $items)
            <h4>
                <span>{{ $section }}</span>
                <div class="menu-separator"></div>
            </h4>
            

            @foreach ($items as $item)
            <li>
                <a href="{{ route($item['route']) }}" 
                   class="flex items-center px-4 py-2 mb-2 rounded-lg hover:bg-gray-700">
                    <span class="material-symbols-outlined mr-3 text-lg">{{ $item['icon'] }}</span>
                    {{ $item['name'] }}
                </a>
            </li>
            @endforeach
        @endforeach
        </ul>

    <!-- User Account Section -->
    <div class="user-account">
        <div class="user-profile">
            <img src="{{ 'storage/'  . $user->file}}" alt="Profile" >
            <div class="user-detail">
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
