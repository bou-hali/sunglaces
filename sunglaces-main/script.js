// Selecting elements
const smallpictures = document.querySelectorAll('.smallpictures');
const emphasisPicture = document.getElementById('emphasisPicture');
const plus = document.getElementById('plus');
const minus = document.getElementById('minus');
const totalItems = document.getElementById('totalItems');

// Adding event listeners for thumbnail clicks
smallpictures.forEach(picture => {
    picture.addEventListener('click', () => {
        const src = picture.src;
        document.querySelector('.active').classList.remove('active');
        picture.classList.add('active');
        emphasisPicture.src = src;
    });
});

// Adding event listeners for increment and decrement buttons
plus.addEventListener('click', () => {
    totalItems.value++;
});

minus.addEventListener('click', () => {
    totalItems.value--;
    if (totalItems.value <= 0) {
        totalItems.value = 1;
    }
});

// Ensuring totalItems value is at least 1
totalItems.addEventListener('change', () => {
    if (totalItems.value <= 0) {
        totalItems.value = 1;
    }
});
