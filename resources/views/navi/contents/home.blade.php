@extends('navi.index')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/svg-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}"> --}}

    {{-- toast css --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/toastr/build/toastr.min.css') }}"> --}}
   
    <!-- Bootstrap Css -->
    {{-- <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" --}}
        {{-- type="text/css" /> --}}
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- loader css --}}
    <style>
        .loader {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            margin-top: -100px;
            /* display: none; */

        }
        
        .wave {
            width: 5px;
            height: 50px;
            background: linear-gradient(45deg, cyan, #fff);
            margin: 10px;
            animation: wave 1s linear infinite;
            border-radius: 20px;
        }

        .wave:nth-child(2) {
            animation-delay: 0.1s;
        }

        .wave:nth-child(3) {
            animation-delay: 0.2s;
        }

        .wave:nth-child(4) {
            animation-delay: 0.3s;
        }

        .wave:nth-child(5) {
            animation-delay: 0.4s;
        }

        .wave:nth-child(6) {
            animation-delay: 0.5s;
        }

        .wave:nth-child(7) {
            animation-delay: 0.6s;
        }

        .wave:nth-child(8) {
            animation-delay: 0.7s;
        }

        .wave:nth-child(9) {
            animation-delay: 0.8s;
        }

        .wave:nth-child(10) {
            animation-delay: 0.9s;
        }

        @keyframes wave {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        /* location popups */
        
    </style>

    {{-- navigation style --}}
    <style>
         /* Set the max-width to fit-content for the modal dialog */
         .modal-dialog, .card {
            max-width: fit-content;
            color: #fff;
           
        }

        /* Add a background and box-shadow to the modal content */
        .modal-content, .card {
            background: rgba(38, 48, 36, 0.4);
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; /* Box shadow */
        }
         /* Position the close button on the right side of the modal header */
         .modal-header .btn-close {
            ms-auto; /* Push the button to the right */
        }
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
            width: 50px;
            height: 50px;
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
            transform: translateZ(20px);
            cursor: pointer;
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
            border: 1px solid green;
            transform: translateZ(20px);
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            color: white;
        }

        /* starting point */
        .targetFacilities {
            background-color: #044214;
            border: 1px solid green;
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            color: white;
            transform: translateZ(20px);
            cursor: pointer;
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

@section('contents')
    <div class="version">
        <span>Epcst-v1.0.1</span>
    </div>
    <header>
        <div class="en"><b>E-N</b></div>
    </header>
    <div class="" id="con-circle">
        <div class="circle">
            <div id="title" class="text-center text-white h1"><b>EXOUSIA-NAVI</b></div>
            <span id="sec-title" class="text-white"><b>Eastwoods Professional College</b></span>
            <br>
            @include('navi.loaderPage.preloader')
        </div>

    </div>
    <main>
        <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="ask" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 4C9.243 4 7 6.243 7 9h2c0-1.654 1.346-3 3-3s3 1.346 3 3c0 1.069-.454 1.465-1.481 2.255-.382.294-.813.626-1.226 1.038C10.981 13.604 10.995 14.897 11 15v2h2v-2.009c0-.024.023-.601.707-1.284.32-.32.682-.598 1.031-.867C15.798 12.024 17 11.1 17 9c0-2.757-2.243-5-5-5zm-1 14h2v2h-2z">
                    </path>
                </svg></b>
        </span>
        <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="mic" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M6 12H4c0 4.072 3.061 7.436 7 7.931V22h2v-2.069c3.939-.495 7-3.858 7-7.931h-2c0 3.309-2.691 6-6 6s-6-2.691-6-6z">
                    </path>
                    <path
                        d="M8 12c0 2.206 1.794 4 4 4s4-1.794 4-4h-2v-2h2V8h-2V6h2c0-2.217-1.785-4.021-3.979-4.021a.933.933 0 0 0-.209.025A4.006 4.006 0 0 0 8 6h4v2H8v2h4v2H8z">
                    </path>
                </svg></b>
        </span>
        <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="speech" xmlns="http://www.w3.org/2000/svg" width="30" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M8 12.052c1.995 0 3.5-1.505 3.5-3.5s-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5 1.505 3.5 3.5 3.5zM9 13H7c-2.757 0-5 2.243-5 5v1h12v-1c0-2.757-2.243-5-5-5zm9.364-10.364L16.95 4.05C18.271 5.373 19 7.131 19 9s-.729 3.627-2.05 4.95l1.414 1.414C20.064 13.663 21 11.403 21 9s-.936-4.663-2.636-6.364z">
                    </path>
                    <path
                        d="M15.535 5.464 14.121 6.88C14.688 7.445 15 8.198 15 9s-.312 1.555-.879 2.12l1.414 1.416C16.479 11.592 17 10.337 17 9s-.521-2.592-1.465-3.536z">
                    </path>
                </svg></b>
        </span>
        <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="scanner" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path d="M4 4h4.01V2H2v6h2V4zm0 12H2v6h6.01v-2H4v-4zm16 4h-4v2h6v-6h-2v4zM16 4h4v4h2V2h-6v2z"></path>
                    <path
                        d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z">
                    </path>
                </svg></b>
        </span>
    </main>
    <main-form id="in">
        <div id="chat_container" hidden></div>
        <form>
            <input type="text" id="key" value="" name="id" hidden>
            <input type="text" id="query" value="" name="query" hidden>
            <textarea id="input" name="prompt" rows="1" cols="1" class="form-control"
                placeholder="Enter your query or use the mic button"></textarea>>
            <!-- <button type="submit"><img src="assets/send.svg" alt="send" /> -->
        </form>
    </main-form>

    <section>
        <!-- frrequently ask -->
        <div class="container" id="popupask">
            <div class="content">
                <div id="frequently-ask">
                    @foreach ($frequentlies as $frequently)
                        <span data-id="{{ $frequently->frequently }}"
                            id="frequently-question">{{ $frequently->frequently }}</span>
                    @endforeach

                    <!-- <span>Where is the library?</span>   -->
                </div>
            </div>
        </div>

        <!-- location popups -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title me-2" id="exampleModalLabel">
                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 
                            Navigation Guide 
                        </h5>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-10">
                            <div class="card">
                                <div class="card-body">
                                    {{-- {{ $details }} --}}
                                    <div class="table-responsive row">
                                        {{-- all contents --}}
        
                                        <div class="col-sm-10 mx-auto mb-2 grid-container" id="grid-container">
                                            <!-- Points will be dynamically generated here -->
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end card -->
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div> --}}
                </div>
            </div>
        </div>
    
        <div id="overlay" class="hidden"></div>
        {{-- <div class="container" id="popuplocation">
            <!-- <div class="content"> -->
            <div id="location" class="text-center">
                <h1 class="text-white">Navigation Guide</h1>
                <div class="tilted-svg">
                    <svg version="1.1" width="450" height="200" xmlns="http://www.w3.org/2000/svg" class="">
                        <rect width="100%" height="100%" fill="#263024" class="rect-box" />

                        <rect width="10%" height="25%" fill="white" y="10" x="10"
                            class="myRect" />
                        <text x="20" y="40" fill="white">R-1</text>
                        <circle cx="30" cy="60" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="10" x="60"
                            class="myRect" />
                        <text x="70" y="40" fill="white">R-2</text>
                        <circle cx="80" cy="60" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="10" x="110"
                            class="myRect" />
                        <text x="120" y="40" fill="white">F-1</text>
                        <circle cx="130" cy="60" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="10" x="160"
                            class="myRect" />
                        <text x="170" y="40" fill="white">R-1</text>
                        <circle cx="180" cy="60" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="10" x="210"
                            class="myRect" />
                        <text x="220" y="40" fill="white">F-1</text>
                        <circle cx="230" cy="60" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="10" x="260"
                            class="myRect" />
                        <text x="270" y="40" fill="white">R-1</text>
                        <circle cx="280" cy="60" r="4" fill="transparent" class="" />




                        <rect width="10%" height="25%" fill="white" y="75" x="400"
                            class="myRect" />
                        <text x="410" y="90" fill="white">S-1</text>
                        <circle cx="420" cy="100" r="5" fill="green"
                            class="stPoint active-rect" />
                        <!-- starting position -->
                        <!-- Hallway -->
                        <!-- <rect x="10" y="75" width="400" height="50" fill="black" /> -->

                        <!-- Dots -->
                        <circle cx="30" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <!-- <polygon points="280,60 275,56 275,64" fill="red" class="arrow"/> -->
                        <circle cx="80" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="130" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="180" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="230" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="280" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="335" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />
                        <circle cx="380" cy="100" r="4" fill="transparent"
                            class="arrow unvisited" />

                        <rect width="10%" height="25%" fill="white" y="140" x="10"
                            class="myRect" />
                        <text x="20" y="160" fill="white">R-1</text>
                        <circle cx="30" cy="140" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="140" x="60"
                            class="myRect" />
                        <text x="70" y="160" fill="white">R-2</text>
                        <circle cx="80" cy="140" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="140" x="110"
                            class="myRect" />
                        <text x="120" y="160" fill="white">F-1</text>
                        <circle cx="130" cy="140" r="4" fill="transparent"
                            class="finaldestination" />

                        <rect width="10%" height="25%" fill="white" y="140" x="160"
                            class="myRect" />
                        <text x="170" y="160" fill="white">R-1</text>
                        <circle cx="180" cy="140" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="140" x="210"
                            class="myRect" />
                        <text x="220" y="160" fill="white">F-1</text>
                        <circle cx="230" cy="140" r="4" fill="transparent" class="" />

                        <rect width="10%" height="25%" fill="white" y="140" x="260"
                            class="myRect" />
                        <text x="270" y="160" fill="white">R-1</text>
                        <circle cx="280" cy="140" r="4" fill="transparent" class="" />




                        <!-- M = move to -->
                        <!-- x30, y35 = ending point -->
                        <!-- L = line -->
                        <!-- x30, y420 = starting point -->

                        <path fill="none" stroke="green" stroke-dasharray="5,2" stroke-width="3" id="p">
                            <animate attributeName="stroke-dashoffset" from="0" to="7" dur=".5s"
                                repeatCount="indefinite" />
                        </path>
                        <!-- final stage -->
                        <path fill="none" stroke="green" stroke-dasharray="5,2" stroke-width="3" id="f">
                            <animate attributeName="stroke-dashoffset" from="0" to="7" dur=".5s"
                                repeatCount="indefinite" />
                        </path>
                        <!-- Arrowhead -->

                    </svg>

                </div>
            </div>
            <!-- </div> -->
        </div> --}}
    </section>
    <footer>
        <span>Capstone1-40%</span>
    </footer>

    <!-- Modal -->
    {{-- <div id="AssistantModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100" id="reader">

                            <!-- <h1>Place your QR Code in here!</h1>
                            <div id="reader" class="card" style="width: 500px;">

                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/events.js') }}"></script>
    {{-- <script src="{{ asset('js/home.js') }}"></script> --}}

    @if (session('message'))
        <script>
            var message = @json(session('message'));
            // const initialUtterance = new SpeechSynthesisUtterance(message);
            // const synth = window.speechSynthesis;
            // synth.speak(initialUtterance);
        </script>
    @endif

    {{-- handle events --}}
    <script>
        $(document).ready(function() {
            // $("#showModal").click(function() {
                // $("#myModal").modal("show");
            // });
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = $('form');
            const chatContainer = $('#chat_container');
            let circle = $('.circle');
            const afterElement = $('<div></div>');
            const en = $('header');
            const conC = $('#con-circle');
            const conT = $('#title');
            const location = $('#popuplocation');
            const input = $('#input')
            let loadInterval;

            // loader
            $('.loader').hide()
            const handleSubmit = async (e) => {
                e.preventDefault();
                // hide input
                input.hide()
                const data = new FormData(form[0]);
                // to clear the textarea input
                form[0].reset();
                // to focus scroll to the bottom
                chatContainer.scrollTop(chatContainer[0].scrollHeight);
                // const localData = localStorage.getItem('data') || [];
                // console.log(localData)
                const response = await fetch('/navi/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        prompt: `${data.get('prompt')}`
                    }),

                });

                // Clear the loading indicator
                clearInterval(loadInterval);
                // console.log(response)
                handleResponse(response)
            };

            form.on('submit', handleSubmit);

            form.on('keyup', (e) => {
                if (e.keyCode === 13) {
                    handleSubmit(e);
                    var blur = $('#popupask');
                    blur.removeClass('active');
                }
            });

            $(document).on('click', '#frequently-question', async function() {
                var q = $(this).data('id')
                console.log(q)
                const response = await fetch('/navi/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        prompt: `${q}`,
                    }),

                });
                // const responseData = await response.json();
                handleResponse(response)
            })

            // handle response
            const handleResponse = async (response) => {
                // console.log(response.ok)
                if (response.ok) {
                    const responseData = await response.json();
                    const parsedData = responseData.response;
                    console.log(responseData)
                    if (parsedData.data) {
                        // nothing to add if true for now
                    } else {
                        // speak
                        input.hide()
                        $('#popupask').removeClass('active')
                        // startToSpeak(parsedData.answer)

                        startToSpeak(parsedData.answer)
                        .then((finished) => {
                            if (finished) {
                                // Speech finished
                                console.log(finished)

                                if(responseData.floor !== false){
                                    console.log(responseData.continuation)
                                    processFacilitiesNavigation(responseData.floor, responseData.facility)
                                    if(responseData.continuation !== false && responseData.continuation !== undefined){
                                        $("#myModal").modal("show");
                                    }
                                    // $("#myModal").modal("show");
                                }
                            } else {
                                console.log('not fineshed')
                                // Speech synthesis not supported
                                // Handle accordingly
                            }
                        });
                    }
                } else {
                    const err = await response.text();
                    // messageDiv.html("Something went wrong");
                    alert(err);
                }
            }

            // prepare for speak
            // const startToSpeak = async (sentence) => {
            //     console.log(sentence)
            //     if ('speechSynthesis' in window) {
            //         const utterance = new SpeechSynthesisUtterance();
            //         utterance.volume = 1;
            //         utterance.rate = 0.9;
            //         utterance.pitch = 1;
            //         utterance.text = sentence;

            //         var index = 1;
            //         for (index; index < window.speechSynthesis.getVoices().length; index++) {
            //             if (window.speechSynthesis.getVoices()[index].voiceURI.search('Zeera') != -1) {
            //                 utterance.voice = window.speechSynthesis.getVoices()[index];
            //             }
            //         }
            //         utterance.voice = window.speechSynthesis.getVoices()[index];

            //         setTimeout(() => {
            //             utterance.voice = window.speechSynthesis.getVoices()[1];
            //         }, 1000);

            //         utterance.addEventListener('end', () => {
            //             console.log('Speech finished');
            //             // loader
            //             $('.loader').hide()
            //             const afterElement = circle.find('.circle-after');

            //             if (afterElement.length) {
            //                 circle.remove(afterElement);

            //                 setTimeout(() => {
            //                     afterElement.removeClass('circle-after');
            //                     conC.removeClass('container-circle');
            //                     conT.removeClass('container-title');
            //                     en.removeClass('inside');
            //                     location.removeClass('active');

            //                     // show input
            //                     input.show()
            //                 }, 1000);
            //             }
            //         });

            //         // start talked
            //         setTimeout(() => {
            //             afterElement.addClass('circle-after');
            //             $('.loader').show()
            //             circle.append(afterElement);
            //             speechSynthesis.speak(utterance);
            //         }, 1000);
            //     } else {
            //         console.log('Speech synthesis not supported in this browser');
            //     }
            // }
            const startToSpeak = async (sentence) => {
                console.log(sentence);

                if ('speechSynthesis' in window) {
                    return new Promise((resolve, reject) => {
                        const utterance = new SpeechSynthesisUtterance();
                        utterance.volume = 1;
                        utterance.rate = 0.9;
                        utterance.pitch = 1;
                        utterance.text = sentence;

                        var index = 1;
                        for (index; index < window.speechSynthesis.getVoices().length; index++) {
                            if (window.speechSynthesis.getVoices()[index].voiceURI.search('Zeera') != -1) {
                                utterance.voice = window.speechSynthesis.getVoices()[index];
                            }
                        }
                        utterance.voice = window.speechSynthesis.getVoices()[index];

                        setTimeout(() => {
                            utterance.voice = window.speechSynthesis.getVoices()[1];
                        }, 1000);

                        utterance.addEventListener('end', () => {
                            console.log('Speech finished');
                            // loader
                            $('.loader').hide();
                            const afterElement = circle.find('.circle-after');

                            if (afterElement.length) {
                                circle.remove(afterElement);

                                setTimeout(() => {
                                    afterElement.removeClass('circle-after');
                                    conC.removeClass('container-circle');
                                    conT.removeClass('container-title');
                                    en.removeClass('inside');
                                    location.removeClass('active');

                                    // show input
                                    input.show();

                                    resolve(true); // Resolve the Promise when speech finishes
                                }, 1000);
                            }
                        });

                        // start talked
                        setTimeout(() => {
                            afterElement.addClass('circle-after');
                            $('.loader').show();
                            circle.append(afterElement);
                            speechSynthesis.speak(utterance);
                        }, 1000);
                    });
                } else {
                    console.log('Speech synthesis not supported in this browser');
                    return false; // Return false if speech synthesis is not supported
                }
            };

            // process facilities navigation
            const processFacilitiesNavigation = async (floor, facility) => {
                const response = await fetch('/navi/process/navigation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        floor: `${floor}`,
                    }),

                });
                // const responseData = await response.json();
                // handleResponse(response)
                const responseData = await response.json();
                console.log(responseData)
                var serverResponds = responseData.details;
                const gridContainer = $("#grid-container");
                let gridPoints = [];
                let startingPoint;
                let highestX = -Infinity; // Start with negative infinity as the initial value
                let highestY = -Infinity;

                function createGridPoints(target) {
                    console.log(target)
                    var targetFacilities = target;
                    var targetSelection = '';
                    var targetX;
                    var targetY;
                    // default starting point
                    var startingX;
                    var startingY;

                    gridContainer.empty(); // Clear the existing grid using jQuery
                
                    serverResponds['gridDetails'].forEach(coordinates => {

                        if (!isNaN(parseInt(coordinates.x)) && parseInt(coordinates.x) > highestX) {
                            highestX = parseInt(coordinates.x);
                        
                        }

                        if (!isNaN(parseInt(coordinates.y)) && parseInt(coordinates.y) > highestY) {
                            highestY = parseInt(coordinates.y);
                        }

                        if(highestX < highestY){
                                // Set the width and height of gridContainer to fit-content
                                $("#grid-container").css({
                                    'width': "fit-content",
                                    'height': "fit-content",
                                    'grid-template-rows':`repeat(${highestX+1}, 1fr)`,
                                    'grid-template-columns':`repeat(${highestY+1}, 1fr)`,
                                });
                        }else{
                                // Set the width and height of gridContainer to fit-content
                            $("#grid-container").css({
                                'width': "fit-content",
                                'height': "fit-content",
                                'grid-template-rows':`repeat(${highestX+1}, 1fr)`,
                                'grid-template-columns':`repeat(${highestY+1}, 1fr)`,
                            });
                        }

                        // console.log(coordinates)
                        const point = $("<div></div>"); // Create a new div element using jQuery
                        point.addClass("grid-point");
                        point.attr("data-x", parseInt(coordinates.x)); // Set x-coordinate as a data attribute
                        point.attr("data-y", parseInt(coordinates.y)); // Set y-coordinate as a data attribute
                        // point.text(`${parseInt(coordinates.x)},${parseInt(coordinates.y)}`); // Optionally, you can label points with their coordinates
                        // Use a ternary operator to set the text based on coordinates.label
                        point.text(coordinates.label !== null ? coordinates.label : '');
                        gridContainer.append(point); // Append the point to the grid container using jQuery
                        // point.addClass(coordinates.isBlock === 'true' ? 'blocked' : '');
                        if (coordinates.isBlock === 'true' && coordinates.label !== targetFacilities && coordinates.label !== 'front') {
                            point.addClass('blocked');
                            targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                        } else if (coordinates.label === targetFacilities) {
                            point.addClass('targetFacilities');
                            targetX = parseInt(coordinates.x);
                            targetY = parseInt(coordinates.y);
                            targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                        } else if (coordinates.label === 'front'){
                            startingX = parseInt(coordinates.x);
                            startingY = parseInt(coordinates.y);
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
                createGridPoints(facility);

                // Dijkstra's Algorithm
                async function dijkstra(startX, startY, endX, endY) {
                    try {
                        const startNode = document.querySelector(
                            `[data-x="${startX}"][data-y="${startY}"]`
                        );
                        const endNode = document.querySelector(
                            `[data-x="${endX}"][data-y="${endY}"]`
                        );

                        const width = highestX+1; // Adjust to match the width of the grid
                        const height = highestY+1; // Adjust to match the height of the grid

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
                    
                    }
                }

                // Helper function to add a delay for animation
                function sleep(ms) {
                    return new Promise((resolve) => setTimeout(resolve, ms));
                }
            }
        });
    </script>
@endsection
