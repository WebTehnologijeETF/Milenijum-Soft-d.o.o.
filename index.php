<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Naslovna</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="skripte/jquery-2.1.3.js"></script> -->
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>

    <div id="slideShow">
        <img id="slide" width="720" height="300" src="slike/slika1.jpg" alt="Slika o IT-u">
    </div><br><br>

    <form metod="post" action="AdminPanel.php" id="loginDugme">
        <input id="loginAsAdmin" type="submit" value="Admin panel">
    </form>

    <?php
    if (isset($_GET['akcija']) && $_GET['akcija'] = "ostaviKomentar") {
        include("servisi/ostaviKomentar.php");
    }
    ?>
    <h2 class="plavobijelo">Novosti</h2>
    <div id="novosti">
        <div class="headerzlato"></div>
        <?php include("servisi/novostiMySql.php"); ?>
    </div><br><br>
    <footer>
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
<script src="skripte/FunkcijeKomentari.js"></script>
</body>
</html>