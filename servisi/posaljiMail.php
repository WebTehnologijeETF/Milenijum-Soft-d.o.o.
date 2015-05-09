<?php
    ini_set("SMTP", "mail.davion.comuv.com");
    ini_set("smtp_port", "25");
    echo mail("fljuca1@etf.unsa.ba", "Naslov", "Poruka", "From: fljuca1@etf.unsa.ba"."\r\n"."CC: farukljuca1@gmail.com");
?>