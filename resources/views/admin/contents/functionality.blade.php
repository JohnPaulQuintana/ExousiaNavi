@extends('admin.admin-dashboard')

@section('links')
    <meta charset="utf-8" />
    <title>Dashboard | Exousia Navi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    {{-- toast css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">
    {{-- {{ asset('backend/') }} --}}
    <!-- jquery.vectormap css -->
    <link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Exousia Navi</a></li>
                                <li class="breadcrumb-item active">Functionalities</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                {{-- {{ $systems[0]->function }} --}}
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Manage Authentication</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        @php
                                            $auth =  $systems[2]->status;
                                            if (!$auth) {
                                                $className = 'text-danger';
                                                $text = "Offline";
                                            }else{
                                                $className = 'text-info';
                                                $text = "Online";
                                            }
                                        @endphp
                                        <tr class="text-center {{ $className }}">
                                            <th>User Authentication is <span>{{ $text }}</span></th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="card" style="width: 10rem; margin:auto;">
                                                    <img src="{{ asset('icons/auth.png') }}" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        @php
                                                            $auth =  $systems[2]->status;
                                                            if (!$auth) {
                                                                $className = 'btn-info';
                                                                $text = "Enabled";
                                                            }else{
                                                                $className = 'btn-danger';
                                                                $text = "Disabled";
                                                            }
                                                        @endphp
                                                        <button type="button" class="btn {{ $className }} form-control btn-system" data-action="{{ $systems[2]->status  }}" data-id="{{ $systems[2]->id }}">{{ $text }}</button>
                                                      {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                    </div>
                                                  </div>
                                            </td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Speech Recognition</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        @php
                                            $auth =  $systems[0]->status;
                                            if (!$auth) {
                                                $className = 'text-danger';
                                                $text = "Offline";
                                            }else{
                                                $className = 'text-info';
                                                $text = "Online";
                                            }
                                        @endphp
                                        <tr class="text-center {{ $className }}">
                                            <th>Speech Recognition is <span>{{ $text }}</span></th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="card" style="width: 10rem; margin:auto;">
                                                    <img src="{{ asset('icons/speech.png') }}" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        @php
                                                            $auth =  $systems[0]->status;
                                                            if (!$auth) {
                                                                $className = 'btn-info';
                                                                $text = "Enabled";
                                                            }else{
                                                                $className = 'btn-danger';
                                                                $text = "Disabled";
                                                            }
                                                        @endphp
                                                        <button type="button" class="btn {{ $className }} form-control btn-system" data-action="{{ $systems[0]->status  }}" data-id="{{ $systems[0]->id }}">{{ $text }}</button>
                                                      {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                    </div>
                                                  </div>
                                            </td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Manage Input Box</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        @php
                                            $auth =  $systems[1]->status;
                                            if (!$auth) {
                                                $className = 'text-danger';
                                                $text = "Offline";
                                            }else{
                                                $className = 'text-info';
                                                $text = "Online";
                                            }
                                        @endphp
                                        <tr class="text-center {{ $className }}">
                                            <th>Input query is <span>{{ $text }}</span></th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="card" style="width: 10rem; margin:auto;">
                                                    <img src="{{ asset('icons/text.png') }}" class="card-img-top" alt="...">
                                                    <div class="card-body">
                                                        @php
                                                            $auth =  $systems[1]->status;
                                                            if (!$auth) {
                                                                $className = 'btn-info';
                                                                $text = "Enabled";
                                                            }else{
                                                                $className = 'btn-danger';
                                                                $text = "Disabled";
                                                            }
                                                        @endphp
                                                        <button type="button" class="btn {{ $className }} form-control btn-system" data-action="{{ $systems[1]->status  }}" data-id="{{ $systems[1]->id }}">{{ $text }}</button>
                                                      {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                    </div>
                                                  </div>
                                            </td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            
        </div>

    </div>
@endsection

@section('scripts')
    <!-- JAVASCRIPT -->

    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>


    <!-- apexcharts -->
    {{-- <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- jquery.vectormap map -->
    <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    {{-- <script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script> --}}

    <!-- toastr plugin -->
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function(){
            $(document).on('click','.btn-system',function(){
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: "/functionality-updates",
                        data:{id:$(this).data('id'), action:$(this).data('action')},
                        headers: {
                            "X-CSRF-TOKEN": csrfToken
                        },
                        success: function (response) {
                                // alert(response.message)
                                location.reload();
                            
                        }
                    })
                // alert($(this).data('id'));
            })
        })
    </script>
@endsection
