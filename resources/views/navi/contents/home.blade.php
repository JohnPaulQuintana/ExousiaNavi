@extends('navi.index')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/svg-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            margin-top: -150px;
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
        .modal-dialog,
        .card {
            max-width: fit-content;
            color: #fff;

        }

        /* Add a background and box-shadow to the modal content */
        .modal-content,
        .card {
            background: rgba(37, 43, 59, 0.7);
            box-shadow: rgba(37, 43, 59, 0.2) 0px 7px 29px 0px;
            /* Box shadow */
        }

        /* Position the close button on the right side of the modal header */
        .modal-header .btn-close {
            ms-auto;
            /* Push the button to the right */
        }

        /* Style for the grid container */
        .grid-container {
            padding: 10px;
            width: fit-content;
            /* Adjust the width of the floorplan */
            height: fit-content;
            /* Adjust the height of the floorplan */
            box-shadow: rgba(37, 43, 59, 0.2) 0px 7px 29px 0px;
            /* margin: 50px auto; */
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            /* Adjust the number of columns */
            grid-template-rows: repeat(4, 1fr);
            /* Adjust the number of rows */
            gap: 5px;
            /* Adjust the gap between rooms */
            background-color: #252b3b;
            background-clip: border-box;
            border: 0 solid #2d3448;
            /* Background color for the floorplan */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
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
            border: 0.5px transparent;
            /* Add borders */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            /* Specify a common font */
            font-size: 14px;
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
            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
            /* Add a subtle shadow */
        }

        /* Style for the walls (blocks) */
        .blocked {
            box-shadow: rgba(10, 10, 10, 0.1) 0px 2px 4px, rgba(0, 0, 0, 0.5) 0px 7px 13px -3px, rgba(0, 0, 0, 0.5) 0px -3px 0px inset;
            color: greenyellow;
            border: 1px solid transparent;
            transform: translateZ(20px);
            cursor: pointer;
        }

        .grid-point.block::after {
            content: attr(data-label);
            /* Set the content to the data-label attribute */
        }

        /* Style for animation */
        /* Style for animation */
        .grid-point.passed:not(.targetFacilities):not(.starting-point) {
            /* background-color: transparent; */
            background-image: url('{{ asset('backend/assets/images/footmark.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 20px 20px;
            /* Width x Height in pixels */
            transform: rotate(-90deg);
            /* Dark green for passed rooms */
            color: white;

            transition: transform ease-in-out;
            Apply the rotation animation over 3 seconds opacity: 0;
            /* Initially hide the background image */
        }

        .grid-point.passed.up:not(.targetFacilities):not(.starting-point) {
            transform: rotate(0);
            /* Rotate the background image 0 degrees*/
        }

        .grid-point.passed.right:not(.targetFacilities):not(.starting-point) {
            transform: rotate(90deg);
            /* Rotate the background image 90 degrees clockwise */
        }

        .grid-point.passed.down:not(.targetFacilities):not(.starting-point) {
            transform: rotate(180deg);
            /* Rotate the background image 90 degrees clockwise */
        }

        /* Style for animation */
        /* .grid-point.passed {
                                    background-color: transparent;
                                   
                                    color: white;
                                    border: none;
                                    animation: animatePath 4s linear infinite;
                                    
                                } */

        /* starting point */
        .starting-point {
            border: 1px solid rgb(11, 93, 234);
            transform: translateZ(20px);
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px, rgba(0, 0, 0, 0.5) 0px 7px 13px -3px, rgba(0, 0, 0, 0.5) 0px -3px 0px inset;
            color: rgb(11, 93, 234);
        }

        /* starting point */
        .targetFacilities {
            border: 1px solid rgb(11, 93, 234);
            /* border: 1px solid green; */
            /* Dark background color for walls */
            box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px, rgba(0, 0, 0, 0.5) 0px 7px 13px -3px, rgba(0, 0, 0, 0.5) 0px -3px 0px inset;
            color: rgb(11, 93, 234);
            transform: translateZ(20px);
            cursor: pointer;
            text-shadow: 2px 2px 3px rgba(7, 7, 7, 0.8);
            font-weight: 600;
        }

        .wall {
            background-color: transparent;
            /* Set the background color for the grid points */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border: .6px solid transparent;
            /* Add a border to each grid point */
            /* box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px, rgba(0, 0, 0, 0.3) 0px 1px 3px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
            transform: translateZ(10px);

        }

        /* Define the animation */
        @keyframes animatePath {
            0% {
                border: none;
                color: #06df59;
                /* background-color: green; */
                /* transform: translateZ(2px); Translate along the Z-axis to create elevation */
                /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                /* Add a subtle shadow */
            }

            25% {
                /* background-color: rgb(11, 196, 66); */
                /* transform: translateZ(20px); Translate along the Z-axis to create elevation */
                /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                /* Add a subtle shadow */
            }

            50% {
                /* background-color: rgb(15, 226, 61); */
                /* transform: translateZ(5px); Translate along the Z-axis to create elevation */
                /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                /* Add a subtle shadow */
            }

            75% {
                /* background-color: rgb(32, 88, 209); */
                /* transform: translateZ(15px); Translate along the Z-axis to create elevation */
                /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                /* Add a subtle shadow */
            }

            100% {
                /* background-color: green; */
                /* transform: translateZ(10px); Translate along the Z-axis to create elevation */
                /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                /* Add a subtle shadow */
            }
        }
    </style>

    {{-- updating system --}}
    <style>
        /* Background Overlay */
        .overlay-updates {
            visibility: hidden;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(38, 48, 36, 0.9);
            z-index: 1;
            /* Ensure it's above other content */
            opacity: 0;
            /* Initially hidden */
            transition: ease 0.5s;
            /* Smooth transition effect */
        }

        .overlay-updates.active {
            visibility: visible;
            opacity: 1;
            transition: ease 0.6s;
        }

        /* Popup Container */
        .popup {
            visibility: hidden;
            position: fixed;
            top: 50%;
            left: 50%;
            border-radius: 5px;
            transform: translate(-50%, -50%);
            background: rgba(38, 48, 36, 0.4);
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /* Box shadow */
            min-width: 50%;
            padding: 20px;
            z-index: 2;
            /* Ensure it's above the overlay */
            opacity: 0;
            /* Initially hidden */
            transition: ease 0.5s;
            /* Smooth transition effect */
        }

        .popup.active {
            visibility: visible;
            opacity: 1;
            transition: ease 0.6s;
        }

        .loading-container {
            perspective: 800px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 50vh;
        }

        .title {
            position: absolute;
            top: 0;
            background: linear-gradient(45deg, rgba(65, 230, 79, 1), rgb(233, 233, 227), rgb(0, 255, 21));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .loading-cube {
            width: 100px;
            height: 100px;
            transform-style: preserve-3d;
            animation: loading 5s infinite linear;
        }

        .loading-face {
            width: 100px;
            height: 100px;
            position: absolute;
            background-color: transparent;
            border: 2px solid rgba(9, 46, 2, 0.4);
            box-shadow: 0 0 5px rgba(2, 134, 123, 0.5);
            display: flex;
            flex-direction: column;
            /* Display text below icon */
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transform: translateZ(50px);
            transition: transform 0.5s ease-in-out, color 1s ease-in-out;
            /* Added color transition */
        }

        .loading-face:nth-child(1) {
            transform: rotateY(0deg) translateZ(52px);
            color: #FF5733;
            /* Red */
        }

        .loading-face:nth-child(2) {
            transform: rotateY(90deg) translateZ(52px);
            color: #33FF57;
            /* Green */
        }

        .loading-face:nth-child(3) {
            transform: rotateY(180deg) translateZ(52px);
            color: #5733FF;
            /* Blue */
        }

        .loading-face:nth-child(4) {
            transform: rotateY(270deg) translateZ(52px);
            color: #FF33EC;
            /* Pink */
        }

        .loading-face:nth-child(5) {
            transform: rotateX(90deg) translateZ(52px);
            color: #F3FF33;
            /* Yellow */
        }

        .loading-face:nth-child(6) {
            transform: rotateX(-90deg) translateZ(52px);
            color: #33A6FF;
            /* Light Blue */
        }

        .loading-cube.loaded .loading-face {
            transform: translateZ(0);
        }

        @keyframes loading {
            0% {
                transform: rotateX(0deg) rotateY(0deg);
            }

            100% {
                transform: rotateX(360deg) rotateY(360deg);
            }
        }

        .loading-text {
            font-size: 24px;
            margin-top: -100px;
            text-align: center;
            background: linear-gradient(45deg, rgba(65, 230, 79, 1), rgb(233, 233, 227), rgb(0, 255, 21));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textAnimation 1s infinite alternate;
            /* Text animation */
            font-weight: 500;
        }

        /* Animation for text */
        @keyframes textAnimation {
            0% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>

    {{-- popup answer --}}
    <style>
        .answerbtn {
            font-size: 26px;
            margin-left: 10px;
        }
    </style>

    {{-- browsing --}}
    <style>
        .main_back {
            position: absolute;
            border-radius: 10px;
            transform: rotate(90deg);
            width: 15em;
            height: 15em;
            background: transparent;
            /* margin-top: -150px; */
            z-index: -2;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .main {
            display: flex;
            flex-wrap: wrap;
            width: 14em;
            align-items: center;
            margin-top: -100px;
            justify-content: center;
            /* z-index: -1; */
        }

        .browseCard {
            width: 150px;
            height: 60px;
            border-top-left-radius: 10px;
            background: transparent;
            transition: .4s ease-in-out, .2s background-color ease-in-out, .2s background-image ease-in-out;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /* backdrop-filter: blur(5px); */
            border: 1px solid transparent;
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.2);
            margin: .2em;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            text-shadow: 3px 2px 2px rgb(1, 3, 2);
            font-weight: 600;
            text-transform: capitalize;
            word-spacing: 3rem;
        }

        .browseCard .facilities {
            /* opacity: 0; */
            transition: .2s ease-in-out;
            fill: rgba(14, 59, 3, 0.9);
        }

        .browseCard:nth-child(2) {
            border-radius: 0px;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .browseCard:nth-child(2) .teachers {
            /* opacity: 0; */
            transition: .2s ease-in-out;
            fill: rgba(14, 59, 3, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .label {
            /* opacity: 0; */
        }

        .browseCard:nth-child(3) {
            border-top-right-radius: 10px;
            border-top-left-radius: 0px;
        }

        .browseCard:nth-child(3) .events {
            /* opacity: 0; */
            transition: .2s ease-in-out;
            fill: rgba(14, 59, 3, 0.9);

        }

        .main:hover {
            width: 15em;
            cursor: pointer;
        }


        .main:hover .text {
            opacity: 0;
            z-index: -3;
        }

        .main:hover .label {
            opacity: 1;
        }

        .main:hover .facilities {
            opacity: 1;
        }

        .main:hover .teachers {
            opacity: 1;
        }

        .main:hover .events {
            opacity: 1;
        }

        .browseCard:nth-child(1):hover .facilities {
            fill: rgb(255, 255, 255);
        }

        .browseCard:nth-child(2):hover .teachers {
            fill: white;
        }

        .browseCard:nth-child(3):hover .events {
            fill: white;
        }


        .text {
            position: absolute;
            font-size: 0.9em;
            transition: .4s ease-in-out;
            color: white;
            text-align: center;
            font-weight: bold;
            letter-spacing: 0.50em;
            z-index: 3;
        }

        box-icon[name='building'] {
            width: 60px;
            /* Set the width to your desired size */
            height: 60px;
            /* Set the height to your desired size */
        }

        box-icon[name='user-rectangle'] {
            width: 60px;
            /* Set the width to your desired size */
            height: 60px;
            /* Set the height to your desired size */
        }

        box-icon[name='calendar-event'] {
            width: 60px;
            /* Set the width to your desired size */
            height: 60px;
            /* Set the height to your desired size */
        }

        .label {
            text-align: center;
            font-size: 15px;
            /* Adjust font size as needed */
            margin-top: 15px;
            /* Adjust margin as needed */
            font-weight: 700;
            color: white;

        }
    </style>

    {{-- info --}}
    <style>
        .overlay-updates {
            visibility: hidden;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(38, 48, 36, 0.9);
            z-index: 1;
            /* Ensure it's above other content */
            opacity: 0;
            /* Initially hidden */
            transition: ease 0.5s;
            /* Smooth transition effect */
        }

        .overlay-updates.active {
            visibility: visible;
            opacity: 1;
            transition: ease 0.6s;
        }

        /* Popup Container */
        #popup-searchingInfo {
            visibility: hidden;
            position: fixed;
            top: 50%;
            left: 50%;
            border-radius: 5px;
            transform: translate(-50%, -50%);
            background: rgba(38, 48, 36, 0.4);
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /* Box shadow */
            min-width: 70%;
            padding: 20px;
            z-index: 2;
            /* Ensure it's above the overlay */
            opacity: 0;
            /* Initially hidden */
            transition: ease 0.5s;
            /* Smooth transition effect */
        }

        #popup-searchingInfo.active {
            visibility: visible;
            opacity: 1;
            transition: ease 0.6s;
        }

        #popup-searchingInfo .loading-container .info-container {
            position: relative;
            top: 30px;
            width: 100%;
            height: 250px;
            background: rgba(38, 48, 36, 0.4);
            border-radius: 10px;
            /* overflow-y: auto; */
        }

        #popup-searchingInfo .loading-container .info-container .information-container {
            height: 200px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Adjust the number of columns as needed */
            gap: 5px;
            /* Adjust the gap between grid items */
            overflow-y: auto;
            padding: 10px;
        }

        /* Optional: Style for the <p> elements */
        .information-container span {
            padding: 10px;
            max-height: 50px;
            background: linear-gradient(45deg, rgba(65, 230, 79, 1), rgb(233, 233, 227), rgb(0, 255, 21));
            --webkit-background-clip: text;
            --webkit-text-fill-color: transparent;
            border-radius: 10px;
            font-weight: 700;
            color: rgba(14, 59, 3, 1);
            /* border: 1px solid #ddd; */
            text-align: center;
            margin-bottom: 3px;
            /* Adjust the margin as needed */
            cursor: pointer;
        }


        .info-container .search-input {
            color: #fff;
            border-radius: 10px;
            padding: 10px 25px;
            background: transparent;
            /* width: 80%; */

        }

        /* Change the color of the placeholder text */
        .search-input::placeholder {
            color: #fff;
        }

        #searchingInfo-Cancel {
            position: absolute;
            right: 5px;
            top: 5px;
            font-size: 24px;
        }
    </style>

    {{-- frequently ask --}}
    <style>
        .loading-container.l-ask {
            max-height: 500px;
            overflow-y: auto;
            padding-top: 10px;
            justify-content: inherit;
        }

        .loading-container.l-ask::-webkit-scrollbar {
            width: 0;
        }

        .browseCard-ask {
            cursor: pointer;
            width: 100%;
            background: rgba(255, 255, 255, 0.034);
            display: flex;
            gap: 10px;
            word-break: break-all;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 4px;
            margin-top: 4px;
            color: white;
            text-shadow: 3px 2px 2px rgb(1, 3, 2);
            font-size: 18px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .browseCard-ask i {
            color: green;
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
            @include('navi.loaderPage.preloader')
        </div>

    </div>

    <main>
        {{-- {{ $systems }} --}}
        <span id="svg-title" class="text-white">
            <b>
                <svg class="icons" data-id="search" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path
                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 20l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    <path d="M0 0h24v24H0z" fill="none" />
                </svg>

            </b>
        </span>
        <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="ask" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 4C9.243 4 7 6.243 7 9h2c0-1.654 1.346-3 3-3s3 1.346 3 3c0 1.069-.454 1.465-1.481 2.255-.382.294-.813.626-1.226 1.038C10.981 13.604 10.995 14.897 11 15v2h2v-2.009c0-.024.023-.601.707-1.284.32-.32.682-.598 1.031-.867C15.798 12.024 17 11.1 17 9c0-2.757-2.243-5-5-5zm-1 14h2v2h-2z">
                    </path>
                </svg></b>
        </span>
        {{-- <span id="svg-title" class="text-white">
            <b><svg class="icons" data-id="mic" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M6 12H4c0 4.072 3.061 7.436 7 7.931V22h2v-2.069c3.939-.495 7-3.858 7-7.931h-2c0 3.309-2.691 6-6 6s-6-2.691-6-6z">
                    </path>
                    <path
                        d="M8 12c0 2.206 1.794 4 4 4s4-1.794 4-4h-2v-2h2V8h-2V6h2c0-2.217-1.785-4.021-3.979-4.021a.933.933 0 0 0-.209.025A4.006 4.006 0 0 0 8 6h4v2H8v2h4v2H8z">
                    </path>
                </svg></b>
        </span> --}}
        @php
            $auth = $systems[0]->status;
            if ($auth) {
                $className = 'icons';
            } else {
                $className = 'disabled';
            }
        @endphp
        <span id="svg-title" class="text-white">
            <b><svg class="{{ $className }}" data-id="speech" xmlns="http://www.w3.org/2000/svg" width="30"
                    height="40" viewBox="0 0 24 24">
                    <path
                        d="M8 12.052c1.995 0 3.5-1.505 3.5-3.5s-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5 1.505 3.5 3.5 3.5zM9 13H7c-2.757 0-5 2.243-5 5v1h12v-1c0-2.757-2.243-5-5-5zm9.364-10.364L16.95 4.05C18.271 5.373 19 7.131 19 9s-.729 3.627-2.05 4.95l1.414 1.414C20.064 13.663 21 11.403 21 9s-.936-4.663-2.636-6.364z">
                    </path>
                    <path
                        d="M15.535 5.464 14.121 6.88C14.688 7.445 15 8.198 15 9s-.312 1.555-.879 2.12l1.414 1.416C16.479 11.592 17 10.337 17 9s-.521-2.592-1.465-3.536z">
                    </path>
                </svg></b>
        </span>
        @php
            $auth = $systems[2]->status;
            if ($auth) {
                $className = 'icons';
            } else {
                $className = 'disabled';
            }
        @endphp
        <span id="svg-title" class="text-white">
            <b><svg class="{{ $className }}" data-id="scanner" xmlns="http://www.w3.org/2000/svg" width="40"
                    height="40" viewBox="0 0 24 24">
                    <path d="M4 4h4.01V2H2v6h2V4zm0 12H2v6h6.01v-2H4v-4zm16 4h-4v2h6v-6h-2v4zM16 4h4v4h2V2h-6v2z"></path>
                    <path
                        d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z">
                    </path>
                </svg></b>
        </span>
    </main>

    @php
        $auth = $systems[1]->status;
        if ($auth) {
            $className = '';
        } else {
            $className = 'hidden';
        }
    @endphp
    <main-form id="in">
        <div id="chat_container" hidden></div>
        <form>
            <input type="text" id="key" value="" name="id" hidden>
            <input type="text" id="query" value="" name="query" hidden>
            <textarea id="input" name="prompt" rows="1" cols="1" class="form-control" {{ $className }}
                placeholder="Enter your query or use the mic button"></textarea>
            <!-- <button type="submit"><img src="assets/send.svg" alt="send" /> -->
        </form>
    </main-form>

    <section>
        <!-- frrequently ask -->
        <div class="popup" id="popup-ask">
            <div class="loading-container l-ask">
                @foreach ($frequentlies as $frequently)
                    <div class="browseCard-ask" id="frequently-question" data-id="{{ $frequently->frequently }}">
                        <i class="ri-question-fill"></i>
                        <span>{{ $frequently->frequently }}</span>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Designated -->
        <div class="popup" id="popup-designated">
            <span class="text-white"
                style="text-shadow: 3px 2px 2px rgb(1, 3, 2);font-size: 18px;font-weight: 600;text-transform: capitalize;">
                Available Teacher's on <span class="at"></span>
            </span>
            <button type="button" class="btn-close bg-danger" id="preview-Cancel" style="float: right;"></button>
            <div class="loading-container l-des mt-2">
                <div class="browseCard-ask">
                    <i class="fas fa-question-circle fa-3x"></i>
                    <span class="me-auto">Look's like there is no record here.</span>
                </div>
            </div>
        </div>
        {{-- <div class="container" id="popupask">
            <div class="content">
                <div id="frequently-ask">
                    @foreach ($frequentlies as $frequently)
                        <span data-id="{{ $frequently->frequently }}"
                            id="frequently-question">{{ $frequently->frequently }}</span>
                    @endforeach
                </div>
            </div>
        </div> --}}

        <!-- location popups -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title me-2" id="exampleModalLabel">
                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                            Navigation Guide <span id="span-floor"></span>
                        </h5>
                        <div class="row">
                            <div class="col-auto">
                                <button type="button" class="btn btn-success" id="back-floor-button">
                                    <i class="bi bi-arrow-left"></i> Back
                                </button>
                            </div>
                            <div class="col-auto mx-2"> <!-- Add mx-2 class for horizontal margin -->
                                <button type="button" class="btn btn-success" id="next-floor-button">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            <div class="col-auto mx-2"> <!-- Add mx-2 class for horizontal margin -->
                                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
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

        <!-- updating systems popups -->
        <div class="overlay-updates" id="overlay-updates"></div>
        <div class="popup" id="popup">
            <div class="loading-container">
                <div class="title">
                    <div id="title" class="text-center text-white h1"><b>EXOUSIA-NAVI</b></div>
                    <span id="sec-title" class="text-white"><b>Eastwoods Professional College</b></span>
                </div>
                <div class="loading-cube" id="loadingCube">
                    <div class="loading-face">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="loading-face">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="loading-face">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="loading-face">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="loading-face">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="loading-face">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                </div>
            </div>
            <div class="loading-text" id="loadingText">Loading...</div>
        </div>

        <!-- waiting for answer systems popups -->
        <div class="popup" id="popup-continuation">
            <div class="loading-container">
                <div class="title">
                    <div id="title" class="text-center text-white h1"><b>EXOUSIA-NAVI</b></div>
                    <span id="sec-title" class="text-white"><b>Eastwoods Professional College</b></span>
                </div>
                <span id="title sec-title" class="text-white mb-2"><b>Click your answer below!</b></span>
                <div class="answer-handler">
                    <button type="button" class="btn btn-success answerbtn" data-value="yes">Yes</button>
                    <button type="button" class="btn btn-danger answerbtn" data-value="no">No</button>
                </div>
            </div>
        </div>

        <!-- waiting for answer systems popups for teachers-->
        <div class="popup" id="popup-continuation-teacher">
            <div class="loading-container">
                <div class="title">
                    <div id="title" class="text-center text-white h1"><b>EXOUSIA-NAVI</b></div>
                    <span id="sec-title" class="text-white"><b>Eastwoods Professional College</b></span>
                </div>
                <span id="title sec-title" class="text-white text-center mb-2"
                    style="text-shadow:3px 2px 2px rgb(1, 3, 2); text-transform:capitalize; ">
                    <b>Would you like it to know where its located?</b>
                </span>
                <div class="answer-handler">
                    <button type="button" class="btn btn-success answerbtnT" data-value="yes">Yes</button>
                    <button type="button" class="btn btn-danger answerbtnT" data-value="no">No</button>
                </div>
            </div>
        </div>

        <!-- searching popups options-->
        <div class="popup" id="popup-searching">
            <div class="loading-container">
                {{-- <div class="title">
                    <div id="title" class="text-center text-white h1"><b>EXOUSIA-NAVI</b></div>
                    <span id="sec-title" class="text-white"><b>Eastwoods Professional College</b></span>
                </div> --}}
                <div class="browsing-handler mt-5">
                    <div class="main">
                        <div class="browseCard" data-value="facilities" data-model="EastwoodsFacilities">
                            <box-icon type='solid' name='building' class="facilities"
                                data-value="facilities"></box-icon>
                            <p class="label">Facilities</p> <!-- Add label for facilities -->
                        </div>
                        <div class="browseCard" data-value="teachers" data-model="Teacher">
                            <box-icon type='solid' name='user-rectangle' class="teachers"
                                data-value="teachers"></box-icon>
                            <p class="label">Teachers</p> <!-- Add label for teachers -->
                        </div>
                        {{-- <div class="browseCard" data-value="events" data-model="Event">
                            <box-icon type='solid' name='calendar-event' class="events" data-value="events"></box-icon>
                            <p class="label">Events</p> <!-- Add label for events -->
                        </div> --}}
                        <p class="text"></p>
                        <div class="main_back"></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- searching popups info -->
        <div id="popup-searchingInfo">
            <button type="button" class="btn-close bg-danger" id="searchingInfo-Cancel"></button>
            <div class="loading-container">
                <!-- Back icon added here -->
                {{-- <span class='bx bx-arrow-back bg-danger'></span> --}}
                <div class="title">
                    <div id="title" class="text-center text-white h1">
                        <b>EXOUSIA-NAVI</b>
                    </div>
                    <span id="sec-title" class="text-white info-title"><b>Eastwoods Professional College</b></span>
                </div>

                <div class="info-container">
                    <div class="information-container">
                        <span>Default</span>

                    </div>
                    {{-- <input type="text" name="" id="search-input" class="form-control text-center mt-2" placeholder="Searching..."> --}}

                    <input type="text" id="search-input" name="text" class="search-input form-control text-white"
                        placeholder="Type something here....">
                </div>
            </div>
        </div>

    </section>

    <footer>
        <span>Capstone2-80%</span>
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

    {{-- pusher events --}}
    <script src="{{ asset('js/pusher.min.js') }}"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- materialdesign icon js-->
    {{-- <script src="{{ asset('backend/assets/js/pages/materialdesign.init.js') }}"></script> --}}
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
            let currentUtterance = null; // Store the current utterance
            let loadInterval;
            let updates = localStorage.getItem('updates') || false;

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('4ef07d09e997c8b8f24b', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('update-system');
            channel.bind('initialize-updates', function(data) {
                // Parse the JSON data
                // var eventData = JSON.parse(data);
                console.log(data.message)
                var message = data.message
                input.hide();
                startToSpeak(message)
                    .then((finished) => {
                        if (finished) {
                            // Speech finished
                            console.log(finished)
                            $('#overlay-updates').toggleClass('active');
                            $('#popup').toggleClass('active');
                            // Call the animateCube function to start the animation
                            animateCube();

                            setTimeout(() => {
                                // Display the overlay and popup
                                $('#overlay-updates').removeClass('active');
                                $('#popup').removeClass('active');
                                // Refresh the page
                                var currentURL = window.location.href;
                                window.location.href = currentURL;
                                localStorage.setItem('updates', true);
                            }, 20000);

                        } else {
                            console.log('not fineshed')

                            // Speech synthesis not supported
                            // Handle accordingly
                        }
                    });
            });

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

            // frequently ask
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

            // answer by yes or no
            $(document).on('click', '.answerbtn', async function() {
                var a = $(this).data('value')
                const response = await fetch('/navi/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        prompt: `${a}`,
                    }),

                });
                $('#overlay-updates').toggleClass('active');
                $('#popup-continuation').toggleClass('active');
                // const responseData = await response.json();
                handleResponse(response)
            })
            // answer by yes or no for teachers
            $(document).on('click', '.answerbtnT', async function() {
                var a = $(this).data('value')
                const response = await fetch('/navi/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        prompt: `${a}`,
                    }),

                });
                $('#overlay-updates').removeClass('active');
                $('#popup-continuation').removeClass('active');

                $('#popup-continuation-teacher').removeClass('active');
                // const responseData = await response.json();
                handleResponse(response)
            })

            // svg clicked handler
            $(document).on('click', 'svg', function() {
                var svg = $(this).data('id')
                console.log(svg)
                switch (svg) {
                    // frequently ask
                    case 'ask':
                        $('#popup-ask').toggleClass('active');
                        $('#popup-searching').removeClass('active');
                        break;
                        // browsing
                    case 'search':
                        $('#popup-ask').removeClass('active');
                        $('#popup-searching').toggleClass('active');
                        break;
                    case 'speech':
                        if ($(this).hasClass('disabled')) {
                            var mess =
                                "We apologize, but our speech recognition service is currently temporary unavailable. The icons have been highlighted in red to indicate this issue. Please try again at a later time. Thank you for your understanding.";
                            startToSpeak(mess)
                                .then((finished) => {
                                    if (finished) {
                                        // Speech finished
                                        console.log(finished)
                                    }
                                });
                        } else {
                            var mess =
                                "Speak Recognition Initialized!. What can i do for you?";
                            const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
                            recognition.continuous = true;
                            // recognition.interimResults = true;
                            // recognition.maxAlternatives = 5;

                            let isListening = false;

                            function wishMe() {
                                var day = new Date();
                                var hour = day.getHours();

                                if (hour >= 0 && hour < 12) {
                                    startToSpeak("Good Morning..." + mess)
                                    .then((s)=>{
                                        if(s){
                                            console.log('done speaking...')
                                            recognition.start();
                                        }
                                    })
                                } else if (hour > 12 && hour < 17) {
                                    startToSpeak("Good Afternoon..." + mess)
                                    .then((s)=>{
                                        if(s){
                                            console.log('done speaking...')
                                            recognition.start();
                                        }
                                    })
                                } else {
                                    startToSpeak("Good Evening..." + mess)
                                    .then((s)=>{
                                        if(s){
                                            console.log('done speaking...')
                                            recognition.start();
                                        }
                                    })
                                }
                            }

                            wishMe();

                            recognition.onresult = function(event) {
                                const currentIndex = event.resultIndex;
                                const transcript = event.results[currentIndex][0].transcript;
                                // console.log(transcript);//we need to display the text to input later with modal show
                                // if (!isListening) {
                                //     recognition.stop(); // Stop recognition if not listening
                                    takeCommand(transcript.toLowerCase());
                                // }
                            };

                            recognition.onspeechstart = () => {
                                console.log("Speech has been detected");
                                isListening = true;
                            };

                            recognition.onspeechend = () => {
                                console.log("Speech has stopped being detected");
                                isListening = false;
                            };

                            function takeCommand(message) {
                                console.log(message)
                                startToSpeak(message + 'I am right?')
                                
                                // recognition.start(); // Resume recognition after responding
                            }

                            
                            // startToSpeak(mess)
                            //     .then((finished) => {
                            //         if (finished) {
                            //             // Speech finished
                            //             console.log(finished)
                            //         }
                            //     });
                        }

                    case 'scanner':
                        if ($(this).hasClass('disabled')) {
                            var scannerMess =
                                "We apologize, but there is currently a scanner issue. Scanning functionality is temporarily unavailable. The icons have been highlighted in red to indicate this issue. Please try again at a later time. Thank you for your understanding.";

                            startToSpeak(scannerMess)
                                .then((finished) => {
                                    if (finished) {
                                        // Speech finished
                                        console.log(finished)
                                    }
                                });
                        }
                    default:
                        break;
                }

            })

            // box-icons
            $(document).on('click', '.browseCard', async function() {
                var bxi = $(this).data('value')
                var bxiModel = $(this).data('model')
                // alert(bxi)
                const response = await fetch('/navi/process/information', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        requestInfo: `${bxi}`,
                        modelClass: bxiModel,
                    }),

                });
                handleResponseInfo(response)
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

                        $('#popup-ask').removeClass('active')
                        // startToSpeak(parsedData.answer)

                        startToSpeak(parsedData.answer)
                            .then((finished) => {
                                if (finished) {
                                    // Speech finished
                                    console.log(finished)
                                    $('#overlay-updates').removeClass('active');
                                    $('#popup-continuation').removeClass('active');
                                    if (responseData.floor !== "false") {
                                        console.log(responseData.continuation)
                                        if (responseData.continuation !== false && responseData
                                            .continuation !== undefined && responseData.continuation !==
                                            'information') {
                                            processFacilitiesNavigation(responseData.floor, responseData
                                                .facility)
                                            $("#myModal").modal("show");

                                        } else if (responseData.continuation !== 'information') {
                                            $('#overlay-updates').toggleClass('active');
                                            $('#popup-continuation').toggleClass('active');
                                        } else {
                                            $('#popup-continuation-teacher').toggleClass('active');
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

            // handle response for information
            const handleResponseInfo = async (response) => {
                if (response.ok) {
                    const responseData = await response.json();
                    $('#popup-searching').removeClass('active');
                    $('#popup-searchingInfo').toggleClass('active');
                    // console.log(responseData)
                    $('.info-title').text(`Available's Information on ${responseData.modelClass}`)
                    var html = ''
                    responseData.informations.forEach((info, key) => {
                        // console.log(info)
                        switch (responseData.modelClass) {
                            case "EastwoodsFacilities":
                                html += `
                                    <span class="grid-item" data-info-model="${responseData.modelClass}" data-info-id="${info.id}" data-info-search="${info.facilities}">${info.facilities.toUpperCase()}</span>
                                `
                                break;
                            case "Teacher":
                                html += `
                                    <span class="grid-item" data-info-model="${responseData.modelClass}" data-flo="${info.floor}" data-faci="${info.facility_name}" data-info-id="${info.id}" data-info-search="${info.name}">${info.name.toUpperCase()}</span>
                                `
                                break;

                            default:
                                break;
                        }
                    })
                    $('.information-container').html(html)

                    // search functionality
                    $('#search-input').on('input', function() {
                        const searchQuery = $(this).val().toLowerCase();

                        // Filter grid items based on the search query
                        $('.grid-item').each(function() {
                            const itemText = $(this).text().toLowerCase();
                            if (itemText.includes(searchQuery)) {
                                $(this).show(); // Display matching items
                            } else {
                                $(this).hide(); // Hide non-matching items
                            }
                        });
                    });

                    // click handler on grid-item
                    $(document).off('click', '.grid-item').on('click', '.grid-item', async function() {
                        var infoModel = $(this).data('info-model')
                        var infoId = $(this).data('info-id')
                        var dataFaci = $(this).data('faci')
                        var dataFlo = $(this).data('flo')
                        // just for now
                        var prompt = $(this).data('info-search')

                        $('#popup-searching').removeClass('active');
                        $('#popup-searchingInfo').toggleClass('active');

                        const response = await fetch('/navi/process/search', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                infoModel: `${infoModel}`,
                                infoId: `${infoId}`,
                                prompt: `${prompt}`,
                                teacherLocation: dataFaci,
                                locationFloor: dataFlo,
                            }),

                        });
                        $('#overlay-updates').removeClass('active');
                        $('#popup-searchingInfo').removeClass('active');

                        $('#popup-continuation').removeClass('active');
                        // const responseData = await response.json();
                        handleResponse(response)
                    })

                    $(document).off('click', '#searchingInfo-Cancel').on('click', '#searchingInfo-Cancel',
                        function() {
                            $('#popup-searchingInfo').removeClass('active');
                            $('#popup-searching').toggleClass('active');
                        });

                } else {
                    const err = await response.text();
                    // messageDiv.html("Something went wrong");
                    alert(err);
                }
            }

            // Function to stop the current speech synthesis
            const stopSpeaking = () => {
                if (currentUtterance) {
                    speechSynthesis.cancel(); // Cancel the current utterance
                    currentUtterance = null; // Clear the current utterance reference
                }
            };
            // speak
            const startToSpeak = async (sentence) => {
                // Stop any ongoing speech before starting a new one
                stopSpeaking();
                // speak
                input.hide()
                if ('speechSynthesis' in window) {
                    return new Promise((resolve, reject) => {
                        const utterance = new SpeechSynthesisUtterance();
                        utterance.volume = 1;
                        utterance.rate = 0.9;
                        utterance.pitch = 1;
                        utterance.text = sentence;

                        // Store the current utterance
                        currentUtterance = utterance;
                        var index = 1;
                        for (index; index < window.speechSynthesis.getVoices().length; index++) {
                            if (window.speechSynthesis.getVoices()[index].voiceURI.search(
                                    'Zeera') != -1) {
                                utterance.voice = window.speechSynthesis.getVoices()[index];
                            }
                        }
                        utterance.voice = window.speechSynthesis.getVoices()[index];

                        setTimeout(() => {
                            utterance.voice = window.speechSynthesis.getVoices()[1];
                        }, 1000);

                        utterance.addEventListener('end', () => {
                            console.log('Speech finished');
                            currentUtterance =
                                null; // Clear the current utterance reference when speech finishes
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

                                    resolve(
                                        true
                                    ); // Resolve the Promise when speech finishes
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
                $('#next-floor-button').hide();
                $('#back-floor-button').hide();
                const response = await fetch('/navi/process/navigation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        floor: `${floor}`,
                        facility: `${facility}`,
                    }),

                });
                // const responseData = await response.json();
                // handleResponse(response)
                const responseData = await response.json();

                console.log(responseData.details)
                var serverResponds = responseData.details;
                const gridContainer = $("#grid-container");
                let gridPoints = [];
                let floorIndex = 0;
                let len = serverResponds.length;
                let startingPoint;
                let isTargetFound = false;
                let highestX = -Infinity; // Start with negative infinity as the initial value
                let highestY = -Infinity;

                var targetFacilities;
                var targetSelection = '';
                var targetX;
                var targetY;
                // default starting point
                var startingX;
                var startingY;

                function createGridPoints(target, prevBool) {
                    if (floorIndex < len) {
                        // $('#next-floor-button').hide();
                        // $('#back-floor-button').hide();
                        console.log('count', floorIndex, '<', len)
                        console.log(serverResponds[floorIndex]['gridDetails'])
                        $('#span-floor').text(serverResponds[floorIndex]['floor'])
                        console.log(serverResponds[floorIndex]['floor'])
                        targetFacilities = target;

                        gridContainer.empty(); // Clear the existing grid using jQuery
                        // && serverResponds['gridDetails'] && Array.isArray(serverResponds['gridDetails'])
                        if (serverResponds && serverResponds[floorIndex]['gridDetails'] && Array.isArray(
                                serverResponds[floorIndex]['gridDetails'])) {
                            // serverResponds.forEach(floor => {
                            // console.log(floor)
                            serverResponds[floorIndex]['gridDetails'].forEach(coordinates => {
                                if (!isNaN(parseInt(coordinates.x)) && parseInt(coordinates.x) >
                                    highestX) {
                                    highestX = parseInt(coordinates.x);

                                }

                                if (!isNaN(parseInt(coordinates.y)) && parseInt(coordinates.y) >
                                    highestY) {
                                    highestY = parseInt(coordinates.y);
                                }

                                if (highestX < highestY) {
                                    // Set the width and height of gridContainer to fit-content
                                    $("#grid-container").css({
                                        'width': "fit-content",
                                        'height': "fit-content",
                                        'grid-template-rows': `repeat(${highestX+1}, 1fr)`,
                                        'grid-template-columns': `repeat(${highestY+1}, 1fr)`,
                                    });
                                } else {
                                    // Set the width and height of gridContainer to fit-content
                                    $("#grid-container").css({
                                        'width': "fit-content",
                                        'height': "fit-content",
                                        'grid-template-rows': `repeat(${highestX+1}, 1fr)`,
                                        'grid-template-columns': `repeat(${highestY+1}, 1fr)`,
                                    });
                                }

                                // console.log(coordinates)
                                const point = $(
                                    "<div></div>"); // Create a new div element using jQuery
                                point.addClass("grid-point");
                                point.attr("data-x", parseInt(coordinates
                                    .x)); // Set x-coordinate as a data attribute
                                point.attr("data-y", parseInt(coordinates
                                    .y)); // Set y-coordinate as a data attribute
                                // point.text(`${parseInt(coordinates.x)},${parseInt(coordinates.y)}`); // Optionally, you can label points with their coordinates
                                // Use a ternary operator to set the text based on coordinates.label
                                point.text(coordinates.label !== null ? truncateText(coordinates
                                    .label, 7) : '');
                                gridContainer.append(point).fadeIn(
                                    'slow'); // Append the point to the grid container using jQuery
                                // point.addClass(coordinates.isBlock === 'true' ? 'blocked' : '');
                                if (coordinates.isBlock === 'true' && coordinates.label !==
                                    targetFacilities && coordinates.label !== 'front' && coordinates
                                    .label !== 'stair-in' && coordinates.label !== 'wall') {
                                    point.addClass('blocked');
                                    // targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                                } else if (coordinates.label === targetFacilities) {
                                    point.addClass('targetFacilities');
                                    targetX = parseInt(coordinates.x);
                                    targetY = parseInt(coordinates.y);
                                    // targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                                    // Set the flag to true when the target is found
                                    isTargetFound = true;
                                } else if (coordinates.label === 'front') {
                                    startingX = parseInt(coordinates.x);
                                    startingY = parseInt(coordinates.y);
                                    point.addClass('starting-point');
                                    point.text('')
                                    point.append(`<i class="fa-solid fa-street-view fa-2xl"></i>`)
                                } else if (coordinates.label === 'wall') {
                                    point.addClass('blocked wall');
                                }

                                if (isTargetFound === false && coordinates.label === 'stair-in') {
                                    console.log('not found')
                                    point.addClass('targetFacilities');
                                    targetX = parseInt(coordinates.x);
                                    targetY = parseInt(coordinates.y);
                                    // console.log(coordinates.label,targetX, targetY)
                                    // targetSelection += `<option value="${coordinates.label}">${coordinates.label}</option>`
                                }

                                if (coordinates.label === 'wall') {
                                    point.addClass('blocked wall');
                                    point.text('')
                                    point.append(
                                        `<i class="fa-regular fa-rectangle-xmark fa-lg" style="color: #511f24;"></i>`
                                    )
                                }
                                if (coordinates.label === 'male') {
                                    console.log('yes')
                                    point.text('')
                                    point.append(
                                        `<i class="fa-solid fa-person fa-2xl" style="color: #0f56d2;"></i>`
                                    )
                                }
                                if (coordinates.label === 'female') {
                                    point.text('')
                                    point.append(
                                        `<i class="fa-solid fa-person-dress fa-2xl" style="color: #eb05c1;"></i>`
                                    )
                                }
                                if (coordinates.label === 'stair-in') {
                                    point.text('')
                                    point.append(
                                        `<i class="fa-solid fa-stairs fa-2xl" style="color: #0f56d2;"></i>`
                                    )
                                }
                                if (coordinates.label === 'guard') {
                                    point.text('')
                                    point.append(
                                        `<i class="fa-solid fa-person-military-pointing fa-2xl"></i>`
                                    )
                                }

                                // Add the point to the gridPoints array
                                gridPoints.push(point);
                                // $('#target-selection').html(targetSelection);


                            });
                            // console.log()
                            // starting point x, y  target x,y
                            dijkstra(startingX, startingY, targetX, targetY);



                            // speak the guidelines
                            startToSpeak(responseData.navigationMessage[floorIndex])

                            if (!prevBool) {
                                floorIndex++; // Move to the next floor
                                setTimeout(() => createGridPoints(facility, false),
                                    10000); // Display the next floor after 10 seconds
                            }


                        } else {
                            console.log('gridDetails is null or not an array');
                        }
                    } else {
                        $('#next-floor-button').fadeIn('slow');
                        $('#back-floor-button').fadeIn('slow');
                    }
                }

                // Back button preview
                $(document).on('click', '#back-floor-button', function() {
                    if (floorIndex > 0) {
                        console.log(floorIndex);
                        floorIndex--; // Decrement floorIndex
                        const gridContainer = $("#grid-container");
                        // Clear the grid points and reset variables
                        gridContainer.empty();
                        gridPoints = [];
                        highestX = -Infinity;
                        highestY = -Infinity;
                        isTargetFound = false;
                        targetFacilities = '';
                        targetX = 0;
                        targetY = 0;
                        startingX = 0;
                        startingY = 0;
                        createGridPoints(facility, true);
                    } else {
                        $(this).prop("disabled", true).addClass('btn btn-secondary');
                        $('#next-floor-button').prop("disabled", false);
                    }
                });

                // Next button preview
                $(document).on('click', '#next-floor-button', function() {
                    if (floorIndex < 1) {
                        console.log(floorIndex);
                        floorIndex++; // Increment floorIndex
                        const gridContainer = $("#grid-container");
                        // Clear the grid points and reset variables
                        gridContainer.empty();
                        gridPoints = [];
                        highestX = -Infinity;
                        highestY = -Infinity;
                        isTargetFound = false;
                        targetFacilities = '';
                        targetX = 0;
                        targetY = 0;
                        startingX = 0;
                        startingY = 0;
                        createGridPoints(facility, true);
                    } else {
                        $(this).prop("disabled", true).addClass('btn btn-secondary');
                        $('#back-floor-button').prop("disabled", false);
                    }
                });


                // Function to truncate text if it exceeds a specified length
                function truncateText(text, maxLength) {
                    const withoutSpaces = text.replace(/\s/g, ''); // Remove spaces from the text
                    if (withoutSpaces.length > maxLength) {
                        let truncatedText = '';
                        let charCount = 0;
                        for (const char of text) {
                            if (char !== ' ' || charCount < maxLength) {
                                truncatedText += char;
                                if (char !== ' ') {
                                    charCount++;
                                }
                            }
                            if (charCount >= maxLength) {
                                break;
                            }
                        }
                        if (charCount < text.length) {
                            // truncatedText += '...'; // Add ellipsis if text is truncated
                        }
                        return truncatedText;
                    }
                    return text; // Text is within the maxLength limit
                }
                // Call the function to create a 10x10 grid of points
                createGridPoints(facility, false);




                // Dijkstra's Algorithm
                async function dijkstra(startX, startY, endX, endY) {
                    console.log(startX, startY, endX, endY)
                    try {
                        const startNode = document.querySelector(
                            `[data-x="${startX}"][data-y="${startY}"]`
                        );
                        const endNode = document.querySelector(
                            `[data-x="${endX}"][data-y="${endY}"]`
                        );

                        const width = highestX + 1; // Adjust to match the width of the grid
                        const height = highestY + 1; // Adjust to match the height of the grid

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
                        async function animateShortestPath(shortestPath) {
                            for (let i = 1; i < shortestPath.length; i++) {

                                const {
                                    x: currentX,
                                    y: currentY
                                } = shortestPath[i - 1];
                                const {
                                    x: nextX,
                                    y: nextY
                                } = shortestPath[i];

                                const node = grid[currentY][currentX];
                                node.classList.add(
                                    "passed"); // Highlight the current node as passed

                                // Determine the direction (up or down)
                                let directionClass = "";
                                // if (nextY < currentY) {
                                //     // alert('yes')
                                //     directionClass = "left";
                                // } else {
                                //     directionClass = "up";
                                // }
                                if (nextY < currentY) {
                                    directionClass = "left";
                                } else if (nextY > currentY) {
                                    directionClass = "right";
                                } else if (nextX < currentX) {
                                    directionClass = "up";
                                } else if (nextX > currentX) {
                                    directionClass = "down";
                                }

                                // Check if directionClass is not empty before adding it as a class
                                if (directionClass !== "") {
                                    // Create the ball element with the direction class
                                    // const ball = document.createElement("div");
                                    // ball.classList.add("ball", directionClass);
                                    node.classList.add(directionClass);

                                    // Append the ball to the grid container
                                    // node.append(ball);

                                    // Wait for 200 milliseconds (remove the ball after 200ms)
                                    await new Promise((resolve) => setTimeout(resolve, 400));

                                    // Remove the ball element
                                    // ball.remove();
                                }
                            }

                            // Repeat the animation infinitely
                            animateShortestPath(shortestPath);
                        }

                        // Start the animation
                        animateShortestPath(shortestPath);
                    } catch (error) {
                        console.log(error)
                    }
                }

                // Helper function to add a delay for animation
                function sleep(ms) {
                    return new Promise((resolve) => setTimeout(resolve, ms));
                }

            }

            // Function to generate random hex color
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Function to update cube face colors
            function updateCubeColors() {
                const cubeFaces = document.querySelectorAll('.loading-face');
                cubeFaces.forEach(face => {
                    face.style.color = getRandomColor();
                });
            }

            // Update loading text
            function updateLoadingText() {
                const loadingText = document.getElementById('loadingText');
                loadingText.textContent = 'Updating System...';
            }

            // Assemble and disassemble the cube continuously
            function animateCube() {
                const loadingCube = document.getElementById('loadingCube');
                loadingCube.classList.add('loaded');

                updateLoadingText(); // Update text initially

                // Update cube face colors in an interval
                setInterval(updateCubeColors, 500);

                setTimeout(() => {
                    loadingCube.classList.remove('loaded');
                    updateLoadingText(); // Update text after disassembling
                    setTimeout(animateCube, 2000); // Adjust the delay duration (milliseconds) as needed
                }, 1000); // Adjust the delay duration (milliseconds) as needed
            }

            // updates completed
            console.log(updates)
            // checks for updates
            if (updates !== 'false') {
                input.hide();
                var updatesCompleted =
                    "Updates Completed! Maintenance for the  system is done. We've made improvements and added new data. The system is now fully operational. Thank you for your understanding!"
                startToSpeak(updatesCompleted)
                    .then((finished) => {
                        if (finished) {
                            console.log(finished)
                            localStorage.setItem('updates', false)
                        } else {
                            console.log('not finished')
                        }
                    })
            } else {
                console.log('nothing to say')
            }

            $(document).on('click', '.targetFacilities', async function() {
                // Inside this function, 'this' refers to the clicked element
                var clickedElement = $(this).text();

                const responses = await fetch('/available', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        designated: `${clickedElement}`,
                    }),

                });

                const designatedTeachers = await responses.json();
                console.log(designatedTeachers)
                $("#myModal").modal("hide");

                $('.at').text(designatedTeachers.result.facility.facilities);
                var teach = ''

                designatedTeachers.result.teachers.forEach(ts => {

                    teach += `
                                <div class="browseCard-ask">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span class="me-auto">${ts.name}</span>
                                    <i class="fas fa-user-tie"></i>
                                    <span>${ts.position}</span>
                                </div>
                            `;

                });


                $('.l-des').html(teach)
                $('#popup-designated').toggleClass('active')

            });

            $('#preview-Cancel').on('click', function() {
                $("#myModal").modal("show");
                $('#popup-designated').removeClass('active')
            })

            // $('#popup-designated').toggleClass('active')

        });
    </script>
@endsection
