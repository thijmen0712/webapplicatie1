<?php
session_start();
include 'connect.php';

$user_id = isset($_SESSION["gebruiker_id"]) ? $_SESSION["gebruiker_id"] : null;

$sql = "SELECT rol FROM account WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row && $row["rol"] == "admin") {
    $_SESSION["role"] = "admin";
} else {
    $_SESSION["role"] = "user";
}
?>
