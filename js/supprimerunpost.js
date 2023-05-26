const oui = document.querySelector(".supprime-toi-bien");
const non = document.querySelector(".supprime-toi-pas");
const jeteferme = document.querySelector(".jeteferme");
const supprimer = document.querySelector("jetesupprime");
const trash = document.querySelectorAll(".poubelle");

trash.forEach(element => {
  const supprimer = element.parentElement.nextElementSibling;
  console.log(supprimer)

  element.addEventListener("click", () => {
    supprimer.style.display = "block";
  });

  oui.addEventListener('click', () => {
    supprimer.style.display = 'none';
  });

  supprimer.querySelector('.supprime-toi-pas').addEventListener('click', () => {
    supprimer.style.display = 'none';
  });

  supprimer.querySelector('.jeteferme').addEventListener('click', () => {
    supprimer.style.display = 'none';
  });
});

const description = document.getElementById('description');
const choixtags = document.getElementById('tags');

const savedDescription = localStorage.getItem('description');
const savedchoixtags = localStorage.getItem('tags');

if (savedDescription) {
  description.value = savedDescription;
  choixtags.value = savedchoixtags;
}

localStorage.setItem('description', description.value);
localStorage.setItem('tags', choixtags.value);

window.addEventListener('beforeunload', function(event) {
  localStorage.setItem('description', description.value);
  localStorage.setItem('tags', choixtags.value);
});

