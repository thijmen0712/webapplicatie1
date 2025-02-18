
function toggleLogin() {
    const inlogBox = document.querySelector('.inlog');
    const contentBox = document.querySelector('.content');
    if (inlogBox.style.display === 'none' || !inlogBox.style.display) {
        inlogBox.style.display = 'block';
        contentBox.style.display = 'none';
    } else {
        inlogBox.style.display = 'none';
        contentBox.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.querySelector('.close-btn');
    const inlogBox = document.querySelector('.inlog');
    const contentBox = document.querySelector('.content');

    closeBtn.addEventListener('click', () => {
        inlogBox.style.display = 'none';
        contentBox.style.display = 'block';
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const winkelwagenLink = document.querySelector('.winkelwagen');
    const shoppingCart = document.querySelector('.shoppingcart');
    const closeCartBtn = document.querySelector('.sluit-winkelwagen');

    winkelwagenLink.addEventListener('click', (e) => {
        e.preventDefault();
        shoppingCart.style.display = 'flex';
    });

    closeCartBtn.addEventListener('click', () => {
        shoppingCart.style.display = 'none';
    });
});
