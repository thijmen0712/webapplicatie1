<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script>
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

    </script>
</head>

<body class="contact">
    <?php
    include 'header.php';
    ?>
    <div class="knoppen">
        <button onclick="toggleLogin()">Inloggen</button>
        <a class="winkelwagen" href="winkelwagen"><img src="images/winkelwagen.png" alt="winkelwagen">€0.00</a>
    </div>
    <div class="container">

        <div class="inlog" style="display: none;">
            <span class="close-btn"><img src="images/kruis.png" alt="kruis"></span>
            <h2 style="text-align: center;">login</h2>
            <form class="inlog-box" action="inloggen.php" method="post">
                <input type="email" name="email" placeholder="E-mailadres" required>
                <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
                <input type="submit" value="doorgaan">
            </form>
            <div class="signup">nog geen account? <a href="#" style="color: #36160A;">maak er een!</a></div>
        </div>
        <div class="content">
        </div>
</body>

</html>