const svgIcons = document.querySelectorAll('svg')
let circle = document.querySelector('.circle');
svgIcons.forEach(element => {
    element.addEventListener("click", function () {
        console.log(element.dataset.id);
        if(element.dataset.id === 'ask'){
            toggle()
        }
        if(element.dataset.id === 'scanner'){

        }
        // Perform your desired actions here
      });
});

$('.circle').on('click',()=>{
    alert('dwadawd')
})


// toggle function
function toggle(){
    var blur = document.getElementById('popupask')
    blur.classList.toggle('active')
}

// render circle animation
circle.addEventListener('mouseenter', () => {
    const afterElement = document.createElement('div');
    afterElement.classList.add('circle-after');
  
    circle.appendChild(afterElement);
  });
  
  circle.addEventListener('mouseleave', () => {
    const afterElement = document.querySelector('.circle-after');
    if (afterElement) {
      afterElement.remove();
    }
  });