const userSearch = document.querySelector('.search-input');

// Add an event listener for the keyup event
userSearch.addEventListener('keyup', (e) => {
    const currentValue = e.target.value.toLowerCase(); 
    const cards = document.querySelectorAll('.card'); 

    cards.forEach(card => {
        const title = card.querySelector('.card-title'); 
        if (title && title.textContent.toLowerCase().includes(currentValue)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
