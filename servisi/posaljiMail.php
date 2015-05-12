<?php
    $to = "fljuca1@etf.unsa.ba";
    $naslov = "Mail sa kontakt forme Milenijum-Soft";
    $poruka = "Autor: ".$_GET['ime']."\r\n"."Datum slanja: ".date("dd.mm.YYYY")."\r\n"."Grad: ".$_GET['grad']."\r\n"."\r\n".$_GET['poruka'];
    $mailAsistenta = "hodzic.k@gmail.com";
    $dodatno = "CC: " . $mailAsistenta . "\r\n" . "Reply-To: " . $_GET['mail'];
    $poslanMail = mail($to, $naslov, $poruka, $dodatno);

    echo ($poslanMail == 1) ? "Zahvaljujemo vam sto ste nas kontaktirali." : "Došlo je do greške pri slanju maila.";
?>