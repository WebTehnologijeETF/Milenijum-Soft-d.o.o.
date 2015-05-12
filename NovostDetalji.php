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
    <main id="o-nama-main">
        <h2 class="podnaslov"><?=htmlentities($_GET['naslov'])?></h2>
        <?php if($_GET['slika'] != "\r\n"): ?>
            <img width="400" id="slika1" src="<?=htmlentities($_GET['slika'])?>" alt="Slika novosti">
        <?php endif; ?>
        <p><?=htmlentities($_GET['datum'])?><br>Autor: <?=htmlentities($_GET['autor'])?></p><br>
        <h3>Opis novosti</h3>
        <p><?=htmlentities($_GET['opis'])?></p><br>
        <h3>Detaljniji tekst novosti</h3>
        <p><?=htmlentities($_GET['tekst'])?></p><br>
    </main>
    <footer id = "referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/Podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>