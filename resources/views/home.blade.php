<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('home.header')
    
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @include('home.links')

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                @yield('contents')

                {{-- footer --}}
                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    @include('home.footer')
                </div>
            </div>
        </div>
    </body>
</html>
