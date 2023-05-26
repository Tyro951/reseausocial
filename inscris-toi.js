let modal = document.querySelector('.cotoibatard');
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