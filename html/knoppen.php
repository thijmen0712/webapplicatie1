<script src="script.js"></script>
<div class="knoppen">
    <div id="submenu" class="submenu">
        <a href="uitloggen.php" id="logoutBtn">Uitloggen</a>
    </div>

    <?php
    if ($_SESSION['role'] === 'admin') {
        echo "<a href='admin.php'>Admin menu</a>";
    }
    ?>
    <?php
    $knopTekst = isset($_SESSION['gebruiker_naam']) ? $_SESSION['gebruiker_naam'] : 'Inloggen';
    ?>

    <button id="loginBtn" onclick="toggleLogin()"
        style="cursor: pointer"><?php echo htmlspecialchars($knopTekst); ?></button>


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

