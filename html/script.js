document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    const loginBtn = document.getElementById("loginBtn");
    const logoutBox = document.getElementById("logoutBox");
    const logoutBtn = document.getElementById("logoutBtn");
    const inlogBox = document.querySelector(".inlog");
    const contentBox = document.querySelector(".content");
    const closeBtn = document.querySelector(".close-btn");
    const winkelwagenLink = document.querySelector(".winkelwagen");
    const shoppingCart = document.querySelector(".shoppingcart");
    const closeCartBtn = document.querySelector(".sluit-winkelwagen");

    // Toggle login popup
    function toggleLogin() {
        if (inlogBox.style.display === "none" || !inlogBox.style.display) {
            inlogBox.style.display = "block";
            contentBox.style.display = "none";
        } else {
            inlogBox.style.display = "none";
            contentBox.style.display = "block";
        }
    }

    if (loginBtn) {
        loginBtn.addEventListener("click", toggleLogin);
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            inlogBox.style.display = "none";
            contentBox.style.display = "block";
        });
    }

    // Login form submit
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();
    
        const formData = new FormData(this);
    
        fetch("inloggen.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("loginBtn").textContent = data.voornaam;
                document.querySelector(".inlog").style.display = "none";
            } else {
                alert("Ongeldige login");
            }
        });
    });
    

    // Logout
    if (logoutBtn) {
        logoutBtn.addEventListener("click", () => {
            fetch("uitloggen.php")
            .then(() => {
                loginBtn.textContent = "Inloggen";
                logoutBox.style.display = "none";
            });
        });
    }

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
