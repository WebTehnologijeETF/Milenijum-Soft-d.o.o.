<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Proizvodi</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="skripte/jquery-2.1.3.js"></script> -->
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>
    <main id="proizvodi-main">
        <h2 class="podnaslov">Proizvodi</h2>
        <div class="kol1">
            <img src="slike/pro1.jpg" width="200" height="100" alt="Proizvod kompanije.">
            <p>Realizacija softvera za <br> potrebe sektora finansija.</p>
            <h3>Finansijsko poslovanje</h3>
        </div>
        <div class="kol2">
            <img src="slike/pro2.jpg" width="200" height="100" alt="Proizvod kompanije.">
            <p>Veleprodaja i/ili maloprodaja.</p>
            <h3>Robno poslovanje</h3>
        </div>
        <div class="kol3">
            <img src="slike/pro3.jpg" width="200" height="100" alt="Proizvod kompanije.">
            <p>Uključujući i MIP&amp;GIP obrasce.</p>
            <h3>Plate uposlenih</h3>
        </div>
        <div class="kol1">
            <img src="slike/pro4.jpg" width="200" height="100" alt="Proizvod kompanije.">
            <p>Omogućeni modaliteti obračuna prema potrebama korisnika.</p>
            <h3>Stalna sredstva</h3>
        </div>
        <div class="kol2">
            <img src="slike/pro5.jpg" width="200" height="100" alt="Proizvod kompanije.">
            <p>Fakturisanje usluga, Transfer podataka, Analiza poslovanja</p>
            <h3>Ostali proizvodi</h3>
        </div>

        <br><br><br>
        <table id="tabela">
            <caption><h2 class="podnaslov">Karakteristike softvera</h2></caption>
            <tr>
                <th></th>
                <th>NAZIV</th>
                <th>O P I S</th>
            </tr>
            <tr>
                <td class="brojevi">1.</td>
                <td>Platforme</td>
                <td>Win95, Win98, XP, Windows7, Windows8, Linux</td>
            </tr>
            <tr>
                <td class="brojevi">2.</td>
                <td>Modularnost</td>
                <td>Proizvodi funkcionišu neovisno ili povezani na različitim lokacijama.</td>
            </tr>
            <tr>
                <td class="brojevi">3.</td>
                <td>Fleksibilnost</td>
                <td>Moguće prilagođavanje potrebama korisnika.</td>
            </tr>
            <tr>
                <td class="brojevi">4.</td>
                <td>User friendly</td>
                <td>Maksimalna efektivnost korištenja baze podataka.</td>
            </tr>
            <tr>
                <td class="brojevi">5.</td>
                <td>Integralnost</td>
                <td>Integralan rad svih modula sa razmjenom podataka.</td>
            </tr>
        </table>
    </main>
    <footer id = "referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>