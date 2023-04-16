var darkmode = false;
const texte = document.querySelector('h3');

function dark() {
   var element = document.body;   
   if (darkmode) {
     element.classList.replace("nightmode", "daymode");
     texte.textContent = 'Changer en Dark mode'
   } else {
     element.classList.replace("daymode", "nightmode");
     texte.textContent = 'Changer en  Light mode'
   }
   darkmode = !darkmode;
 }

