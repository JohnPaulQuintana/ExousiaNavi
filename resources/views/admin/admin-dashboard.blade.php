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

            // custom popups
            function notifyPopUps(message){
                    // Set Toastr options
                    toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": 300,
                            "hideDuration": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000,
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr['info'](message);
                }

            function getNotification(){
                    // Make the AJAX request with CSRF token in headers
                    // Get the CSRF token from the hidden input field
                    var csrfToken = $('#csrf-token').val();
                    $.ajax({
                        type: "GET",
                        url: "/updates",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken
                        },
                        success: function (response) {
                            // Handle the AJAX response here
                            console.log(response.updates.length);
                            var notifHtml = ''
                            // Using a conditional statement
                            if (response.updates.length > 0) {
                                $('noti-dot').css({'display':'block'})
                                $('updates-btn').css({'display':'block'})
                                response.updates.forEach(notif => {
                                    notifyPopUps(`New updates availables`)
                                    let classToApply;
                                    // Determine the class based on the action
                                    if (notif.action === 'added') {
                                        classToApply = 'text-primary'; // Or any other class you want to apply
                                    } else if (notif.action === 'deleted') {
                                        classToApply = 'text-danger'; // Or another class
                                    } else if (notif.action === 'updated') {
                                        classToApply = 'text-warning'; // Or another class
                                    }
                                    notifHtml += `
                                    <a class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('icons/update.png') }}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1 ${classToApply}">${notif.from}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> ${notif.list}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>`
                                });
                                $('.notif-container').html(notifHtml)

                                // $('.notification-item').on("click", function(){
                                // //    alert($(this).data('id'))
                                // //    updateNotif($(this).data('id'));
                                // })

                            } else {
                                // The response is empty or falsy
                                // console.log("Response is empty or falsy:", response);
                                $('.noti-dot').css({'display':'none'})
                                $('.updates-btn').css({'display':'none'})
                            }
                        },
                        error: function (error) {
                            // Handle AJAX error here
                            console.error(error);
                        }
                    });
                }
                getNotification()
        </script>
    </body>

</html>