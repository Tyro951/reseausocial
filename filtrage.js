const cards = document.querySelectorAll('.card');
console.log(cards);
const desboutons = document.querySelectorAll('#destags li');
console.log(desboutons);
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