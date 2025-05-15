<?php
if (file_exists(__DIR__ . '/../session.php')) {
    include __DIR__ . '/../session.php';
} else {
    die("Error: session.php not found.");
}

if (file_exists(__DIR__ . '/../connect.php')) {
    include __DIR__ . '/../connect.php';
} else {
    die("Error: connect.php not found.");
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $sql = "SELECT id, naam, wachtwoord FROM account WHERE emailadres = :email";
    $stmt = $conn->prepare($sql);
        $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'default_page.php';
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $wachtwoord === $user['wachtwoord']) {
        $_SESSION['gebruiker_id'] = $user['id'];
        $_SESSION['gebruiker_naam'] = $user['naam'];

      
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default_page.php';
        header("Location: $redirect_url");
        exit();
    } else {
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'default_page.php';
        header("Location: $redirect_url");
        exit();
    }

}