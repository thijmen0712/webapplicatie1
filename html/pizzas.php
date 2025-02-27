<?php
include 'session.php';
include 'connect.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel- pizza</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="admin">
    <?php
    include 'headeradmin.php';
    ?>
    <?php
    ?>

    <div class="container-pizza">
        <div class="linkerhelft">
            <div class="box-links">
                <h2>pizza's toevoegen</h2>
                <form action="addpizza.php" method="post" enctype="multipart/form-data">
                    <p>afbeelding uploaden</p>
                    <div class="upload" style="display: flex; justify-content: center; align-items: center;">
                        <img src="images/upload.png" alt="upload">
                        <input type="file" name="file" id="file" required>
                    </div>

                    <label for="name">naam</label>
                    <input type="text" name="name" id="name" required>

                    <label for="description">beschrijving</label>
                    <input type="text" name="description" id="description" required>

                    <label for="price">prijs</label>
                    <input type="text" name="price" id="price" required>

                    <button type="submit">toevoegen</button>
                </form>


            </div>
        </div>
        <div class="rechterhelft">
            <div class="box-rechts">
                <h2 style="text-align: center;">pizza's</h2>
                <?php
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='pizza-item'>";
                        echo "<div class='pizza-image'><img src='images/" . $row['foto'] . "' alt='" . $row['titel'] . "'></div>";
                        echo "<div class='pizza-details'>";
                        echo "<div class='pizza-title'>" . $row['titel'] . "</div>";
                        echo "<div class='pizza-description'>" . $row['beschrijving'] . "</div>";
                        echo "</div>";
                        echo "<div class='pizza-price'>" . $row['prijs'] . "</div>";
                        echo "<div class='pizza-actions'>";
                        echo "<a href='#' onclick=\"openIframe('editpizza.php?id=" . $row['id'] . "')\"><img src='images/pencil.png'></a>";
                        echo "<a href='deletepizza.php?id=" . $row['id'] . "'><img src='images/bin.png'></a>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <div id="iframeContainer">
        <button id="closeIframe" onclick="closeIframe()">sluiten</button>
        <iframe id="editFrame"></iframe>
    </div>

    <script>

        function openIframe(url) {
            var container = document.getElementById("iframeContainer");
            var frame = document.getElementById("editFrame");
            frame.src = url;
            container.style.display = "block";
        }

        function closeIframe() {
            document.getElementById("iframeContainer").style.display = "none";
            document.getElementById("editFrame").src = "";
        }



    </script>
</body>



</html>