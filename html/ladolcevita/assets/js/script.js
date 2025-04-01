document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("loginBtn");
    const inlogBox = document.querySelector("login-form").shadowRoot.querySelector(".inlog");
    const contentBox = document.querySelector(".content");
    const closeBtn = document.querySelector("login-form").shadowRoot.querySelector(".close-btn");
    const signupLink = document.querySelector(".signup a");
    const loginForm = document.querySelector("login-form");
    const winkelwagenLink = document.querySelector(".winkelwagen");
    const shoppingCart = document.querySelector(".shoppingcart");
    const closeCartBtn = document.querySelector(".sluit-winkelwagen");

    // Verberg de loginbox standaard
    inlogBox.style.display = "none";

    // Verander de login status afhankelijk van of de gebruiker ingelogd is
    let isLoggedIn = loginBtn.textContent !== "Inloggen";

    // Voeg submenu toe voor uitloggen
    const submenu = document.createElement("div");
    submenu.classList.add("submenu");
    submenu.innerHTML = `<a href="uitloggen.php" id="logoutBtn">Uitloggen</a>`;
    submenu.style.display = "none";
    loginBtn.insertAdjacentElement("afterend", submenu);

    // Functie om login of submenu weer te geven
    function toggleLogin() {
        if (isLoggedIn) {
            submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        } else {
            inlogBox.style.display = "block";
            contentBox.style.display = "none";
        }
    }

    // Eventlistener voor de login knop
    loginBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleLogin();
    });

    // Als ergens anders geklikt wordt, sluit submenu
    document.addEventListener("click", (e) => {
        if (!loginBtn.contains(e.target) && !submenu.contains(e.target)) {
            submenu.style.display = "none";
        }
    });

    // Sluit de loginbox via de close-btn in de shadow DOM
    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            inlogBox.style.display = "none";
            contentBox.style.display = "block";
        });
    }

    // Winkelwagen link toont de winkelwagen
    if (winkelwagenLink) {
        winkelwagenLink.addEventListener("click", (e) => {
            e.preventDefault();
            shoppingCart.style.display = "flex"; // Zorgt ervoor dat de winkelwagen wordt getoond
        });
    }

    // Sluit winkelwagen
    if (closeCartBtn) {
        closeCartBtn.addEventListener("click", () => {
            shoppingCart.style.display = "none"; // Zorgt ervoor dat de winkelwagen wordt verborgen
        });
    }
});


// De rest van je script blijft hetzelfde...


// Sorteren van producten
function sortProducts() {
    const sorteren = document.getElementById('sorteren').value;
    const producten = Array.from(document.querySelectorAll('.product'));
    const container = document.querySelector('.items');

    producten.sort((a, b) => {
        const prijsA = parseFloat(a.querySelector('.product-onderkant p').textContent.replace('€', ''));
        const prijsB = parseFloat(b.querySelector('.product-onderkant p').textContent.replace('€', ''));
        const naamA = a.querySelector('h2').textContent.toLowerCase();
        const naamB = b.querySelector('h2').textContent.toLowerCase();

        switch (sorteren) {
            case 'prijs-asc':
                return prijsA - prijsB;
            case 'prijs-desc':
                return prijsB - prijsA;
            case 'naam-asc':
                return naamA.localeCompare(naamB);
            case 'naam-desc':
                return naamB.localeCompare(naamA);
            default:
                return 0;
        }
    });

    container.innerHTML = '';
    producten.forEach(product => container.appendChild(product));
}

// Reset sorteerfunctie
function resetSort() {
    document.getElementById('sorteren').value = 'default';
    const container = document.querySelector('.items');
    const producten = Array.from(document.querySelectorAll('.product'));

    producten.sort((a, b) => a.dataset.index - b.dataset.index);

    container.innerHTML = '';
    producten.forEach(product => container.appendChild(product));
}

// Voeg index toe aan producten voor sorteermogelijkheid
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product').forEach((product, index) => {
        product.dataset.index = index;
    });
});

// Zoekfunctie voor producten
document.addEventListener('DOMContentLoaded', () => {
    const zoekInput = document.querySelector('.zoekbalk input');
    const producten = document.querySelectorAll('.product');

    zoekInput.addEventListener('input', () => {
        const zoekTerm = zoekInput.value.toLowerCase();
        producten.forEach(product => {
            const titel = product.querySelector('h2').textContent.toLowerCase();
            const beschrijving = product.querySelector('p').textContent.toLowerCase();

            if (titel.includes(zoekTerm) || beschrijving.includes(zoekTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
});

// Sluitknop voor login box
document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.querySelector('.close-btn');
    const inlogBox = document.querySelector('.inlog');
    let contentBox = document.querySelector('.content');
    const overonsContent = document.querySelector('.overons-content');

    closeBtn.addEventListener('click', () => {
        inlogBox.style.display = 'none';
        if (contentBox) {
            contentBox.style.display = 'block';
        } else if (overonsContent) {
            overonsContent.style.display = 'block';
        }
    });
});

// Menu toggle (mobielmenu)
function toggleMenu() {
    var nav = document.querySelector('nav');
    if (nav.style.display === 'flex') {
        nav.style.display = 'none';
    } else {
        nav.style.display = 'flex';
    }
}
