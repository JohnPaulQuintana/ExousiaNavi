@extends('admin.admin-dashboard')

@section('links')
    <meta charset="utf-8" />
    <title>Dashboard | Exousia Navi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    {{-- toast css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/toastr/build/toastr.min.css') }}">
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
                                <li class="breadcrumb-item active">Tables</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dropdown float-end">
                                <div class="input-group"> <!-- Wrap the input and button in an input group -->
                                    <input type="text" class="form-control arrow-none search" placeholder="Search Teachers..." id="search-input" />
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="{{ route($going) }}" class="dropdown-item">
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                            Manage
                                        </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item text-danger" disabled>
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                            Event's
                                        </a>
                                    </div>
                                </div>
                            </div>
                            

                            <h4 class="card-title mb-4 text-capitalize">{{ $title }} Information</h4>
                            <div class="table-responsive">
                                <form action="{{ route('bulk.manage.teachers') }}" method="POST">
                                    @csrf
                                    <input type="text" name="teachers_name[]" value="0" hidden>
                                    <input type="text" name="ids[]" value="" id="delete_id" hidden>
                                    <input type="text" name="action" value="{{ $actions }}" id="action" hidden>
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr class="text-capitalize">
                                                @foreach ($columns as $column)
                                                    <th>{{ $column }}</th>
                                                @endforeach
                                                <th>Select</th>
                                                {{-- <th>Destroy</th> --}}
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="teachers-table" class="text-capitalize">
                                            @foreach ($datas as $data)
                                                <tr>
                                                    @foreach ($columns as $column)
                                                        <td>
                                                            <h6 class="font-size-13">
                                                                <div class="input-group align-items-center text-danger">
                                                                    <i
                                                                        class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                    <input type="text"
                                                                        class="form-control mt-2 text-capitalize srh"
                                                                        value="{{ $data->$column }}" readonly>
                                                                </div>
                                                            </h6>
                                                        </td>
                                                    @endforeach
                                                    <td class="text-center" width="100">
                                                        <div class="form-check form-switch mt-1 h4" dir="ltr">
                                                            <input type="checkbox" class="form-check-input custom-switch srh"
                                                                id="customSwitch1" data-id="{{ $data->id }}">
                                                        </div>
                                                    </td>
                                                    {{-- <td class="text-center" width="50">
                                                        <h6 class="font-size-13" style="margin-top: 20px;">
                                                            <i class="text-danger h4 dripicons-trash delete-row" data-id="{{ $data->id }}"></i>
                                                        </h6>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                            <!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table> <!-- end table -->
                                    <div class="d-flex justify-content-end me-4">
                                        {{-- <i type="submit" class="text-danger h3 dripicons-trash delete-row" id="delete"></i> --}}
                                        <button type="submit" class="btn me-3" id="delete"
                                            style="display: none;">
                                            <i class="text-danger h3 dripicons-trash"></i>
                                        </button>
                                    </div>


                                </form>
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
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

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

    <script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            var ids = []
            $('.custom-switch').on('change', function() {
                var dataId = $(this).data('id');
                if ($(this).is(':checked')) {
                    ids.push(dataId)
                    console.log(ids);
                    $('#delete').show();
                    // You can perform additional actions with the data-id value here
                } else {
                    // Remove data-id from the array when the checkbox is unchecked
                    ids = ids.filter(function(value) {
                        return value !== dataId;
                    });
                    console.log(ids); // Log the updated array of data-ids
                    // You can handle additional actions when the checkbox is unchecked if needed
                    if (ids.length === 0) {
                        $('#delete').hide(); // Hide the button if no checkboxes are checked
                    }
                }
                $('#delete_id').val(ids.join(',')); // Set the value as a comma-separated string
            });

            // search
            $('#search-input').on('input', function() {
                const searchText = $(this).val().trim().toLowerCase();
                $('#teachers-table tr').each(function() {
                    const row = $(this);
                    const inputs = row.find('input.srh'); // Adjust the selector as needed

                    // Check if any of the input fields contain the search text
                    const matches = inputs.filter(function() {
                        const inputValue = $(this).val().toLowerCase();
                        return inputValue.includes(searchText);
                    }).length > 0;

                    if (matches) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
            // Function to set the value of the ids[] input field when the form is submitted
            // $('form').submit(function () {
            //     alert('yes')
            //     $('#delete_id').val(ids.join(',')); // Set the value as a comma-separated string
            // });
        });
    </script>

    {{-- // notification --}}
    @if (session()->has('notification'))
        <script>
            $(document).ready(function() {
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
                var notificationJson = {!! json_encode(session('notification')) !!};
                var notification = JSON.parse(notificationJson);
                console.log(notification)
                toastr[notification.status](notification.message);
            });
        </script>
    @endif
@endsection
