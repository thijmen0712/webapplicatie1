<?php
include 'session.php';
include 'connect.php';

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
            // Voeg de pizza toe aan de database
            $stmt = $conn->prepare("INSERT INTO product (titel, beschrijving, prijs, foto) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titel, $beschrijving, $prijs, $foto]);

            header('Location: pizzas.php');
            exit;
        } else {
            echo "Sorry, er was een fout bij het uploaden van je bestand.";
        }
    } else {
        echo "Er is geen bestand geüpload of er is een fout opgetreden.";
    }
}
?>
