<!DOCTYPE html>
<html>
<head>
	<title>Status maila</title>
	<meta charset="UTF-8">
</head>
<body>
<?php
    require "Mail.php";

    $sender    = "farukljuca1@gmail.com";
    $recipient = "fljuca1@etf.unsa.ba, sferizovic1@etf.unsa.ba"; //"hodzic.k@gmail.com";
    $body      = "Autor: ".htmlentities(urldecode($_GET['ime']))."\r\n"."Datum slanja: ".date("d.m.Y")."\r\n"."Grad: ".htmlentities(urldecode($_GET['grad']))."\r\n"."\r\n".htmlentities(urldecode($_GET['poruka']));
    $subject   = "Mail sa kontakt forme Milenijum-Soft";
    $reply     = htmlentities(urldecode($_GET['mail']));
    $cc        = "hodzic.k@gmail.com";

    $server   = "ssl://smtp.gmail.com";
    $username = "farukljuca1@gmail.com";
    $password = "gbmfuitzvlwypziu";
    $port     = "465";

    $headers = array(
      "From"    => $sender,
      "To"      => $recipient,
      "CC"      => $cc,
      "Subject" => $subject,
      "Reply-To"=> $reply
    );

    $smtp = Mail::factory("smtp",
      array(
        "host"     => $server,
        "username" => $username,
        "password" => $password,
        "auth"     => true,
        "port"     => 465
      )
    );

    $mail = $smtp->send($recipient, $headers, $body);

    if (PEAR::isError($mail)) {
      echo ($mail->getMessage());
    }
    else {
        echo "<h2>Zahvaljujemo vam sto ste nas kontaktirali.</h2>";
    }
    echo "<a href='../index.php'>Nazad na pocetnu</a>";
?>

</body>
</html>