<?php
include 'session.php';
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST["naam"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    $herhaal_wachtwoord = $_POST["herhaal_wachtwoord"];

    if ($wachtwoord !== $herhaal_wachtwoord) {
        die("Wachtwoorden komen niet overeen.");
    }

    $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO account (emailadres, wachtwoord, naam, adres, rol) VALUES (?, ?, ?, '', 'user')");
    $stmt->bindValue(1, $email);
    $stmt->bindValue(2, $hashed_wachtwoord);
    $stmt->bindValue(3, $naam);

    if ($stmt->execute()) {
        echo "Account succesvol aangemaakt!";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Fout bij registreren: " . $errorInfo[2];
    }

    $stmt = null;
}

?>
