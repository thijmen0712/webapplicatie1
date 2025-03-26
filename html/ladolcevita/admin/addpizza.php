<?php
include __DIR__ . '/../session.php';
include __DIR__ . '/../connect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST['name'];
    $beschrijving = $_POST['description'];
    $prijs = $_POST['price'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $foto = basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $foto)) {
            $sql = "INSERT INTO product (titel, beschrijving, prijs, foto) VALUES (:titel, :beschrijving, :prijs, :foto)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":titel", $titel);
            $stmt->bindParam(":beschrijving", $beschrijving);
            $stmt->bindParam(":prijs", $prijs);
            $stmt->bindParam(":foto", $foto);
            $stmt->execute();

            header('Location: pizzas.php');
            exit;
        } else {
            echo "Sorry, er was een fout bij het uploaden van je bestand.";
        }
    } else {
        echo "Er is geen bestand geüpload of er is een fout opgetreden.";
    }
}


