<?php
include 'session.php';
include 'connect.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verwijder de pizza uit de database
    $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect naar de vorige pagina
    $previous_page = $_SERVER['HTTP_REFERER'];
    header("Location: $previous_page");
    exit();
} else {
    echo "Geen pizza ID opgegeven!";
}
