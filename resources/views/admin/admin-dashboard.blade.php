<!doctype html>
<html lang="en">

    <head>
        @yield('links')
    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        @include('admin.loaderPage.preloader')
        <!-- Begin page -->
        <div id="layout-wrapper">

            
            @include('admin.contents.header')

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                @include('admin.contents.sidebar')
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('content')
                <!-- End Page-content -->
               
                <footer class="footer">
                    @include('admin.body.footer')
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            @include('admin.contents.right-sidebar')
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        @yield('scripts')

        {{-- pusher events --}}
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('4ef07d09e997c8b8f24b', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('update-system');
            channel.bind('initialize-updates', function(data) {
            console.log(JSON.stringify(data));
            });
        </script>
    </body>

</html>