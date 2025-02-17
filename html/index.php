<?php
include 'connect.php';

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Dolce Vita - Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script>
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

            <?php if ($winkelwagenOpen): ?>
                shoppingCart.style.display = 'flex';
            <?php endif; ?>
        });
    </script>
</head>

<body class="index">
    <?php
    include 'header.php';
    ?>
    <div class="knoppen">
        <button onclick="toggleLogin()">Inloggen</button>
        <?php
        $sql = "SELECT SUM(p.prijs * wp.aantal) AS totaalprijs 
            FROM winkelwagen_producten wp
            JOIN product p ON wp.product_id = p.id";
        $result = $conn->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $totalPrice = $row['totaalprijs'] ? number_format($row['totaalprijs'], 2) : '0.00';
        ?>
        <a class="winkelwagen" href="winkelwagen"><img src="images/winkelwagen.png"
                alt="winkelwagen">€<?php echo $totalPrice; ?></a>
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
        <div class="content" style="text-align: center;">
            <h1>La Dolce Vita</h1>
            <p>Het restaurant voor je echte pizza</p>
            <a href="menu.php" class="btn">Bestellen</a>
        </div>
    </div>
    <div class="shoppingcart" style="display: <?php echo $winkelwagenOpen ? 'flex' : 'none'; ?>;">
        <span class="sluit-winkelwagen"><img src="images/kruis2.png" alt="kruis"></span>
        <h2>winkelwagen</h2>
        <?php
        $sql = "SELECT p.foto, p.titel, p.beschrijving, p.prijs, wp.aantal, (p.prijs * wp.aantal) AS totaalprijs, wp.id AS winkelwagen_id 
        FROM winkelwagen_producten wp
        JOIN product p ON wp.product_id = p.id";
        $result = $conn->query($sql);

        $totalPrice = 0;
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='winkelwagen-product'>";
                echo "<img class='winkelwagen-foto' src='images/" . $row['foto'] . "' alt='Product afbeelding'>";
                echo "<div class='product-info'>";
                echo "<h3>" . $row['titel'] . "</h3>";
                echo "<p>" . $row['beschrijving'] . "</p>";
                echo "</div>";
                echo "<div class='product-actions' style='display: flex; flex-direction: column; justify-content: space-between; height: 100%;'>";
                echo "<form action='' method='post' class='verwijder-form' style='align-self: flex-start;'>";
                echo "<input type='hidden' name='winkelwagen_id' value='" . $row['winkelwagen_id'] . "'>";
                echo "<button type='submit' class='verwijder-knop'><img src='images/delete_icon.png' alt='Verwijder'></button>";
                echo "</form>";
                echo "<p class='prijs' style='align-self: flex-end;'>€" . number_format($row['prijs'], 2) . "</p>";
                echo "</div>";
                echo "</div>";
                $totalPrice += $row['totaalprijs'];
            }
        } else {
            echo "<p>Je winkelwagen is leeg.</p>";
        }
        echo "<div class='line'></div>";
        echo "<p>Totaal: €" . number_format($totalPrice, 2) . "</p>";
        ?>
        <div class="verder">
            <a href="">verder naar bestellen</a>
        </div>
    </div>
</body>

</html>