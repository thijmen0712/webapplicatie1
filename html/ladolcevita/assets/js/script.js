document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('loginBtn');
    const inlogBox = document.querySelector('login-form').shadowRoot.querySelector('.inlog');
    const contentBox = document.querySelector('.content');
    const closeBtn = document.querySelector('login-form').shadowRoot.querySelector('.close-btn');
    const signupLink = document.querySelector('.signup a');
    const loginForm = document.querySelector('login-form');
    const winkelwagenLink = document.querySelector('.winkelwagen');
    const shoppingCart = document.querySelector('.shoppingcart');
    const closeCartBtn = document.querySelector('.sluit-winkelwagen');

    inlogBox.style.display = 'none';
    let isLoggedIn = loginBtn.textContent !== 'Inloggen';

    const submenu = document.createElement('div');
    submenu.classList.add('submenu');
    submenu.innerHTML = `<a href='uitloggen.php' id='logoutBtn'>Uitloggen</a>`;
    submenu.style.display = 'none';
    loginBtn.insertAdjacentElement('afterend', submenu);

    function toggleLogin() {
        if (isLoggedIn) {
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        } else {
            inlogBox.style.display = 'block';
            contentBox.style.display = 'none';
        }
    }

    loginBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleLogin();
    });

    document.addEventListener('click', (e) => {
        if (!loginBtn.contains(e.target) && !submenu.contains(e.target)) {
            submenu.style.display = 'none';
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            inlogBox.style.display = 'none';
            contentBox.style.display = 'block';
        });
    }

    if (winkelwagenLink) {
        winkelwagenLink.addEventListener('click', (e) => {
            e.preventDefault();
            shoppingCart.style.display = 'flex';
        });
    }

    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', () => {
            shoppingCart.style.display = 'none';
        });
    }

    const zoekInput = document.querySelector('.zoekbalk input');
    const producten = document.querySelectorAll('menu-item');
    const origineleProducten = Array.from(producten);

    zoekInput.addEventListener('input', () => {
        const zoekTerm = zoekInput.value.toLowerCase();
        producten.forEach(product => {
            const titel = product.getAttribute('titel').toLowerCase();
            const beschrijving = product.getAttribute('beschrijving').toLowerCase();

            if (titel.includes(zoekTerm) || beschrijving.includes(zoekTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });

    document.getElementById('sorteren').addEventListener('change', () => {
        const sorteren = document.getElementById('sorteren').value;
        const container = document.querySelector('.items');
        const productenArray = Array.from(document.querySelectorAll('menu-item'));

        productenArray.sort((a, b) => {
            const prijsA = parseFloat(a.getAttribute('prijs'));
            const prijsB = parseFloat(b.getAttribute('prijs'));
            const naamA = a.getAttribute('titel').toLowerCase();
            const naamB = b.getAttribute('titel').toLowerCase();

            switch (sorteren) {
                case 'prijs-asc': return prijsA - prijsB;
                case 'prijs-desc': return prijsB - prijsA;
                case 'naam-asc': return naamA.localeCompare(naamB);
                case 'naam-desc': return naamB.localeCompare(naamA);
                default: return 0;
            }
        });

        container.innerHTML = '';
        productenArray.forEach(product => container.appendChild(product));
    });

    document.getElementById('resetSort').addEventListener('click', () => {
        document.getElementById('sorteren').value = 'default';
        const container = document.querySelector('.items');
        container.innerHTML = '';
        origineleProducten.forEach(product => container.appendChild(product));
    });

    const closeLoginBtn = document.querySelector('.close-btn');
    const inlogBoxElement = document.querySelector('.inlog');
    let contentBoxElement = document.querySelector('.content');
    const overonsContent = document.querySelector('.overons-content');

    closeLoginBtn.addEventListener('click', () => {
        inlogBoxElement.style.display = 'none';
        if (contentBoxElement) {
            contentBoxElement.style.display = 'block';
        } else if (overonsContent) {
            overonsContent.style.display = 'block';
        }
    });

    document.querySelector('.menu-toggle').addEventListener('click', () => {
        var nav = document.querySelector('nav');
        nav.style.display = (nav.style.display === 'flex') ? 'none' : 'flex';
    });
});
