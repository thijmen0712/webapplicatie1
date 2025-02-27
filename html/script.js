document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("loginBtn");
    const inlogBox = document.querySelector(".inlog");
    const contentBox = document.querySelector(".content");
    const closeBtn = document.querySelector(".close-btn");
    const signupLink = document.querySelector(".signup a");
    const loginForm = document.getElementById("loginForm");
    const winkelwagenLink = document.querySelector(".winkelwagen");
    const shoppingCart = document.querySelector(".shoppingcart");
    const closeCartBtn = document.querySelector(".sluit-winkelwagen");

    // Check of de gebruiker is ingelogd
    let isLoggedIn = loginBtn.textContent !== "Inloggen";

    // Voeg submenu toe aan de HTML
    const submenu = document.createElement("div");
    submenu.classList.add("submenu");
    submenu.innerHTML = `<a href="uitloggen.php" id="logoutBtn">Uitloggen</a>`;
    submenu.style.display = "none";
    loginBtn.insertAdjacentElement("afterend", submenu);

    function toggleLogin() {
        if (isLoggedIn) {
            submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        } else {
            inlogBox.style.display = "block";
            contentBox.style.display = "none";
        }
    }


    loginBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleLogin();
    });

    document.addEventListener("click", (e) => {
        if (!loginBtn.contains(e.target) && !submenu.contains(e.target)) {
            submenu.style.display = "none";
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            inlogBox.style.display = "none";
            contentBox.style.display = "block";
        });
    }


    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.innerHTML = `
            <input type="text" name="naam" placeholder="Naam" required>
            <input type="email" name="email" placeholder="E-mailadres" required>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <input type="password" name="herhaal_wachtwoord" placeholder="Herhaal wachtwoord" required>
            <input type="submit" value="Account aanmaken">
        `;
        loginForm.action = "signup.php";
        loginForm.method = "POST";
    });

    if (winkelwagenLink) {
        winkelwagenLink.addEventListener("click", (e) => {
            e.preventDefault();
            shoppingCart.style.display = "flex";
        });
    }

    if (closeCartBtn) {
        closeCartBtn.addEventListener("click", () => {
            shoppingCart.style.display = "none";
        });
    }
});
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
function resetSort() {
    document.getElementById('sorteren').value = 'default';
    const container = document.querySelector('.items');
    const producten = Array.from(document.querySelectorAll('.product'));

    producten.sort((a, b) => a.dataset.index - b.dataset.index);

    container.innerHTML = '';
    producten.forEach(product => container.appendChild(product));
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product').forEach((product, index) => {
        product.dataset.index = index;
    });
});

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

