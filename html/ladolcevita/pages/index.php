<?php
include __DIR__ . '/../session.php';
include __DIR__ . '/../connect.php';

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

<body class="index">
    <?php include __DIR__ . '/../header.php'; ?>
    <?php include __DIR__ . '/../knoppen.php'; ?>

    <div class="container">
        <login-form></login-form>

        <div class="content" style="text-align: center;">
            <h1>La Dolce Vita</h1>
            <p>Het restaurant voor je echte pizza</p>
            <a href="menu.php" class="btn">Bestellen</a>
            <?php
            if (isset($conn)) {
                $sql = "SELECT * FROM account WHERE emailadres = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
            } else {
                echo "Database connection is not established.";
            }
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && $user['rol'] === 'admin') {
                echo "Welkom, admin!";
            }
            ?>
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
                echo "<cart-item 
                        image='../assets/images/{$row['foto']}'
                        title='{$row['titel']}'
                        description='{$row['beschrijving']}'
                        price='{$row['prijs']}'
                        cart-id='{$row['winkelwagen_id']}'></cart-item>";
                $totalPrice += $row['totaalprijs'];
            }
        } else {
            echo "<p>Je winkelwagen is leeg.</p>";
        }
        ?>
        <div class="line"></div>
        <p>Totaal: €<?php echo number_format($totalPrice, 2); ?></p>

        <div class="verder">
            <a href="">verder naar bestellen</a>
        </div>
    </div>

</body>

</html>
