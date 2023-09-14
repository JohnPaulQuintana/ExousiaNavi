
const form = document.querySelector('form')
const chatContainer = document.querySelector('#chat_container')
let circle = document.querySelector('.circle');
const afterElement = document.createElement('div');
const en = document.querySelector('header')
const conC = document.querySelector('#con-circle')
const conT = document.querySelector('#title')
const location = document.querySelector('#popuplocation')
let loadInterval


const handleSubmit = async (e) => {
    e.preventDefault()

    const data = new FormData(form)
    // to clear the textarea input 
    form.reset()
    // to focus scroll to the bottom 
    chatContainer.scrollTop = chatContainer.scrollHeight;
    const response = await fetch('http://localhost:5000/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            prompt: data.get('prompt')
        })
    })
// Clear the loading indicator
    clearInterval(loadInterval)
    // messageDiv.innerHTML = " "

    if (response.ok) {
        const data = await response.json();
        const parsedData = data.bot // trims any trailing spaces/'\n' 
        console.log(parsedData)
        // const location = data.loc.trim()
        // chatContainer.innerHTML += chatStripe(true, parsedData, uniqueId, location);
        // typeText(messageDiv, parsedData, () => {
        //      // Display the location if available
        //     // Display the locations if available
        //     const locations = data.loc;
        //     if (Array.isArray(locations) && locations.length > 0) {
        //     const locationsDiv = document.createElement('div');
        //     locationsDiv.className = 'locations';
        //     for (const location of locations) {
        //         const trimmedLocation = location.trim();
        //         const locationImage = document.createElement('img');
        //         locationImage.src = trimmedLocation;
        //         locationsDiv.appendChild(locationImage);
        //     }
        //     messageDiv.appendChild(locationsDiv);
        //     }
        // })
      // console.log(parsedData.split(", "))
      // const splitParsedData = parsedData.split(", ")
        // Check if the browser supports the SpeechSynthesis API
      if ('speechSynthesis' in window) {
        // Create a new SpeechSynthesisUtterance object
        const utterance = new SpeechSynthesisUtterance();
        utterance.volume = 1;
        utterance.rate = 0.9
        utterance.pitch = 1
        // Set the text to be spoken
        utterance.text = parsedData[1];
        var index = 1;
        for (index; index < window.speechSynthesis.getVoices().length; index++) {
          if(window.speechSynthesis.getVoices()[index].voiceURI.search('Zeera') != -1){
            utterance.voice = window.speechSynthesis.getVoices()[index]
          }
          
        }
        utterance.voice = window.speechSynthesis.getVoices()[index]

        setTimeout(()=>{
          utterance.voice = window.speechSynthesis.getVoices()[1]
        },1000)
        console.log(utterance)
         // Get the list of available voices
      
         // Event listener for when speech ends
          utterance.addEventListener('end', () => {
            console.log('Speech finished');
            const afterElement = circle.querySelector('.circle-after');
            const location = document.querySelector('#popuplocation')
            if (afterElement) {
              circle.removeChild(afterElement);
              
              setTimeout(()=>{
                // const message = new SpeechSynthesisUtterance("Thank you! have a nice day!");
                // speechSynthesis.speak(message);
                afterElement.classList.remove('circle-after')
                conC.classList.remove('container-circle');
                conT.classList.remove('container-title');
                en.classList.remove('inside');
                location.classList.remove('active')
              },1000)
              // location.classList.remove('active')
            }
            // You can perform any actions here after the speech has finished
          });
          
          if(parsedData[0] == "true"){
            // activate animation
            afterElement.classList.add('zoom-out'); // Add the zoom-out class to trigger the animation
            location.classList.remove('active')
          
            // Add a delay before appending the element with a class
            setTimeout(() => {
              afterElement.classList.remove('zoom-out'); // Remove the zoom-out class to trigger the zoom-in animation
              afterElement.classList.add('circle-after')
              conC.classList.add('container-circle');
              conT.classList.add('container-title');
              en.classList.add('inside');
              circle.appendChild(afterElement);
              // Start speech synthesis after the animation is completed
              setTimeout(() => {
                speechSynthesis.speak(utterance);
                // load the location popups   
                location.classList.toggle('active')
              
              }, 1000); // Adjust the delay as needed
            }, 1000);
          }else{
            // location.classList.remove('active')
            setTimeout(()=>{
              afterElement.classList.add('circle-after')
              circle.appendChild(afterElement);
              speechSynthesis.speak(utterance);
            },1000)
          }
        
      } else {
        console.log('Speech synthesis not supported in this browser');
      }
     
    } else {
        const err = await response.text()

        messageDiv.innerHTML = "Something went wrong"
        alert(err)
    }
}

form.addEventListener('submit', handleSubmit)
form.addEventListener('keyup', (e) => {
    if (e.keyCode === 13) {
        handleSubmit(e)
        var blur = document.getElementById('popupask')
        blur.classList.remove('active')
    }
})


// form.addEventListener('load',greeting)

// const openModal = async () => {
//     document.getElementById("AssistantModal").style.display = "block";
// }

// const closeModal = async () => {
//     document.getElementById("AssistantModal").style.display = "none";
// }

// const close2 = document.querySelector(".close")
// close2.addEventListener('click', ()=>{
//     closeModal();
// })


// qr code
const scanner = new Html5QrcodeScanner('reader',{
    qrbox: {
        width: 250,
        height:250,
    },
    fps: 20,
})


const success =  (res)=>{
    console.log("success"+res)
    scanner.clear() 
    document.querySelector("#reader").remove()
    closeModal()
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
          .fire({
            title: "Authentication Success!",
            text: "Welcome!, Jaypee Quintana",
            type: "success",
            icon: "success",
            confirmButtonText: "OK",
            reverseButtons: true,
          })
          .then((result) => {
            if (result.isConfirmed) {
              let timerInterval;
              Swal.fire({
                title: "Initializing ExousiaNavi",
                html: "ready in in <b></b> milliseconds.",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Welcome jaypee Quintana",
                    showConfirmButton: false,
                    timer: 1500,
                  }).then(async() => {
                    
                    const response = await fetch('http://localhost:5000/greetings', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        
                    })
                    
                   
                  });
                }
              });
              //   window.location.href = 'display.php'
            }
          });
}

const error = async (err) =>{
    console.log(err)
}



frequentlyAsk()
// function for frequently ask
function frequentlyAsk(){
    const asks = document.querySelectorAll('#f-ask')
   
    const circle = document.querySelector('.circle');
    asks.forEach(ask => {
        ask.addEventListener("click", function () {
            // console.log(element.dataset.id);
            var inputField = document.getElementById('input'); // Replace 'input' with the ID of your text input field
            // Perform your desired actions here
            inputField.value = ask.dataset.id;
        });
    });
}

speakRec()
// speech recognition
function speakRec(){
    const svgIcons = document.querySelectorAll('svg')
    const circle = document.querySelector('.circle');
    svgIcons.forEach(element => {
        element.addEventListener("click", function () {
            console.log(element.dataset.id);
            if(element.dataset.id == 'mic'){
                try {
    
                    // speech
                    var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                    var SpeechGrammarList = SpeechGrammarList || window.webkitSpeechGrammarList;
                    var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;
                    
                    var recognition = new SpeechRecognition();
                    recognition.lang = 'en-US';
                    recognition.interimResults = false;
                    recognition.maxAlternatives = 1;
                    
                    var inputField = document.getElementById('input'); // Replace 'input' with the ID of your text input field
                    
                    // document.body.onclick = function() {
                      recognition.start();
                      console.log('Ready to receive speech input.');
                    // }
                    
                    recognition.onresult = function(event) {
                      var spokenText = event.results[0][0].transcript;
                      inputField.value = spokenText;
                      console.log('Spoken text: ' + spokenText);
                    }
                    
                    recognition.onspeechend = function() {
                      recognition.stop();
                    }
                    
                    recognition.onnomatch = function(event) {
                      console.log("No speech recognition match found.");
                    }
                    
                    recognition.onerror = function(event) {
                      console.log('Error occurred in speech recognition: ' + event.error);
                    }
                    } catch (error) {
                        console.log(error)
                    }
            }
            // Perform your desired actions here
        });
    });
}