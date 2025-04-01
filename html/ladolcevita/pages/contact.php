<?php
include __DIR__ . '/../session.php';
include __DIR__ . '/../connect.php';

// Start de sessie indien deze nog niet gestart is
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bepaal of er items in de winkelwagen moeten worden verwijderd
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['winkelwagen_id'])) {
    $winkelwagen_id = $_POST['winkelwagen_id'];
    $sql = "DELETE FROM winkelwagen_producten WHERE id = :winkelwagen_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':winkelwagen_id', $winkelwagen_id, PDO::PARAM_INT);
    $stmt->execute();
    $winkelwagenOpen = true;
} else {
    $winkelwagenOpen = false;
}


$totalPrice = 0;
$winkelwagenItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($winkelwagenItems) > 0) {
    $winkelwagenOpen = true;
} else {
    $winkelwagenOpen = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Dolce Vita - Contact</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script src="../assets/js/script.js" defer></script>
    <script src="../assets/js/cart-item.js" defer></script>
    <script src="../assets/js/login-form.js" defer></script>

    <?php if ($winkelwagenOpen): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('.shoppingcart').style.display = 'flex';
            });
        </script>
    <?php endif; ?>

</head>

<body class="contact">
    <?php include __DIR__ . '/../header.php'; ?>
    <?php include __DIR__ . '/../knoppen.php'; ?>

    <div class="container scrolbaar">
        <login-form></login-form>
        <div class="content" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
            <h1>contact</h1>
            <h2>neem contact met ons op via:</h2>
            <div class="phone" style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                <img style="width: 40px; height: 40px;" src="../assets/images/telefoon.png" alt="telefoon">
                <p>024 12 34 56</p>
            </div>
            <div class="email" style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                <img style="width: 40px; height: 40px;" src="../assets/images/mail.png" alt="email">
                <p>contact.ladolcevita.nl</p>
            </div>
            <div class="line2"></div>
            <h2>of bezoek ons restaurant</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4931.661490599537!2d5.866273276490216!3d51.827522271887865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c708fa2ca25e35%3A0x8daddc0e2cfc98dc!2sHeyendaalseweg%2098%2C%206525%20EE%20Nijmegen!5e0!3m2!1snl!2snl!4v1739898112497!5m2!1snl!2snl"
                width="450" height="337" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="shoppingcart" style="display: <?php echo $winkelwagenOpen ? 'flex' : 'none'; ?>;">
        <span class="sluit-winkelwagen"><img src="../assets/images/kruis2.png" alt="kruis"></span>
        <h2>winkelwagen</h2>
        <?php if (count($winkelwagenItems) > 0): ?>
            <?php foreach ($winkelwagenItems as $row): ?>
                <cart-item 
                    image="../assets/images/<?= $row['foto'] ?>"
                    title="<?= $row['titel'] ?>"
                    description="<?= $row['beschrijving'] ?>"
                    price="<?= $row['prijs'] ?>"
                    cart-id="<?= $row['winkelwagen_id'] ?>"
                ></cart-item>
                <?php $totalPrice += $row['totaalprijs']; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Je winkelwagen is leeg.</p>
        <?php endif; ?>

        <div class="line"></div>
        <p>Totaal: €<?php echo number_format($totalPrice, 2); ?></p>

        <div class="verder">
            <a href="">verder naar bestellen</a>
        </div>
    </div>

</body>

</html>
