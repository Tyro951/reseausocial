const oui = document.querySelector(".supprime-toi-bien");
const non = document.querySelector(".supprime-toi-pas");
const supprimer = document.querySelector(".jetesupprime");
const pasdepubli = document.querySelector(".aucunepubli");
const jeteferme = document.querySelector(".jeteferme");
console.log(supprimer);
function ouvretoi() {
    supprimer.style.display = 'block';
}
jeteferme.addEventListener('click', () => {
    supprimer.style.display = 'none';
  });