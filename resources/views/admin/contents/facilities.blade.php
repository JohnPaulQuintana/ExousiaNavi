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
                                <li class="breadcrumb-item active">Facilitie's</li>
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
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                </div>
                            </div>

                            <h4 class="card-title mb-4">Manage Faciltie's Information</h4>

                            <div class="table-responsive">
                                <form action="{{ route('bulk.manage.facilities') }}" method="POST">
                                    @csrf
                                    <input type="text" name="action" value="add" id="action" hidden>
                                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Facility</th>
                                                <th>Operation</th>
                                                <th>floor</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="teachers-table">
                                            <tr>
                                                <td>
                                                    <h6 class="font-size-13">
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                                        <span class="text-secondary">Please Enter your facility.</span>
                                                        <input type="text" name="facilities[]"
                                                            class="form-control text-white mt-2 add-input"
                                                            placeholder="Library" required>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="font-size-13">
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                                        <span class="text-secondary">Please Enter your operation time.</span>
                                                        <input type="text" name="operation_hours[]"
                                                            class="form-control text-white mt-2" placeholder="08:00 AM" required>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="font-size-13">
                                                        <i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                                        <span class="text-secondary">Please Select your Floor.</span>
                                                        <select name="selected_floor[]" class="form-control text-white mt-2" required>
                                                            <option value="" disabled selected>Select a Floor</option>
                                                            @for ($floor = 0; $floor <= 10; $floor++)
                                                                <option value="{{ $floor === 0 ? 'ground-floor' : 'floor-' . $floor }}">
                                                                    {{ $floor === 0 ? 'Ground Floor' : 'Floor ' . $floor }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table> <!-- end table -->
                                    <button type="button" class="btn btn-secondary" id="addInputField">Add Input
                                        Field</button>
                                    <button type="submit" class="btn btn-primary" id="saveTeacher">Save</button>
                                </form>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dropdown float-end">
                                <input type="text" class="dropdown-toggle form-control arrow-none search" placeholder="Search Facilities..." id="search-input" />
                            </div>

                            <h4 class="card-title mb-4">Update Facilitie's Information</h4>

                            <div class="table-responsive">
                                <form action="{{ route('bulk.manage.facilities') }}" method="POST">
                                    @csrf
                                    <input type="text" name="action" value="update" id="action" hidden>
                                    <table id="facility-table" class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Facility</th>
                                                <th>Operation</th>
                                                <th>floor</th>
                                                {{-- <th width='30'>Action</th> --}}
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="teachers-table-edit">
                                            @foreach ($facilities as $facility)
                                                <input type="number" name="ids[]" value="{{ $facility->id }}" hidden>
                                                <tr>
                                                    <td>
                                                        <h6 class="font-size-13">

                                                            <span class="text-secondary"><span
                                                                    class="text-danger">Update</span> facility.</span>
                                                            <div class="input-group align-items-center text-danger">
                                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                <input type="text" name="facilities[]"
                                                                    class="form-control text-white mt-2 edit-input"
                                                                    value="{{ $facility->facilities }}">

                                                            </div>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="font-size-13">

                                                            <span class="text-secondary"><span
                                                                    class="text-danger">Update</span> Operation_Hours.</span>
                                                            <div class="input-group align-items-center text-danger">
                                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                <input type="text" name="operation_hours[]"
                                                                    class="form-control text-white mt-2 edit-input"
                                                                    placeholder="who is navi team?"
                                                                    value="{{ $facility->operation_time }}">

                                                            </div>
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="font-size-13">

                                                            <span class="text-secondary"><span
                                                                    class="text-danger">Update</span> Floor.</span>
                                                            <div class="input-group align-items-center text-danger">
                                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                <input type="text" name="selected_floor[]"
                                                                    class="form-control text-white mt-2 edit-input"
                                                                    placeholder="who is navi team?"
                                                                    value="{{ $facility->floor }}">

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

                                    <button type="submit" class="btn btn-danger" id="editTeachers">Update
                                        Teachers</button>
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
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    {{-- custom --}}
    <script>
        $(document).ready(function() {
            $('#editTeachers').prop('disabled', true);
            // Add product
            $("#addInputField").on("click", function() {
                var newRow = `  
                    <tr>
                        <td>
                            <h6 class="font-size-13">
                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                <span class="text-secondary">Please Enter your facility.</span>
                                <input type="text" name="facilities[]"
                                    class="form-control text-white mt-2 add-input"
                                    placeholder="Library" required>
                            </h6>
                        </td>
                        <td>
                            <h6 class="font-size-13">
                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                <span class="text-secondary">Please Enter your operation time.</span>
                                <input type="text" name="operation_hours[]"
                                    class="form-control text-white mt-2" placeholder="08:00 AM" required>
                            </h6>
                        </td>
                        <td>
                            <h6 class="font-size-13">
                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                                <span class="text-secondary">Please Select your Floor.</span>
                                <div class="input-group d-flex align-items-center text-danger">
                                    <select name="selected_floor[]" class="form-control text-white mt-2" required>
                                            <option value="" disabled selected>Select a Floor</option>
                                        @for ($floor = 0; $floor <= 10; $floor++)
                                            <option value="{{ $floor === 0 ? 'ground-floor' : 'floor-' . $floor }}">
                                                {{ $floor === 0 ? 'Ground Floor' : 'Floor ' . $floor }}
                                            </option>
                                        @endfor
                                    </select>
                                    <i class="text-danger h3 fas fa-times delete-row" style="margin:15px auto 10px 10px;"></i>
                                </div>   
                            </h6>
                        </td>
                    </tr>`;

                $("#teachers-table").append(newRow);

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
            $("#teachers-table-edit").on("change", ".edit-input", function() {
                makeEditable(this);
            });

            $("#teachers-table-edit").on("click", ".cancel-edit", function() {
                $('#editTeachers').prop('disabled', true);
                const parentDiv = $(this).closest(".input-group");
                const customIcon = `<i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>`;
                const originalHTML = customIcon+parentDiv.data("original-html");
                console.log(originalHTML)
            
                parentDiv.html(originalHTML);
            });

            // search
            $('#search-input').on('input', function() {
                const searchText = $(this).val().trim().toLowerCase();
                $('#teachers-table-edit tr').each(function() {
                    const row = $(this);
                    const inputs = row.find('input.edit-input'); // Adjust the selector as needed

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

            function makeEditable(element) {
                $('#editTeachers').prop('disabled', false);
                const originalName = $(element).attr("name");
                const isInput = true; // Since it's an input field
                const selectedOption = $(element);
                // console.log("originalName:", originalName);
                // console.log("selectedOption:", selectedOption.val());
                if (selectedOption.val() !== "") {
                    const originalHTML = $(element).prop("outerHTML");
                    if(!$(element).hasClass("edited")){
                        $(element).replaceWith(
                        `
                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>
                            <input type="text" name="${originalName}"
                                class="form-control text-white mt-2 edited edit-input"
                                placeholder="who is navi team?"
                                value="${selectedOption.val()}">
                            <i class="text-danger h3 fas fa-times cancel-edit" style="margin:15px auto 10px 10px;"></i>
                        
                        `);
                    }else{
                        $(element).removeClass('edited')
                    }
                    const parentDiv = $(`[name='${originalName}']`).closest(".input-group");
                    parentDiv.data("original-html", originalHTML);

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
