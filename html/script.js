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

    // Schakel naar aanmeldbox
    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.innerHTML = `
            <input type="text" name="naam" placeholder="Naam" required>
            <input type="email" name="email" placeholder="E-mailadres" required>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <input type="password" name="herhaal_wachtwoord" placeholder="Herhaal wachtwoord" required>
            <input type="submit" value="Account aanmaken">
        `;
    });

    // Winkelwagen openen en sluiten
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
