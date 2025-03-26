<?php
include 'session.php';
include 'connect.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $pizza = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pizza) {
        echo "Pizza niet gevonden!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $foto = $pizza['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], "images/" . $foto);
    }

    $sql = "UPDATE product SET titel = :titel, beschrijving = :beschrijving, prijs = :prijs, foto = :foto WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":titel", $titel, PDO::PARAM_STR);
    $stmt->bindParam(":beschrijving", $beschrijving, PDO::PARAM_STR);
    $stmt->bindParam(":prijs", $prijs, PDO::PARAM_STR);
    $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);
    $stmt->execute();

    echo "<script>parent.location.reload();</script>";
}
?>


<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Bewerken</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .edit-form-container {
            width: 90%;
            height: 90%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #8F9F5D;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            border: 2px solid black;
        }

        .edit-form-container h2 {
            font-style: italic;
            color: white;
            margin-bottom: 10px;
        }

        .edit-form-group {
            width: 100%;
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }

        .edit-form-group input,
        .edit-form-group textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-style: italic;
        }

        .edit-form-group textarea {
            height: 100px;
            resize: none;
        }

        .edit-form-group input[type="number"] {
            width: 50%;
        }

        .edit-form-group button {
            position: absolute;
            right: 60px;
            bottom: 20px;
            margin-top: 10px;
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-form-group button:hover {
            background-color: #5a2d16;
        }

        .foto {
            width: auto;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="edit-form-container">
        <h2>Bewerk Pizza</h2>
        <form method="post" class="edit-form-group" enctype="multipart/form-data">
            <label>Titel:</label>
            <input type="text" name="titel" value="<?= htmlspecialchars($pizza['titel']) ?>" required>

            <label>Beschrijving:</label>
            <textarea name="beschrijving" required><?= htmlspecialchars($pizza['beschrijving']) ?></textarea>

            <label>Prijs:</label>
            <input type="number" name="prijs" value="<?= htmlspecialchars($pizza['prijs']) ?>" step="0.01" required>

            <label>Foto:</label>
            <div style="display: flex; align-items: center; gap: 10px;">
                <?php if (!empty($pizza['foto'])): ?>
                    <img class="foto" src="images/<?= htmlspecialchars($pizza['foto']) ?>"
                        alt="<?= htmlspecialchars($pizza['titel']) ?>">
                    <input type="file" name="foto">
                <?php endif; ?>
            </div>

            <button type="submit">Opslaan</button>

        </form>
    </div>
</body>

</html>