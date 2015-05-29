<?php
$ime = htmlentities($_POST['ime']);
$mail = htmlentities($_POST['mail']);
$drzava = ($_POST['country'] == -1) ? "Niste unijeli državu" : htmlentities($_POST['country']);
$grad = (isset($_POST['state']) == false) ? "Niste unijeli grad" : htmlentities($_POST['state']);
$opcina = htmlentities($_POST['opcina']);
$srednjaSkola = htmlentities($_POST['srednjaSkola']);
$poruka = htmlentities($_POST['poruka']);

/*
$imagename = $_FILES['slika']['name'];
$imagetemp = $_FILES['slika']['tmp_name'];

$imagePath = "slikeUpload/";

if(is_uploaded_file($imagetemp)) {
    if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
        echo "Uspjesno ucitavanje slike";
    }
    else {
        echo "Neuspjelo ucitavanje slike";
    }
}
else {
    echo "Neuspjesno ucitavanje slike";
}
*/
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
    <p><?=($opcina == "") ? "Niste unijeli opcinu" : $opcina?></p>
    <p><?=($srednjaSkola == "") ? "Niste unijeli srednju skolu" : $srednjaSkola?></p>
    <p><?=$poruka?></p>
</div>
<div id=potvrdaSlanjaTekst>
    <h3>Da li ste sigurni da želite poslati ove podatke?</h3>
    <a href="servisi/posaljiMail.php?ime=<?=urlencode($ime)?>&mail=<?=urlencode($mail)?>&drzava=<?=urlencode($drzava)?>&grad=<?=urlencode($grad)?>&opcina=<?=urlencode($opcina)?>&srednjaSkola=<?=urlencode($srednjaSkola)?>&poruka=<?=urlencode($poruka)?>"> Siguran sam </a>
</div>