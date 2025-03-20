<?php
date_default_timezone_set('Europe/Amsterdam');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body class="index">
    <main>
        <div class="app" draggable="true">
            <a href=""><img src="img/over.png" alt="map">over mij</a>
        </div>
        <div class="app">
            <a href=""><img src="img/folder.png" alt="map">projecten</a>
        </div>
        <div class="app">
            <a href=""><img src="img/contact.png" alt="map">contact</a>
        </div>
    </main>

    <footer>
        <div></div>
        <div class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <div class="search">
                <img src="img/zoeken.png" alt="zoeken">
                Zoeken
            </div>
            <nav>
                <a href=""><img src="img/over.png" alt="map"></a>
                <a href=""><img src="img/folder.png" alt="map"></a>
                <a href=""><img src="img/contact.png" alt="map"></a>
            </nav>
        </div>
        <?php
        echo '<div class="datum">';
        echo '<div class="tijd" id="liveClock"></div>';
        echo '<div class="date">';
        echo date('d-m-Y');
        echo '</div>';
        echo '</div>';
        ?>
        <script>
            function updateClock() {
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0');
                var minutes = now.getMinutes().toString().padStart(2, '0');
                document.getElementById('liveClock').innerText = hours + ':' + minutes;
            }
            setInterval(updateClock, 1000);
            updateClock();

            document.addEventListener('DOMContentLoaded', (event) => {
                let selectionBox = document.createElement('div');
                selectionBox.className = 'selection-box';
                document.body.appendChild(selectionBox);

                let startX, startY;

                document.addEventListener('mousedown', (e) => {
                    startX = e.clientX;
                    startY = e.clientY;
                    selectionBox.style.left = startX + 'px';
                    selectionBox.style.top = startY + 'px';
                    selectionBox.style.width = '0px';
                    selectionBox.style.height = '0px';
                    selectionBox.style.display = 'block';
                });

                document.addEventListener('mousemove', (e) => {
                    if (selectionBox.style.display === 'block') {
                        let currentX = e.clientX;
                        let currentY = e.clientY;
                        selectionBox.style.width = Math.abs(currentX - startX) + 'px';
                        selectionBox.style.height = Math.abs(currentY - startY) + 'px';
                        selectionBox.style.left = Math.min(currentX, startX) + 'px';
                        selectionBox.style.top = Math.min(currentY, startY) + 'px';
                    }
                });

                document.addEventListener('mouseup', (e) => {
                    selectionBox.style.display = 'none';
                });
            });
        </script>
    </footer>
</body>

</html>