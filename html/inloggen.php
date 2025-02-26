<?php
include 'session.php';
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

        // Redirect naar de vorige pagina
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default_page.php';
        header("Location: $redirect_url");
        exit();
    } else {
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default_page.php';
        header("Location: $redirect_url");
        exit();
    }

}