<?php
include 'session.php';
include 'connect.php';
?>
<?php if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make screen concept</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            width: 100%;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            background-color: #8F9F5D;
            color: white;
        }

        .hamburgermenu {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 20px;
            cursor: pointer;
        }

        .stripe {
            width: 100%;
            height: 3px;
            background-color: white;
        }

        .lastrefresh {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .gebruiker {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .gegevens {
            display: flex;
            gap: 5px;
        }

        .producten {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
        }

        .product {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .item {
            background-color: #cccccc;
            padding: 5px;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }
        .order {
            display: flex;
            justify-content: center;
        }

        footer {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #8F9F5D;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .doorklikken {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            background-color: green;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: -30px;
        }

        .doorklikken::after {
            content: '✔';
            font-size: 40px;
        }
        footer a {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
            text-decoration: none;
        }
        footer a img {
            width: 40px;
            height: 40px;
        }
        
    </style>
</head>

<body>
    <header>
        <div class="hamburgermenu">
            <div class="stripe"></div>
            <div class="stripe"></div>
            <div class="stripe"></div>
        </div>
        <div class="lastrefresh">
            <p>laatste refresh:</p>
            <?php echo date("H:i:s"); ?>
        </div>
        <div class="gebruiker">
            <p>ingelogd als:</p>
            <p><?php echo $_SESSION['gebruiker_naam'] ?></p>
        </div>
        
    </header>

    <div class="order">
        <div class="producten">
            <?php
            $sql = "SELECT * FROM `bestelling_producten` WHERE bestelling_id IN (SELECT id FROM bestelling WHERE status = 'in oven') ORDER BY bestelling_id, product_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $bestellingen = [];
            foreach ($result as $row) {
                $bestelling_id = $row['bestelling_id'];
                if (!isset($bestellingen[$bestelling_id])) {
                    // Fetch bestelling details only once per bestelling_id
                    $bestelling_sql = "SELECT naam, email, adres FROM bestelling WHERE id = :bestelling_id";
                    $bestelling_stmt = $conn->prepare($bestelling_sql);
                    $bestelling_stmt->bindParam(':bestelling_id', $bestelling_id, PDO::PARAM_INT);
                    $bestelling_stmt->execute();
                    $bestelling_result = $bestelling_stmt->fetch(PDO::FETCH_ASSOC);

                    // Save bestelling data
                    $bestellingen[$bestelling_id] = [
                        'naam' => $bestelling_result['naam'],
                        'email' => $bestelling_result['email'],
                        'adres' => $bestelling_result['adres'],
                        'producten' => []
                    ];
                }

                // Fetch product details
                $product_id = $row['product_id'];
                $product_sql = "SELECT titel FROM product WHERE id = :product_id";
                $product_stmt = $conn->prepare($product_sql);
                $product_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $product_stmt->execute();
                $product_result = $product_stmt->fetch(PDO::FETCH_ASSOC);

                // Add product to the bestelling
                for ($i = 0; $i < $row['aantal']; $i++) {
                    $bestellingen[$bestelling_id]['producten'][] = $product_result['titel'];
                }
            }

            // Display the orders
            foreach ($bestellingen as $bestelling_id => $bestelling_data) {
                echo "<div class='product'>";
                echo "<div class='gegevens'>";
                echo "<p>" . $bestelling_id . "</p>";
                echo "<p>-</p>";
                echo "<p>" . $bestelling_data['naam'] . "</p>";
                echo "<p>" . $bestelling_data['email'] . "</p>";
                echo "<p>" . $bestelling_data['adres'] . "</p>";
                echo "</div>";

                // Display the products for this bestelling
                foreach ($bestelling_data['producten'] as $product) {
                    echo "<p class='item'>" . $product . "</p>";
                }

                echo "</div>";
            }
            ?>
        </div>
    </div>
    <footer>
        <a href="makescreen.php"><img src="images/bereiden.png" alt="bereiden">te bereiden</a>
        <a href="oven.php"><img src="images/oven.png" alt="oven">in oven</a>
        <a href="toekomstig.php"><img src="images/toekomst.png" alt="toekomstig">toekomstig</a>
        <a href="afgerond.php"><img src="images/gereed.png" alt="afgerond">afgerond</a>
    </footer>
</body>

</html>
<script>
    setTimeout(function(){
        location.reload();
    }, 10000);
</script>