<?php
include '../session.php';
include '../connect.php';

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
    <title>admin panel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="admin">
    <?php
    include 'headeradmin.php';
    ?>
    <?php
    ?>

    <div class="container">
        <div class="content" style="text-align: center;">
            <h1>welkom <?php echo $_SESSION['gebruiker_naam'] ?></h1>
        </div>
    </div>
</body>

</html>