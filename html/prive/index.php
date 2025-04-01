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
        <h1>Openingstijden kantoor</h1>
        <p>Omdat tegenwoordig de meeste communicatie per mail gaat en bezoek en telefonisch contact erg is afgenomen,
            hanteren wij nu onderstaande openingstijden. Na 14.00 uur krijgt u onze antwoorddienst aan de lijn en vaak
            zijn we nog aan het werk en bellen wij u die middag of anders uiterlijk de dag erna terug.</p>
        <ul>
            <li>Buiten deze tijd kunt u natuurlijk altijd langs komen na het maken van een afspraak.</li>
            <li>Dit is ook van toepassing voor een belafspraak.</li>
            <li>Wijzigingen en vragen kunt u mailen naar <a href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></a></li>
            <li>Wijzigingen voor bestaande relaties worden meteen verwerkt en is er dan meteen dekking mits er niets
                afwijkends is.</li>
        </ul>
        <h2>Openingstijden: <?php echo $openingstijden; ?></h2>
        <p>Of na afspraak buiten deze tijden.</p>
    </div>

    <div class="container">
        <h1>Onze Diensten</h1>
        <div class="diensten">
            <div class="dienst">
                <img src="assets/icons/1.png" alt="Verzekeringen">
                <p>Verzekeringen</p>
            </div>
            <div class="dienst">
                <img src="assets/icons/2.png" alt="Hypotheken">
                <p>Hypotheken</p>
            </div>
            <div class="dienst">
                <img src="assets/icons/1.png" alt="Financieringen">
                <p>Financieringen</p>
            </div>
            <div class="dienst">
                <img src="assets/icons/2.png" alt="Financieel Advies">
                <p>Financieel Advies</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
