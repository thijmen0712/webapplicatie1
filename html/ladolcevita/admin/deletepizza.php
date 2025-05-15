<?php
include '../session.php';
include '../connect.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$id]);

    $previous_page = $_SERVER['HTTP_REFERER'];
    header("Location: $previous_page");
    exit();
} else {
    echo "Geen pizza ID opgegeven!";
}
