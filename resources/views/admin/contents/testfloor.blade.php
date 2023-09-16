@extends('admin.admin-dashboard')

@section('links')
    <meta charset="utf-8" />
    <title>Dashboard | Exousia Navi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <style>
        /* Style for the grid container */
        .grid-container {
            padding: 10px;
            width: fit-content;
            /* Adjust the width of the floorplan */
            height: fit-content;
            /* Adjust the height of the floorplan */
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /* margin: 50px auto; */
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            /* Adjust the number of columns */
            grid-template-rows: repeat(4, 1fr);
            /* Adjust the number of rows */
            gap: 5px;
            /* Adjust the gap between rooms */
            background-color: transparent;
            /* Background color for the floorplan */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            /* Add a subtle shadow */
            border-radius: 10px;
            /* Add rounded corners */
            perspective: 1000px;
            /* Create perspective for 3D effect */
            z-index: 1000;
        }

        /* Style for each room (grid point) */
        .grid-point {
            width: 80px;
            height: 80px;
            background-color: transparent;
            /* Light background color for rooms */
            border: 1px solid rgba(0, 0, 0, 0.3);
            ;
            /* Add borders */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            /* Specify a common font */
            font-size: 16px;
            /* Adjust font size */
            color: #f3ecec;
            /* Text color */
            position: relative;
            transition: transform 0.3s ease-in-out;
            /* Add smooth transform transition */
            transform-style: preserve-3d;
            /* Preserve 3D effect */
            z-index: 1;
        }

        /* Add 3D effect on hover */
        .grid-point:hover {
            transform: translateZ(10px);
            /* Translate along the Z-axis to create elevation */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            /* Add a subtle shadow */
        }

        /* Style for the walls (blocks) */
        .blocked {
            background-color: #999;
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            color: white;
        }

        .grid-point.block::after {
            content: attr(data-label);
            /* Set the content to the data-label attribute */
        }

        /* Style for animation */
        .grid-point.passed {
            background-color: transparent;
            /* Dark green for passed rooms */
            color: white;
            animation: animatePath 4s linear infinite;
            /* Animation settings */
        }

        /* starting point */
        .starting-point {
            background-color: #4434db;
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            color: white;
        }

        /* starting point */
        .targetFacilities {
            background-color: #044214;
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            color: white;
        }

        /* Define the animation */
        @keyframes animatePath {
            0% {
                border: none;
                color: #06df59;
                /* background-color: green; */
                /* transform: translateZ(2px); Translate along the Z-axis to create elevation */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                /* Add a subtle shadow */
            }

            25% {
                /* background-color: rgb(11, 196, 66); */
                /* transform: translateZ(20px); Translate along the Z-axis to create elevation */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                /* Add a subtle shadow */
            }

            50% {
                /* background-color: rgb(15, 226, 61); */
                /* transform: translateZ(5px); Translate along the Z-axis to create elevation */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                /* Add a subtle shadow */
            }

            75% {
                /* background-color: rgb(32, 88, 209); */
                /* transform: translateZ(15px); Translate along the Z-axis to create elevation */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                /* Add a subtle shadow */
            }

            100% {
                /* background-color: green; */
                /* transform: translateZ(10px); Translate along the Z-axis to create elevation */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                /* Add a subtle shadow */
            }
        }
    </style>
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
                                <li class="breadcrumb-item active">Floor Plan Layouts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-2">
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

                            <h4 class="card-title mb-4">Target Facilities</h4>

                            <div class="table-responsive">

                                <h6 class="font-size-13">
                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                    <span class="text-secondary">Available Facilities</span>
                                    <div class="input-group d-flex align-items-center text-success">
                                        <select id="target-selection" class="form-control text-white mt-2">

                                        </select>
                                        {{-- <i class="text-danger h3 fas fa-check delete-row" style="margin:15px auto 10px 10px;"></i> --}}
                                    </div>
                                </h6>

                                <button class="btn btn-secondary mt-2" id="newTarget">Test</button>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- {{ $details }} --}}
                            <h4 class="card-title mb-4">
                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                Testing Phase > <span class="text-success">First Floor</span>
                            </h4>

                            <div class="table-responsive row">
                                {{-- all contents --}}

                                <div class="col-sm-10 mx-auto mb-2 grid-container" id="grid-container">
                                    <!-- Points will be dynamically generated here -->
                                </div>
                
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

    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.10/dist/interact.min.js"></script>
    {{-- custom --}}
    <script>
        $(document).ready(function() {
            var detailInServer = @json($details); // Convert PHP array to JavaScript object
            // Now you have access to the details array, you can manipulate and use it
            var serverResponds = detailInServer[0]['gridDetails'];
            const gridContainer = $("#grid-container");
            let gridPoints = [];
            let startingPoint;
            // Function to create and append points to the grid
            // width and hieght is the row and columns
            // x = horizontal, y = vertical line 
            function createGridPoints(target) {
                var targetFacilities = target;
                var targetSelection = '';
                var targetX = 0;
                var targetY = 0;
                // default starting point
                var startingX = 2;
                var startingY = 9;

                gridContainer.empty(); // Clear the existing grid using jQuery
                serverResponds.forEach(coordinates => {
                    console.log(coordinates)
                    const point = $("<div></div>"); // Create a new div element using jQuery
                    point.addClass("grid-point");
                    point.attr("data-x", parseInt(coordinates.x)); // Set x-coordinate as a data attribute
                    point.attr("data-y", parseInt(coordinates.y)); // Set y-coordinate as a data attribute
                    // point.text(`${parseInt(coordinates.x)},${parseInt(coordinates.y)}`); // Optionally, you can label points with their coordinates
                    // Use a ternary operator to set the text based on coordinates.label
                    point.text(coordinates.label !== null ? coordinates.label : '');
                    gridContainer.append(point); // Append the point to the grid container using jQuery
                    // point.addClass(coordinates.isBlock === 'true' ? 'blocked' : '');
                    if (coordinates.isBlock === 'true' && coordinates.label !== targetFacilities) {
                        point.addClass('blocked');
                        targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                    } else if (coordinates.label === targetFacilities) {
                        point.addClass('targetFacilities');
                        targetX = parseInt(coordinates.x);
                        targetY = parseInt(coordinates.y);
                        targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                    }

                    // add default css
                    if(startingX === parseInt(coordinates.x) && startingY === parseInt(coordinates.y)){
                        point.addClass('starting-point');
                        point.text('Your here.')
                    }

                    // Add the point to the gridPoints array
                    gridPoints.push(point);
                    $('#target-selection').html(targetSelection);
                    // starting point x, y  target x,y
                    dijkstra(startingX, startingY, targetX, targetY);
                });
            }

            // Call the function to create a 10x10 grid of points
            createGridPoints('epas');

            // Dijkstra's Algorithm
            async function dijkstra(startX, startY, endX, endY, width2, height2) {
                try {
                    const startNode = document.querySelector(
                        `[data-x="${startX}"][data-y="${startY}"]`
                    );
                    const endNode = document.querySelector(
                        `[data-x="${endX}"][data-y="${endY}"]`
                    );

                    const width = 4; // Adjust to match the width of the grid
                    const height = 10; // Adjust to match the height of the grid

                    // Create a 2D array to represent the grid
                    const grid = new Array(height);
                    for (let y = 0; y < height; y++) {
                        grid[y] = new Array(width);
                        for (let x = 0; x < width; x++) {
                            grid[y][x] = document.querySelector(
                                `[data-x="${x}"][data-y="${y}"]`
                            );
                        }
                    }

                    // Helper function to calculate the distance between two grid points
                    function calculateDistance(node1, node2) {
                        const dx = Math.abs(node1.dataset.x - node2.dataset.x);
                        const dy = Math.abs(node1.dataset.y - node2.dataset.y);
                        return Math.sqrt(dx * dx + dy * dy);
                    }

                    // Initialize distance array with Infinity and visited array with false
                    const distances = new Array(height)
                        .fill(null)
                        .map(() => new Array(width).fill(Infinity));
                    const visited = new Array(height)
                        .fill(null)
                        .map(() => new Array(width).fill(false));

                    // Set the distance of the starting point to 0
                    distances[startY][startX] = 0;

                    // Dijkstra's algorithm
                    while (!visited[endY][endX]) {
                        let currentMinDistance = Infinity;
                        let currentX = null;
                        let currentY = null;

                        // Find the unvisited node with the smallest distance
                        for (let y = 0; y < height; y++) {
                            for (let x = 0; x < width; x++) {
                                if (!visited[y][x] && distances[y][x] < currentMinDistance) {
                                    currentMinDistance = distances[y][x];
                                    currentX = x;
                                    currentY = y;
                                }
                            }
                        }

                        // Mark the current node as visited
                        visited[currentY][currentX] = true;

                        // Explore neighbors
                        const neighbors = [{
                                x: currentX - 1,
                                y: currentY
                            },
                            {
                                x: currentX + 1,
                                y: currentY
                            },
                            {
                                x: currentX,
                                y: currentY - 1
                            },
                            {
                                x: currentX,
                                y: currentY + 1
                            },
                        ];

                        for (const neighbor of neighbors) {
                            const {
                                x,
                                y
                            } = neighbor;

                            // Check if the neighbor is within the grid
                            if (x >= 0 && x < width && y >= 0 && y < height) {
                                const neighborNode = grid[y][x];

                                // Check if the neighbor is not a block
                                if (!neighborNode.classList.contains("blocked")) {
                                    const distanceToNeighbor = calculateDistance(
                                        grid[currentY][currentX],
                                        neighborNode
                                    );

                                    // Update the distance if a shorter path is found
                                    if (
                                        !visited[y][x] &&
                                        distances[currentY][currentX] + distanceToNeighbor <
                                        distances[y][x]
                                    ) {
                                        distances[y][x] =
                                            distances[currentY][currentX] + distanceToNeighbor;
                                    }
                                }
                            }
                        }
                    }

                    // Backtrack to find the shortest path
                    const shortestPath = [];
                    let currentX = endX;
                    let currentY = endY;

                    while (currentX !== startX || currentY !== startY) {
                        shortestPath.unshift({
                            x: currentX,
                            y: currentY
                        });
                        const neighbors = [{
                                x: currentX - 1,
                                y: currentY
                            },
                            {
                                x: currentX + 1,
                                y: currentY
                            },
                            {
                                x: currentX,
                                y: currentY - 1
                            },
                            {
                                x: currentX,
                                y: currentY + 1
                            },
                        ];

                        for (const neighbor of neighbors) {
                            const {
                                x,
                                y
                            } = neighbor;

                            // Check if the neighbor is within the grid
                            if (x >= 0 && x < width && y >= 0 && y < height) {
                                const neighborNode = grid[y][x];
                                const distanceToNeighbor = calculateDistance(
                                    grid[currentY][currentX],
                                    neighborNode
                                );

                                if (
                                    distances[y][x] + distanceToNeighbor ===
                                    distances[currentY][currentX]
                                ) {
                                    currentX = x;
                                    currentY = y;
                                    break;
                                }
                            }
                        }
                    }

                    // Add the starting point to the shortest path
                    shortestPath.unshift({
                        x: startX,
                        y: startY
                    });

                    // Highlight the shortest path in the grid
                    for (const {
                            x,
                            y
                        }
                        of shortestPath) {
                        const node = grid[y][x];
                        node.classList.add("passed"); // Highlight the current node as passed
                        await sleep(200); // Delay for visualization (adjust as needed)
                    }
                } catch (error) {
                    console.log(error)
                }
            }

            // Helper function to add a delay for animation
            function sleep(ms) {
                return new Promise((resolve) => setTimeout(resolve, ms));
            }

            $(document).on('click', '#newTarget', function(){
                const selectedValue = $("#target-selection").val();
                createGridPoints(selectedValue)
            })

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