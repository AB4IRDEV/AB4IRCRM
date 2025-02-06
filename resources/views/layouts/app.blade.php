<x-head> 
</x-head>
@include('layouts.navbar')

<x-sidebar/>
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
