<?php
$openingstijden = "9.00 tot 14.00";
$email = "assurantiekantoor@victordreis.nl";
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assurantiekantoor Victor Dreis - Openingstijden en diensten.">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
    <h1>Contact</h1>
        
        <div class="contactgegevens">
            <p><strong>Telefoon:</strong> 024-3568242</p>
            <p><strong>E-mail:</strong> <a href="mailto:assurantiekantoor@victordreis.nl">assurantiekantoor@victordreis.nl</a></p>
            <p><strong>Adres:</strong> Assurantiekantoor Victor Dreis, Groenestraat 242, 6531 JA Nijmegen, Netherlands</p>
            <p><strong>Openingstijden:</strong> Maandag-Vrijdag van 9.00 tot 15.00</p>
            <p>Een afspraak is niet nodig, maar is wel handig. Buiten de openingstijden kan het ook op afspraak.</p>
        </div>

        <h2>Neem contact met ons op</h2>
        <form action="mailer/send.php" method="POST">
            <label for="name">Naam </label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telefoonnummer</label>
            <input type="text" id="phone" name="phone">

            <label for="subject">Onderwerp</label>
            <input type="text" id="subject" name="subject">

            <label for="message">Bericht</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Verstuur</button>
        </form>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>