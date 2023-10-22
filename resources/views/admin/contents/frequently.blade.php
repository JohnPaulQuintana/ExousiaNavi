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
                                <li class="breadcrumb-item active">Frequently Ask</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Teacher's</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Facilities</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Event's</a>
                                </div>
                            </div>

                            <h4 class="card-title mb-4">Frequently Ask Questions</h4>

                            <div class="table-responsive">
                                <form action="{{ route('bulk.manage.frequently') }}" method="POST">
                                    @csrf
                                    <input type="text" name="action" value="add" id="action" hidden>
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Manage Your Question</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="frequently-table">
                                            <tr>
                                                <td>
                                                    <h6 class="font-size-13">
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                                        <span class="text-secondary">Please Enter your frequently
                                                            question.</span>
                                                        <input type="text" name="frequently_ask[]"
                                                            class="form-control text-white mt-2"
                                                            placeholder="who is navi team?">
                                                    </h6>
                                                </td>
                                            </tr>
                                            <!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table> <!-- end table -->
                                    <button type="button" class="btn btn-secondary" id="addInputField">Add Input
                                        Field</button>
                                    <button type="submit" class="btn btn-primary" id="saveFrequently">Save
                                        Question</button>
                                </form>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">
                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                Deployed Questions</h4>

                            <div class="table-responsive">
                                <form action="{{ route('bulk.manage.frequently') }}" method="POST">
                                    @csrf
                                    <input type="text" name="action" value="update" id="action" hidden>
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Manage Your Questions</th>
                                                {{-- <th width='30'>Action</th> --}}
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="frequently-table-edit">
                                            @foreach ($frequentlies as $frequently)
                                                <input type="number" name="ids[]"
                                                    value="{{ $frequently->id }}" hidden>
                                                <tr>
                                                    <td>
                                                        <h6 class="font-size-13">

                                                            <span class="text-secondary"><span
                                                                    class="text-danger">Update</span> your frequently
                                                                question.</span>
                                                            <div class="input-group align-items-center text-danger">
                                                                <i
                                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                <input type="text" name="frequently_ask[]"
                                                                    class="form-control text-white mt-2 edit-input"
                                                                    placeholder="who is navi team?"
                                                                    value="{{ $frequently->frequently }}">

                                                            </div>
                                                        </h6>
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <h6 class="font-size-13" style="margin-top: 20px;">
                                                            <i class="text-danger h3 dripicons-trash delete-row"></i>
                                                            <input type="checkbox" id="myCheckbox" name="myCheckbox" value="checkboxValue">

                                                        </h6>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                            <!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table> <!-- end table -->

                                    <button type="submit" class="btn btn-danger" id="editFrequently">Update
                                        Question</button>
                                </form>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

           
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

    {{-- custom --}}
    <script>
        $(document).ready(function() {
            // Add product
            $("#addInputField").on("click", function() {
                var newRow = `  <tr>
                                    <td>
                                        <h6 class="font-size-13">
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                            <span class="text-secondary">Please Enter your frequently question.</span>
                                            <div class="input-group d-flex align-items-center text-danger">
                                                <input type="text" name="frequently_ask[]" class="form-control text-white mt-2"
                                                placeholder="who is navi team?">
                                                <i class="text-danger h3 fas fa-times delete-row" style="margin:15px auto 10px 10px;"></i>
                                            </div>
                                        </h6>
                                    </td>
                                    
                                </tr>`;

                $("#frequently-table").append(newRow);

                // Add event listener to delete buttons
                $('.delete-row').click(function() {
                    $(this).closest('tr').remove(); // Remove the closest <tr> element
                });

                // Editable input/select functionality using jQuery
                // $("#addInputField").on("change", ".custom-select", function() {
                //     makeEditable(this);
                // });
            });

            // Editable input/select functionality using jQuery
            $("#frequently-table-edit").on("change", ".edit-input", function() {
                makeEditable(this);
            });

            $("#frequently-table-edit").on("click", ".cancel-edit", function() {
                const parentDiv = $(this).closest(".input-group");
                const originalHTML = parentDiv.data("original-html");
                parentDiv.html(originalHTML);
            });

            function makeEditable(element) {
                const originalName = $(element).attr("name");
                const isInput = true; // Since it's an input field
                const selectedOption = $(element);
                // console.log("originalName:", originalName);
                // console.log("selectedOption:", selectedOption.val());
                if (selectedOption.val() !== "") {
                    const originalHTML = `
                        <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                        <input type="text" name="frequently_ask[]"
                            class="form-control text-white mt-2 edit-input"
                            placeholder="who is navi team?" value="{{ $frequently->frequently }}">
                    `
                    console.log(originalHTML)
                    $(element).closest('tr').replaceWith(
                        `<tr>
                            <td>
                                <h6 class="font-size-13">
                                    <span class="text-secondary"><span class="text-danger">Update</span> your frequently question.</span>
                                    <div class="input-group align-items-center">
                                        <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                        <input type="text" class="form-control text-white mt-2 edit-input" name="${originalName}" value="${selectedOption.val()}">
                                        <i class="text-danger h3 fas fa-times cancel-edit" style="margin:15px auto 10px 10px;"></i>    
                                    </div>
                                </h6>
                            </td>
                        </tr>`);
                    const parentDiv = $(`[name='${originalName}']`).closest(".input-group");
                    parentDiv.data("original-html", originalHTML);

                    // Set input width based on value length
                    $("#editFrequently").on("input", "[name='${originalName}']", function() {
                        const input = $(this);
                        const valueLength = input.val().length;
                        input.css("width", `${valueLength}px`); // Adjust the multiplier as needed
                    });
                }
            }
        })
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
