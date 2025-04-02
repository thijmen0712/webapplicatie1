<?php
include __DIR__ . '/../session.php';
include __DIR__ . '/../connect.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['winkelwagen_id'])) {
        $winkelwagen_id = $_POST['winkelwagen_id'];
        $sql = "DELETE FROM winkelwagen_producten WHERE id = :winkelwagen_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':winkelwagen_id', $winkelwagen_id, PDO::PARAM_INT);
        $stmt->execute();
        $winkelwagenOpen = true;
    } elseif (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $aantal = 1; // Aantal kan later dynamisch worden gemaakt
        // Ensure winkelwagen_id exists in the winkelwagen table
        $sql = "SELECT id FROM winkelwagen LIMIT 1";
        $stmt = $conn->query($sql);
        $winkelwagen = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($winkelwagen) {
            $winkelwagen_id = $winkelwagen['id'];
        } else {
            // Handle the case where no winkelwagen exists
            // For example, create a new winkelwagen and get its id
            $sql = "INSERT INTO winkelwagen (user_id) VALUES (1)"; // Replace 1 with actual user_id
            $conn->exec($sql);
            $winkelwagen_id = $conn->lastInsertId();
        }
        $sql = "INSERT INTO winkelwagen_producten (product_id, aantal, winkelwagen_id) VALUES (:product_id, :aantal, :winkelwagen_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':aantal', $aantal, PDO::PARAM_INT);
        $stmt->bindParam(':winkelwagen_id', $winkelwagen_id, PDO::PARAM_INT);
        $stmt->execute();
        $winkelwagenOpen = true;
    } else {
        $winkelwagenOpen = false;
    }
} else {
    $winkelwagenOpen = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
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
    <script src="../assets/js/menu-item.js"></script>
    <script src="../assets/js/login-form.js"></script>
    <script src="../assets/js/script.js"></script>

</head>

<body class="menu">
    <?php
    include __DIR__ . '/../header.php';
    ?>
    <?php
    include __DIR__ . '/../knoppen.php';
    ?>
    <div class="container">

        <login-form></login-form>
        <div class="content menukaart">
            <h1 style="text-align: center;">Menu</h1>
            <div class="zoekbalk">
                <input type="text" placeholder="Zoeken op naam of ingrediënt">
            </div>
            <div class="filter-opties">
                <label for="sorteren">Sorteren op:</label>
                <select id="sorteren" onchange="sortProducts()">
                    <option value="default">Selecteer</option>
                    <option value="prijs-asc">Prijs: Laag naar Hoog</option>
                    <option value="prijs-desc">Prijs: Hoog naar Laag</option>
                    <option value="naam-asc">Naam: A-Z</option>
                    <option value="naam-desc">Naam: Z-A</option>
                </select>
                <button onclick="resetSort()">Reset</button>
            </div>

            <div class="items">
                <?php
                $sql = "SELECT * FROM product";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<menu-item 
                foto="../assets/images/' . $row['foto'] . '" 
                titel="' . $row['titel'] . '" 
                beschrijving="' . $row['beschrijving'] . '" 
                prijs="' . $row['prijs'] . '" 
                id="' . $row['id'] . '">
              </menu-item>';
                }
                ?>
            </div>


        </div>
    </div>
    <div class="shoppingcart" style="display: <?php echo $winkelwagenOpen ? 'flex' : 'none'; ?>;">
        <span class="sluit-winkelwagen"><img src="../assets/images/kruis2.png" alt="kruis"></span>
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
                echo "<img class='winkelwagen-foto' src='../assets/images/" . $row['foto'] . "' alt='Product afbeelding'>";
                echo "<div class='product-info'>";
                echo "<h3>" . $row['titel'] . "</h3>";
                echo "<p>" . $row['beschrijving'] . "</p>";
                echo "</div>";
                echo "<div class='product-actions' style='display: flex; flex-direction: column; justify-content: space-between; height: 100%;'>";
                echo "<form action='' method='post' class='verwijder-form' style='align-self: flex-start;'>";
                echo "<input type='hidden' name='winkelwagen_id' value='" . $row['winkelwagen_id'] . "'>";
                echo "<button type='submit' class='verwijder-knop'><img src='../assets/images/delete_icon.png' alt='Verwijder'></button>";
                echo "</form>";
                echo "<p class='prijs' style='align-self: flex-end;'>€" . number_format($row['prijs'], 2) . "</p>";
                echo "</div>";
                echo "</div>";
                $totalPrice += $row['totaalprijs'];
            }
        } else {
            echo "<p>Je winkelwagen is leeg.</p>";
        }
        echo "<div class='line'>.</div>";
        echo "<p>Totaal: €" . number_format($totalPrice, 2) . "</p>";
        ?>
        <div class="verder">
            <a href="">verder naar bestellen</a>
        </div>
    </div>
</body>

</html>