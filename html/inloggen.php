<?php
session_start();
include 'connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $sql = "SELECT id, naam, wachtwoord FROM account WHERE emailadres = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $wachtwoord === $user['wachtwoord']) {
        $_SESSION['gebruiker_id'] = $user['id'];
        $_SESSION['gebruiker_naam'] = $user['naam'];
        echo json_encode(["success" => true, "voornaam" => $user['naam'], "redirect" => $_SERVER['HTTP_REFERER']]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
