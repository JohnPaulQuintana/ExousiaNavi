<!DOCTYPE html>
<html lang="en">
@include('navi.components.header')

@yield('links')


<body>
    
    {{-- @include('navi.loaderPage.preloader') --}}
    {{-- <div class="contents-wrapper"> --}}
    @yield('contents')
    {{-- </div> --}}
    @yield('scripts')


</body>

</html>
