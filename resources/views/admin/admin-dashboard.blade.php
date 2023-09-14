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
    </body>

</html>