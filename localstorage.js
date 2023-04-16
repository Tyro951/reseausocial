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