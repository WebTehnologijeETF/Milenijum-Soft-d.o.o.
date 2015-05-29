<?php
    require "Mail.php";
?>
<!DOCTYPE html>
<html>
<head>
	  <title>Reset passworda</title>
	  <meta charset="UTF-8">
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    if (!isset($_POST['username']) || !isset($_POST['mail'])) {
      echo "<form method='post'action='zaboravioSamPassword.php' id='zab'><table><tr><td>Username: </td><td><input type='text' name='username'></td></tr><tr><td>Mail</td><td><input type='text' name='mail'></td></tr><tr><td><input type='submit' value='OK' class='adminDugme'></td></tr></table></form>";
    }
    else {
        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
        $veza->exec("set names utf8");

        $rezultat = $veza->prepare("SELECT * FROM admini WHERE username=?");
        $rezultat->execute(array($_POST['username']));

        $postoji = false;
        foreach ($rezultat as $biloSta) {
            $postoji = true;
        }

        if (!$postoji) {
            echo "<form method='post'action='zaboravioSamPassword.php' id='zab'><table><tr><td>Username: </td><td><input type='text' name='username'></td></tr><tr><td>Mail</td><td><input type='text' name='mail'></td></tr><tr><td><input type='submit' value='OK' class='adminDugme'></td><td>Ne postoji administrator sa usermame i mail koji ste vi unjeli!</td></tr></table></form>";
          }
        else {
          $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
          shuffle($seed);
          $pass = '';
          foreach (array_rand($seed, 8) as $k) $pass .= $seed[$k];

          $rezultat = $veza->prepare("UPDATE admini SET password=md5(?) WHERE username=?");
          $rezultat->execute(array($pass, $_POST['username']));

          if (!$rezultat) {
              $greska = $veza->errorInfo();
              echo "SQL greška: " . $greska[2];
              exit();
          }

          $sender    = "farukljuca1@gmail.com";
          $recipient = $_POST['mail'];
          $body      = "Novi password je: ".$pass;
          $subject   = "Mail za reset passworda sa stranice Milenijum-Soft";

          $server   = "ssl://smtp.gmail.com";
          $username = "farukljuca1@gmail.com";
          $password = "gbmfuitzvlwypziu";
          $port     = "465";

          $headers = array(
            "From"    => $sender,
            "To"      => $recipient,
            "Subject" => $subject
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

          echo "<h2>Vaš password je uspješno resetovan i poslan na mail.</h2>";

          echo "<a href='../index.php'>Nazad na pocetnu</a>";
        }

        $veza = null;
    }
?>

</body>
</html>