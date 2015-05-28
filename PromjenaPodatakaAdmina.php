<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Promjena podataka administratora</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>

    <?php

    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");
    $rezultat = $veza -> prepare("SELECT alias, mail
                                FROM admini
                                WHERE username=?");
    $rezultat->execute(array($_SESSION['username']));

    $alias = "";
    $mail = "";

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        echo "SQL greška: " . $greska[2];
        exit();
    }

    foreach ($rezultat as $admin) {
        $alias = $admin['alias'];
        $mail = $admin['mail'];
    }

    $veza = null;

    ?>

    <main id="o-nama-main">
        <form id="promjenaAdmina" method="post" action="PromjenaPodatakaAdmina.php">
            <table>
                <tr>
                    <td>Novi alias: </td>
                    <td>
                        <input type="text" name="alias" value="<?php if(isset($_POST['alias'])) echo $_POST['alias']; else echo $alias; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Novi mail: </td>
                    <td>
                        <input type="text" name="mail" value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; else echo $mail; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Novi password: </td>
                    <td><input type="password" name="pass1"></td>
                </tr>
                <tr>
                    <td>Novi password: </td>
                    <td><input type="password" name="pass2"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Promjeni" class="adminDugme">
                    </td>
                    <td>
                        <?php

                        if (isset($_POST['alias']) && isset($_POST['mail']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
                            if (preg_match('/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/', $_POST['mail']) == false)
                                echo "Mail nije u tačnom formatu!";
                            else if ($_POST['pass1'] !== $_POST['pass2'])
                                echo "Password i ponovljeni password nisu jednaki!";
                            else if (strlen(trim($_POST['pass1'])) < 6)
                                echo "Password mora imati minimalnu dužinu 6 karaktera!";
                            else {                                
                                $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                $veza->exec("set names utf8");

                                $alias = htmlentities($_POST['alias']);
                                $mail = htmlentities($_POST['mail']);
                                $pass = htmlentities($_POST['pass1']);

                                if (strlen(trim($alias)) == 0)
                                    $alias = $username;

                                $rezultat = $veza->prepare("UPDATE admini SET alias=?, mail=?, password=md5(?) WHERE username=?");
                                $rezultat->execute(array($alias, $mail, $pass, $_SESSION['username']));

                                if (!$rezultat) {
                                    $greska = $veza->errorInfo();
                                    echo "SQL greška: " . $greska[2];
                                    exit();
                                }

                                echo "<span style='color: green'>Uspješna modifikacija podataka.</span><br><a href='AdminPanel.php'>Nazad</a>";

                                $veza = null;
                            }
                        }

                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </main>
    
    <footer id="referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>