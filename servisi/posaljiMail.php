<!DOCTYPE html>
<html>
<head>
	<title>Status maila</title>
	<meta charset="UTF-8">
</head>
<body>
<?php
    $to = "fljuca1@etf.unsa.ba";
    $naslov = "Mail sa kontakt forme Milenijum-Soft";
    $poruka = "Autor: ".htmlentities($_GET['ime'])."\r\n"."Datum slanja: ".date("dd.mm.YYYY")."\r\n"."Grad: ".htmlentities($_GET['grad'])."\r\n"."\r\n".htmlentities($_GET['poruka']);
    $mailAsistenta = "hodzic.k@gmail.com";
    $dodatno = "CC: " . htmlentities($mailAsistenta) . "\r\n" . "Reply-To: " . htmlentities($_GET['mail']);
    $poslanMail = mail($to, $naslov, $poruka, $dodatno);

    echo ($poslanMail == 1) ? "<h2>Zahvaljujemo vam sto ste nas kontaktirali.</h2>" : "<h2>Došlo je do greške pri slanju maila.</h2>";

    echo "<a href='../index.php'>Nazad na pocetnu</a>";
?>
</body>
</html>