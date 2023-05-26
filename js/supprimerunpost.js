const oui = document.querySelector(".supprime-toi-bien");
const non = document.querySelector(".supprime-toi-pas");
const jeteferme = document.querySelector(".jeteferme");
const supprimer = document.getElementById("jetesupprime");
const trash = document.querySelectorAll(".btn");

trash.forEach(element => {
  const supprimer = element.parentElement.nextElementSibling;

  element.addEventListener("click", () => {
    supprimer.style.display = "block";
  });

  oui.addEventListener('click', () => {
    supprimer.style.display = 'none';
  });

  non.addEventListener('click', () => {
    supprimer.style.display = 'none';
  });

  jeteferme.addEventListener('click', () => {
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

