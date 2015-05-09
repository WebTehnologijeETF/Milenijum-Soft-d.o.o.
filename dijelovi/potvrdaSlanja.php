<?php
$ime = "Faruk";
$mail = "fljuca1@etf.unsa.ba";
$drzava = "Bosna i Hercegovina";
$grad = "Sarajevo";
$opcina = "Centar";
$srednjaSkola = "Druga gimnazija";
$poruka = "Samo pozdravi \n Samo svima pozdravi. \n Pozdrav za hugu i male hugice i hugolinu.";
?>

<h2 class="podnaslov">Provjerite da li ste ispravno popunili kontakt formu:</h2>

<div id="prikazKontaktaLijevo">
    <p>Ime:</p>
    <p>Mail:</p>
    <p>Država:</p>
    <p>Grad:</p>
    <p>Općina:</p>
    <p>Srednja škola:</p>
    <p>Poruka:</p>
</div>
<div id="prikazKontaktaDesno">
    <p><?=$ime?></p>
    <p><?=$mail?></p>
    <p><?=$drzava?></p>
    <p><?=$grad?></p>
    <p><?=$opcina?></p>
    <p><?=$srednjaSkola?></p>
    <p><?=$poruka?></p>
</div>

<h3>Da li ste sigurni da želite poslati ove podatke?</h3>
<form method="get" action="servisi/posaljiMail.php?ime=<?=urlencode($ime)?>&mail=<?=urlencode($mail)?>&drzava=<?=urlencode($drzava)?>&grad=<?=urlencode($grad)?>&opcina=<?=urlencode($opcina)?>&srednjaSkola=<?=urlencode($srednjaSkola)?>&poruka=<?=urlencode($poruka)?>">
    <input type="button" value="Siguran sam">
</form>