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
        .drag-container::-webkit-scrollbar{
            display: none;
        }
        .drag-container{
            max-height: 350px; /* Adjust the height as needed */
            overflow-y: auto; /* Enable vertical scrollbar if content overflows */
            position: relative;
            z-index: 1000;
            /* width: fit-content; */
        }
            /* Style for the draggable box */
        .drag-item {
            width: 80px;
            height: 80px;
            word-break: break-all; /* Break long words */
            text-align: center;
            /* background-color: #ffc107; Yellow background for draggable item */
            border: 1px solid #999;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif; /* Specify a common font */
            font-size: 18px; /* Adjust font size */
            color: #f5e8e8; /* Text color */
            cursor: grab; /* Change cursor when dragging */
            position: relative;
            z-index: 2001;
            transition: transform 0.2s ease-in-out; /* Add a transition for the transform property */
        }
        .drag-item:hover{
            transform: scale(1.1); /* Apply a scale transformation on hover */
            z-index: 3000;
        }

      /* Style for the draggable box container */
        .drag-content {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
        }

        /* Style for the cancel button (X) */
        .cancel-drag-button {
            background: transparent;
            border: 1px solid red;
            border-radius: 5px;
            background-color: red;
            color: #f3ecec;
            font-size: 14px;
            cursor: pointer;
            position: absolute;
            top: -10px;
            right: -10px;
            /* display: none;  */
        }


      /* Style for the grid container */
      .grid-container {
        padding: 10px;
        width: fit-content; /* Adjust the width of the floorplan */
        height: fit-content; /* Adjust the height of the floorplan */
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        /* margin: 50px auto; */
        display: grid;
        grid-template-columns: repeat(10, 1fr); /* Adjust the number of columns */
        grid-template-rows: repeat(4, 1fr); /* Adjust the number of rows */
        gap: 5px; /* Adjust the gap between rooms */
        background-color: transparent; /* Background color for the floorplan */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        border-radius: 10px; /* Add rounded corners */
        perspective: 1000px; /* Create perspective for 3D effect */
        z-index: 1000;
      }

      /* Style for each room (grid point) */
      .grid-point {
        width: 80px;
        height: 80px;
        background-color: transparent; /* Light background color for rooms */
        border: 1px solid rgba(0, 0, 0, 0.3);; /* Add borders */
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif; /* Specify a common font */
        font-size: 15px; /* Adjust font size */
        color: #f3ecec; /* Text color */
        position: relative;
        transition: transform 0.3s ease-in-out; /* Add smooth transform transition */
        transform-style: preserve-3d; /* Preserve 3D effect */
        z-index: 1;
      }

      /* Add 3D effect on hover */
      .grid-point:hover {
        transform: translateZ(
          10px
        ); /* Translate along the Z-axis to create elevation */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
      }

      /* Style for the walls (blocks) */
      .block {
        background-color: #999; /* Dark background color for walls */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        color: white;
        font-size: 15px;
      }

      /* Style for the walls (starting points) */
      .starting-point {
        background-color: #034d07; /* Dark background color for walls */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        color: white;
        font-size: 15px;
      }

      .grid-point.block::after {
        content: attr(
          data-label
        ); /* Set the content to the data-label attribute */
      }

      /* Style for animation */
      .grid-point.passed {
        background-color: transparent; /* Dark green for passed rooms */
        color: white;
        animation: animatePath 4s linear infinite; /* Animation settings */
      }

      /* Define the animation */
      @keyframes animatePath {
        0% {
            border: none;
            color: #06df59;
          /* background-color: green; */
          /* transform: translateZ(2px); Translate along the Z-axis to create elevation */
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        }
        25% {
          /* background-color: rgb(11, 196, 66); */
          /* transform: translateZ(20px); Translate along the Z-axis to create elevation */
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        }
        50% {
          /* background-color: rgb(15, 226, 61); */
          /* transform: translateZ(5px); Translate along the Z-axis to create elevation */
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        }
        75% {
          /* background-color: rgb(32, 88, 209); */
          /* transform: translateZ(15px); Translate along the Z-axis to create elevation */
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        }
        100% {
          /* background-color: green; */
          /* transform: translateZ(10px); Translate along the Z-axis to create elevation */
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
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

                            <h4 class="card-title mb-4">Building Field</h4>

                            <div class="table-responsive">

                                <h6 class="font-size-13">
                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                    <span class="text-secondary">Floor Selection</span>
                                    <div class="input-group d-flex align-items-center text-success">
                                        <select id="floor-selected" class="form-control text-white mt-2">
                                            @php
                                                for ($i = 1; $i <= 10; $i++) { 
                                                    echo "<option value='floor-$i'>$i" . ($i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th'))) . " Floor</option>";
                                                }
                                            @endphp
                                        </select>
                                        
                                        {{-- <i class="text-danger h3 fas fa-check delete-row" style="margin:15px auto 10px 10px;"></i> --}}
                                    </div>
                                </h6>

                                <h6 class="font-size-13">
                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                    <span class="text-secondary">Row Fields</span>
                                    <div class="input-group d-flex align-items-center text-success">
                                        <input type="number" id="row-size" value="4" min="1" max="20" class="form-control text-white mt-2"
                                        placeholder="add columns">
                                        {{-- <i class="text-danger h3 fas fa-check delete-row" style="margin:15px auto 10px 10px;"></i> --}}
                                    </div>
                                </h6>

                                <h6 class="font-size-13">
                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                    <span class="text-secondary">Column Fields</span>
                                    <div class="input-group d-flex align-items-center text-success">
                                        <input type="number" id="column-size" value="10" min="1" max="20" class="form-control text-white mt-2"
                                        placeholder="add columns">
                                        {{-- <i class="text-danger h3 fas fa-check delete-row" style="margin:15px auto 10px 10px;"></i> --}}
                                    </div>
                                </h6>
                                <button class="btn btn-secondary mt-2" id="apply-grid-size">Resize</button>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- {{ $facilities }} --}}
                            <h4 class="card-title mb-4">Available Facilities</h4>

                            <div class="table-responsive row">
                                {{-- all contents --}}
                                <div class="col-sm-2 mb-3 drag-container row">
                                    <div class="col-sm-6 mx-auto drag-item starting-point" id="starting-point" data-name="start" data-label="front">
                                        <div class="drag-content">
                                            {{ __('front') }}
                                        </div>
                                    </div>
                                    @foreach ($facilities as $facility)
                                        
                                    <div class="col-sm-6 mx-auto mb-2 drag-item start" id="{{ $facility->facilities }}" data-name="start" data-label="{{ $facility->facilities }}" data-id="{{ $facility->id }}">
                                        {{-- <button class="cancel-drag-button">X</button> --}}
                                        <div class="drag-content">
                                            {{ $facility->facilities }}
                                        </div>
                                    </div>
                                    
                                    @endforeach
                        
                                </div>

                                <div class="col-sm-10 mx-auto mb-2 grid-container" id="grid-container">
                                        <!-- Points will be dynamically generated here -->
                                </div>
                                  <button class="btn btn-secondary" id="run-dijkstra">Save Floor Plan</button>
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
       $(document).ready(function(){

            const gridContainer = $("#grid-container");
            let gridPoints = [];
            let isDragging = false;
            let startingPoint;
            let details;
            // Function to create and append points to the grid
            function createGridPoints(width, height) {
                gridPointWidth = width;
                gridPointHeight = height;
                gridContainer.empty(); // Clear the existing grid using jQuery
                // change it if you have same level like 10x10 you change it to y first loop as height
                for (let x = 0; x < width; x++) {
                    for (let y = 0; y < height; y++) {
                        const point = $("<div></div>"); // Create a new div element using jQuery
                        point.addClass("grid-point");
                        point.attr("data-x", x); // Set x-coordinate as a data attribute
                        point.attr("data-y", y); // Set y-coordinate as a data attribute
                        // point.text(`${x},${y}`); // Optionally, you can label points with their coordinates

                        gridContainer.append(point); // Append the point to the grid container using jQuery

                        // Add the point to the gridPoints array
                        gridPoints.push(point);
                    }
                }
            }

            // Function to handle applying the grid size
            function applyGridSize() {
                const gridSizeRow = $("#row-size");
                const gridSizeColumn = $("#column-size");
                const h = $("#grid-container").height();
                const gridSize = parseInt(gridSizeRow.val(), 10);//row
                const gridColumn = parseInt(gridSizeColumn.val(), 10);//row
                $('.drag-container').css("height", `${h}`)
                if (!isNaN(gridSize) && gridSize >= 1 && gridSize <= 20) {
                    // Calculate the width and height based on grid size and gap
                    const containerWidth = gridSize * (gridPointWidth + 5) + 2 * 10;
                    const containerHeight = gridSize * (gridPointHeight + 5) + 2 * 10;

                    console.log(gridSize, gridColumn)
                    // Set the width and height of the grid container
                    $("#grid-container").css("width", "fit-content");
                    $("#grid-container").css("height", "fit-content");

                    // Update the grid template columns and rows
                    $("#grid-container").css("grid-template-columns", `repeat(${gridColumn}, 1fr)`);
                    $("#grid-container").css("grid-template-rows", `repeat(${gridSize}, 1fr)`);

                    
                    // $(".drag-container").css("width",)
                    createGridPoints(gridSize,gridColumn);

                    details = collectGridDetails();
                    console.log(details)
                } else {
                    alert("Please enter a valid grid size between 1 and 20.");
                }
            }

            function collectGridDetails() {
                const gridPoints = document.querySelectorAll(".grid-point");
                const gridContainer = document.getElementById("grid-container"); // Get the grid container
                const computedStyle = getComputedStyle(gridContainer);
                const gridColumnCount = parseInt(computedStyle.getPropertyValue("grid-template-columns").split(" ").length);
                const gridRowCount = parseInt(computedStyle.getPropertyValue("grid-template-rows").split(" ").length);
                const gridSize = gridColumnCount * gridRowCount;
                const gridDetails = [];
                let floor = '';
                gridPoints.forEach((gridPoint) => {
                    const rect = gridPoint.getBoundingClientRect();
                    const x = parseInt(gridPoint.dataset.x, 10);
                    const y = parseInt(gridPoint.dataset.y, 10);
                    const width = rect.width;
                    const height = rect.height;
                    const row = y + 1; // Add 1 to convert from 0-based index to 1-based
                    const column = x + 1; // Add 1 to convert from 0-based index to 1-based
                    const isBlock = gridPoint.classList.contains("block");
                    const label = gridPoint.getAttribute("data-label");

                    // static for now
                    floor = $('#floor-selected').val();
                    gridDetails.push({
                        x,
                        y,
                        width,
                        height,
                        row,
                        column,
                        isBlock,
                        label,
                    });
                });

                return {
                    floor,
                    gridSize,
                    gridDetails,
                };
            }

            // Call the function to create a 10x10 grid of points
            createGridPoints(4, 10);

            interact(".drag-item").draggable({
                listeners: {
                start(event) {
                    event.target.classList.add("dragging");
                    event.target.style.zIndex = "1001"; // Increase the z-index when dragging starts
                },
                move(event) {
                    const target = event.target;
                    const x =
                    (parseFloat(target.getAttribute("data-x")) || 0) + event.dx;
                    const y =
                    (parseFloat(target.getAttribute("data-y")) || 0) + event.dy;

                    target.style.transform = `translate(${x}px, ${y}px)`;
                    target.setAttribute("data-x", x);
                    target.setAttribute("data-y", y);
                },
                end(event) {
                    event.target.classList.remove("dragging");
                    // Calculate the center coordinates of the draggable box
                    const boxRect = event.target.getBoundingClientRect();
                    const boxCenterX = (boxRect.left + boxRect.right) / 2;
                    const boxCenterY = (boxRect.top + boxRect.bottom) / 2;

                    // Find the grid-point under the center of the draggable box
                    const gridPoints = document.querySelectorAll(".grid-point");
                    for (const gridPoint of gridPoints) {
                    const pointRect = gridPoint.getBoundingClientRect();
                    if (
                        boxCenterX >= pointRect.left &&
                        boxCenterX <= pointRect.right &&
                        boxCenterY >= pointRect.top &&
                        boxCenterY <= pointRect.bottom
                    ) {
                        // The center of the box is over a grid-point, turn it into a block
                        const label = event.target.getAttribute("data-label");
                        const dataId = event.target.getAttribute("data-id");
                        // The center of the box is over a grid-point, turn it into a block
                        gridPoint.classList.add(dataId, "block");
                        
                        gridPoint.innerText = '';
                        gridPoint.setAttribute("data-label", label); // Set the data-label attribute
                        // Create a close button
                        const closeButton = document.createElement("button");
                        closeButton.className = "cancel-drag-button";
                        closeButton.innerText = "X";
                        closeButton.addEventListener("click", () => {
                            gridPoint.classList.remove("block");
                            gridPoint.removeAttribute("data-label");
                            gridPoint.removeChild(closeButton);
                        });
                         // Append the close button to the grid point
                         gridPoint.appendChild(closeButton);
                        event.target.style.transform = "translate(0px, 0px)";
                        event.target.setAttribute("data-x", 0);
                        event.target.setAttribute("data-y", 0);
                        return; // Exit the loop when a match is found
                    }
                    }

                    // The center of the box is not over a grid-point, reset its position and remove the "block" class
                    event.target.style.transform = "translate(0px, 0px)";
                    event.target.setAttribute("data-x", 0);
                    event.target.setAttribute("data-y", 0);
                    event.target.classList.remove("block");
                    event.target.style.zIndex = "1000"; // Restore the original z-index when dragging stops
                },
                },
            });

            // Dijkstra's Algorithm
            async function dijkstra(startX, startY, endX, endY, width2, height2) {
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
                const neighbors = [
                    { x: currentX - 1, y: currentY },
                    { x: currentX + 1, y: currentY },
                    { x: currentX, y: currentY - 1 },
                    { x: currentX, y: currentY + 1 },
                ];

                for (const neighbor of neighbors) {
                    const { x, y } = neighbor;

                    // Check if the neighbor is within the grid
                    if (x >= 0 && x < width && y >= 0 && y < height) {
                    const neighborNode = grid[y][x];

                    // Check if the neighbor is not a block
                    if (!neighborNode.classList.contains("block")) {
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
                shortestPath.unshift({ x: currentX, y: currentY });
                const neighbors = [
                    { x: currentX - 1, y: currentY },
                    { x: currentX + 1, y: currentY },
                    { x: currentX, y: currentY - 1 },
                    { x: currentX, y: currentY + 1 },
                ];

                for (const neighbor of neighbors) {
                    const { x, y } = neighbor;

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
                shortestPath.unshift({ x: startX, y: startY });

                // Highlight the shortest path in the grid
                for (const { x, y } of shortestPath) {
                const node = grid[y][x];
                node.classList.add("passed"); // Highlight the current node as passed
                await sleep(200); // Delay for visualization (adjust as needed)
                }
            }

             // Helper function to add a delay for animation
            function sleep(ms) {
                return new Promise((resolve) => setTimeout(resolve, ms));
            }

            // Button click event to run Dijkstra's Algorithm
            $("#run-dijkstra").on("click", function() {
                // Clear previous highlights
                $(".grid-point").removeClass("passed");
                // Call Dijkstra's algorithm with your specified starting and destination points
                // dijkstra(2, 9, 3, 0);
                console.log(collectGridDetails());
                // Call the function to collect data
                var gridDetails = collectGridDetails();
                sendCoordinates(gridDetails);
            });

            // Add an event listener for the Apply button using jQuery
            $("#apply-grid-size").on("click", applyGridSize);


            // function to send coordinates to a server
            function sendCoordinates(coordinates){
                // Get the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/building-layouts/coordinates', // Replace with your server endpoint URL
                    method: 'POST', // Use POST or other HTTP method as needed
                    data: {
                        gridDetails: coordinates
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(response) {
                        // Handle the server's response here
                        console.log('Data sent successfully:', response);
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
                        toastr['success']('Your Floor Plan is ready to used!');
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.error('Error:', status, error);
                    }
                });
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
