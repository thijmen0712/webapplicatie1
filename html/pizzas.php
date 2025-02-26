<?php
include 'session.php';
include 'connect.php';

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
    <title>admin panel- pizza</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="admin">
    <?php
    include 'headeradmin.php';
    ?>
    <?php
    ?>

    <div class="container"> 
        <h1>test</h1>
    </div>
</body>

</html>