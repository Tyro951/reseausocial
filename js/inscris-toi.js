let modal = document.querySelector('.cotoi');
const modalflottant = document.getElementById("finito");
const modalflot = document.getElementById("modal");
console.log(modal);
console.log(modalflottant);
console.log(modalflot);

onscroll = (Event) => {
    modal.style.display = "block";
    console.log("hello world");
}

document.querySelector(".close").addEventListener("click", function() {
    modalflot.style.display = "none";
});
document.getElementById("annuler").addEventListener("click", function() {
    modalflot.style.display = "none";
});
function ouvretoi(){
  modalflot.style.display = "block";
  console.log("coucou");
};

window.addEventListener("click", function(event) {
  if (event.target === modalflot) {
    modalflot.style.display = "none";
  }
});

const cards = document.querySelectorAll('.card');
console.log(cards);
const desboutons = document.querySelectorAll('#destags li');
console.log(desboutons);
const reset = document.getElementById('animebtn3');
console.log(reset);

desboutons.forEach(element => { element.addEventListener('click', () => {
    let tag = event.target.getAttribute('data-tag');
    console.log(tag)
    console.log(element)
    cards.forEach(post => { 
        if(post.classList.contains(tag)){
            post.style.display = "block";
        }
        else{
            post.style.display = "none";
        }
    })
})
    
});

reset.addEventListener('click', () => {
  post.style.display = "block";
});

function like() {
  var element = document.getElementById("coeur2");
  element.classList.toggle("coeur2ez");
}