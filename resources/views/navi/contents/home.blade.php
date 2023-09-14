@extends('navi.index')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/svg-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
        <div class="container" id="popuplocation">
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
        </div>
    </section>
    <footer>
        <span>Capstone1-40%</span>
    </footer>

    <!-- Modal -->
    <div id="AssistantModal" class="modal">
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
    </div>
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
                console.log(response.ok)
                if (response.ok) {
                    const responseData = await response.json();
                    const parsedData = responseData.response;
                    console.log(parsedData)
                    if (parsedData.data) {
                        // nothing to add if true for now
                    } else {
                        // speak
                        input.hide()
                        $('#popupask').removeClass('active')
                        startToSpeak(parsedData.answer)
                    }



                    // if ('speechSynthesis' in window) {
                    //     const utterance = new SpeechSynthesisUtterance();
                    //     utterance.volume = 1;
                    //     utterance.rate = 0.9;
                    //     utterance.pitch = 1;
                    //     utterance.text = parsedData['answer'];

                    //     var index = 1;
                    //     for (index; index < window.speechSynthesis.getVoices().length; index++) {
                    //         if (window.speechSynthesis.getVoices()[index].voiceURI.search('Zeera') != -1) {
                    //             utterance.voice = window.speechSynthesis.getVoices()[index];
                    //         }
                    //     }
                    //     utterance.voice = window.speechSynthesis.getVoices()[index];

                    //     setTimeout(() => {
                    //         utterance.voice = window.speechSynthesis.getVoices()[1];
                    //     }, 1000);

                    //     utterance.addEventListener('end', () => {
                    //         console.log('Speech finished');
                    //         const afterElement = circle.find('.circle-after');

                    //         if (afterElement.length) {
                    //             circle.remove(afterElement);

                    //             setTimeout(() => {
                    //                 afterElement.removeClass('circle-after');
                    //                 conC.removeClass('container-circle');
                    //                 conT.removeClass('container-title');
                    //                 en.removeClass('inside');
                    //                 location.removeClass('active');
                    //                 // store the objects on localStorage
                    //                 // localStorage.setItem('data',JSON.stringify(parsedData[0]['data']))
                    //                 // store key question in input hidden
                    //                 $('#key').val(parsedData[0]['data'] ? parsedData[0][
                    //                     'data'
                    //                 ]['id'] : '');
                    //                 $('#query').val(parsedData[0] ? parsedData[0]['query'] :
                    //                     '');
                    //                 // show input
                    //                 input.show()
                    //             }, 1000);
                    //         }
                    //     });

                    //     if (parsedData[0]['flag'] == "true") {
                    //         afterElement.addClass('zoom-out');
                    //         location.removeClass('active');

                    //         setTimeout(() => {
                    //             afterElement.removeClass('zoom-out');
                    //             afterElement.addClass('circle-after');
                    //             conC.addClass('container-circle');
                    //             conT.addClass('container-title');
                    //             en.addClass('inside');
                    //             circle.append(afterElement);

                    //             setTimeout(() => {
                    //                 speechSynthesis.speak(utterance);
                    //                 location.toggleClass('active');
                    //             }, 1000);
                    //         }, 1000);
                    //     } else {
                    //         setTimeout(() => {
                    //             afterElement.addClass('circle-after');
                    //             circle.append(afterElement);
                    //             speechSynthesis.speak(utterance);
                    //         }, 1000);
                    //     }
                    // } else {
                    //     console.log('Speech synthesis not supported in this browser');
                    // }
                } else {
                    const err = await response.text();
                    // messageDiv.html("Something went wrong");
                    alert(err);
                }
            }

            // prepare for speak
            const startToSpeak = async (sentence) => {
                console.log(sentence)
                if ('speechSynthesis' in window) {
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
                        $('.loader').hide()
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
                                input.show()
                            }, 1000);
                        }
                    });

                    // start talked
                    setTimeout(() => {
                        afterElement.addClass('circle-after');
                        $('.loader').show()
                        circle.append(afterElement);
                        speechSynthesis.speak(utterance);
                    }, 1000);
                } else {
                    console.log('Speech synthesis not supported in this browser');
                }
            }
        });
    </script>
@endsection
