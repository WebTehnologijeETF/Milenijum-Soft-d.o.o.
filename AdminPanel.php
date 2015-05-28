<?php
    session_start();
    if (isset($_POST['logout']) && $_POST['logout'] == "Logout") {
        session_unset();
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Admin panel</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>

    <main id="o-nama-main">

        <?php
            if (isset($_SESSION['username'])):
        ?>

        <form method="post" action="AdminPanel.php" class="floatRight">
            <input type="submit" class="adminDugme" value="Logout" name="logout">
        </form>

        <div id="pomBord" class="floatRight"></div>

        <form method="get" action="PromjenaPodatakaAdmina.php" class="floatRight">
            <input type="submit" class="adminDugme" value="Promjeni podatke">
        </form>

        <br><br>

        <div id="adminIzborAkcije">
            <br>
            Odaberite modul:
            <select id="tipAkcije" onchange="promjenaTipAkcije()">
                <option>Novosti</option>
                <option>Komentari</option>
                <option>Administratori</option>
            </select>
            <br><br>
            Odaberite akciju:
            <select id="akcija" onchange="promjenaAkcije()">
            </select>
            <br><br>
        </div>

        <div id="adminAkcije">
            <div id="dodavanjeNovosti" class="adminAkcijaVidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Naslov novosti:</td>
                            <td><input type="text" name="naslovNovostiD" value="<?php if(isset($_POST['naslovNovostiD'])) echo $_POST['naslovNovostiD']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td>Tekst novosti:</td>
                            <td><textarea name="tekstNovostiD" class="ograniciVelicinu"><?php if(isset($_POST['tekstNovostiD'])) echo $_POST['tekstNovostiD']; else echo "";?></textarea></td>
                        </tr>
                        <tr>
                            <td>Detaljniji tekst novosti:</td>
                            <td><textarea name="detaljnijiTekstNovostiD" class="ograniciVelicinu"><?php if(isset($_POST['detaljnijiTekstNovostiD'])) echo $_POST['detaljnijiTekstNovostiD']; else echo "";?></textarea></td>
                        </tr>
                        <tr>
                            <td>Url slike novosti:</td>
                            <td><input type="text" name="slikaNovostiD" value="<?php if(isset($_POST['slikaNovostiD'])) echo $_POST['slikaNovostiD']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Dodaj" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['naslovNovostiD']) && isset($_POST['tekstNovostiD']) && isset($_POST['detaljnijiTekstNovostiD']) && isset($_POST['slikaNovostiD'])) {
                                    if (strlen(trim($_POST['naslovNovostiD'])) == 0)
                                        echo "Naslov novosti ne smije ostati prazan!";
                                    else if (strlen(trim($_POST['tekstNovostiD'])) == 0)
                                        echo "Tekst novosti ne smije ostati prazan!";
                                    else {

                                        $naslov = htmlentities($_POST['naslovNovostiD']);
                                        $tekst = htmlentities($_POST['tekstNovostiD']);
                                        $detaljnijiTekst = htmlentities($_POST['detaljnijiTekstNovostiD']);
                                        $slika = htmlentities($_POST['slikaNovostiD']);
                                        
                                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                        $veza->exec("set names utf8");

                                        $rezultat = $veza->query("SELECT alias FROM admini WHERE username = '".$_SESSION['username']."'");

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }

                                        $autor = "";
                                        foreach ($rezultat as $a) {
                                            $autor = $a['alias'];
                                        }

                                        if (strlen(trim($detaljnijiTekst)) == 0)
                                            $detaljnijiTekst = null;
                                        if (strlen(trim($slika)) == 0)
                                            $slika = null;

                                        $rezultat = $veza->prepare("INSERT INTO novosti SET naslov=?, tekst=?, autor=?, detaljnijiTekst=?, slika=?, datumObjave=NOW()");
                                        $rezultat->execute(array($naslov, $tekst, $autor, $detaljnijiTekst, $slika));

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }

                                        echo "<span style='color: green'>Uspješno dodavanje novosti.</span>";

                                        $veza = null;
                                    }
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div id="modifikacijaNovosti" class="adminAkcijaNevidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Odaberite ID novosti:</td>
                            <td><select name="idNovostiM">
                            <?php

                            $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                            $veza->exec("set names utf8");

                            $rezultat = $veza->query("SELECT idNovosti FROM novosti");

                            if (!$rezultat) {
                                $greska = $veza->errorInfo();
                                echo "SQL greška: " . $greska[2];
                                exit();
                            }

                            foreach ($rezultat as $id) {
                                $oznacen = "";
                                if (isset($_POST['idNovostiM']) && $_POST['idNovostiM'] == $id['idNovosti'])
                                    $oznacen = "selected='selected'";
                                echo "<option ".$oznacen.">".$id['idNovosti']."</option>";
                            }

                            $veza = null;

                            ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Naslov novosti:</td>
                            <td><input type="text" name="naslovNovostiM" value="<?php if(isset($_POST['naslovNovostiM'])) echo $_POST['naslovNovostiM']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td>Tekst novosti:</td>
                            <td><textarea name="tekstNovostiM" class="ograniciVelicinu"><?php if(isset($_POST['tekstNovostiM'])) echo $_POST['tekstNovostiM']; else echo "";?></textarea></td>
                        </tr>
                        <tr>
                            <td>Detaljniji tekst novosti:</td>
                            <td><textarea name="detaljnijiTekstNovostiM" class="ograniciVelicinu"><?php if(isset($_POST['detaljnijiTekstNovostiM'])) echo $_POST['detaljnijiTekstNovostiM']; else echo "";?></textarea></td>
                        </tr>
                        <tr>
                            <td>Url slike novosti:</td>
                            <td><input type="text" name="slikaNovostiM" value="<?php if(isset($_POST['slikaNovostiM'])) echo $_POST['slikaNovostiM']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Modifikuj" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['idNovosti']) && isset($_POST['naslovNovostiM']) && isset($_POST['tekstNovostiM']) && isset($_POST['detaljnijiTekstNovostiM']) && isset($_POST['slikaNovostiM'])) {
                                    if (strlen(trim($_POST['naslovNovostiM'])) == 0)
                                        echo "Naslov novosti ne smije ostati prazan!";
                                    else if (strlen(trim($_POST['tekstNovostiM'])) == 0)
                                        echo "Tekst novosti ne smije ostati prazan!";
                                    else {

                                        $naslov = htmlentities($_POST['naslovNovostiM']);
                                        $tekst = htmlentities($_POST['tekstNovostiM']);
                                        $detaljnijiTekst = htmlentities($_POST['detaljnijiTekstNovostiM']);
                                        $slika = htmlentities($_POST['slikaNovostiM']);
                                        
                                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                        $veza->exec("set names utf8");

                                        $rezultat = $veza->query("SELECT alias FROM admini WHERE username = '".$_SESSION['username']."'");

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }

                                        $autor = "";
                                        foreach ($rezultat as $a) {
                                            $autor = $a['alias'];
                                        }

                                        if (strlen(trim($detaljnijiTekst)) == 0)
                                            $detaljnijiTekst = null;
                                        if (strlen(trim($slika)) == 0)
                                            $slika = null;

                                        $rezultat = $veza->prepare("UPDATE novosti SET naslov=?, tekst=?, autor=?, detaljnijiTekst=?, slika=?, datumObjave=NOW() WHERE idNovosti=?");
                                        $rezultat->execute(array($naslov, $tekst, $autor, $detaljnijiTekst, $slika, $_POST['idNovosti']));

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }

                                        echo "<span style='color: green'>Uspješna modifikacija novosti.</span>";

                                        $veza = null;
                                    }
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div id="brisanjeNovosti" class="adminAkcijaNevidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Odaberite ID novosti:</td>
                            <td><select name="idNovostiB">

                            <?php

                            $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                            $veza->exec("set names utf8");

                            $rezultat = $veza->query("SELECT idNovosti FROM novosti");

                            if (!$rezultat) {
                                $greska = $veza->errorInfo();
                                echo "SQL greška: " . $greska[2];
                                exit();
                            }

                            foreach ($rezultat as $id) {
                                $tekstBrisanje = "<option>".$id['idNovosti']."</option>";
                                if (isset($_POST['idNovostiB']) && $_POST['idNovostiB'] == $id['idNovosti'])
                                    $tekstBrisanje = "";
                                echo $tekstBrisanje;
                            }

                            $veza = null;

                            ?>

                            </select></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Obriši" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['idNovostiB'])) {
                                    
                                    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                    $veza->exec("set names utf8");

                                    $rezultat = $veza->prepare("DELETE FROM novosti WHERE idNovosti=?");
                                    $rezultat->execute(array($_POST['idNovostiB']));

                                    if (!$rezultat) {
                                        $greska = $veza->errorInfo();
                                        echo "SQL greška: " . $greska[2];
                                        exit();
                                    }

                                    echo "<span style='color: green'>Uspješno brisanje novosti.</span>";

                                    $veza = null;
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div id="brisanjeKomentara" class="adminAkcijaNevidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Odaberite ID komentara:</td>
                            <td><select name="idKomentariB">

                            <?php

                            $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                            $veza->exec("set names utf8");

                            $rezultat = $veza->query("SELECT idKomentari FROM komentari");

                            if (!$rezultat) {
                                $greska = $veza->errorInfo();
                                echo "SQL greška: " . $greska[2];
                                exit();
                            }

                            foreach ($rezultat as $id) {
                                $tekstBrisanje = "<option>".$id['idKomentari']."</option>";
                                if (isset($_POST['idKomentariB']) && $_POST['idKomentariB'] == $id['idKomentari'])
                                    $tekstBrisanje = "";
                                echo $tekstBrisanje;
                            }

                            $veza = null;

                            ?>

                            </select></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Obriši" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['idKomentariB'])) {
                                    
                                    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                    $veza->exec("set names utf8");

                                    $rezultat = $veza->prepare("DELETE FROM komentari WHERE idKomentari=?");
                                    $rezultat->execute(array($_POST['idKomentariB']));

                                    if (!$rezultat) {
                                        $greska = $veza->errorInfo();
                                        echo "SQL greška: " . $greska[2];
                                        exit();
                                    }

                                    echo "<span style='color: green'>Uspješno brisanje komentara.</span>";

                                    $veza = null;
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div id="dodavanjeAdministratora" class="adminAkcijaNevidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="usernameAdmina" value="<?php if(isset($_POST['usernameAdmina'])) echo $_POST['usernameAdmina']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td>Alias:</td>
                            <td><input type="text" name="aliasAdmina" value="<?php if(isset($_POST['aliasAdmina'])) echo $_POST['aliasAdmina']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td>Mail:</td>
                            <td><input type="text" name="mailAdmina" value="<?php if(isset($_POST['mailAdmina'])) echo $_POST['mailAdmina']; else echo "";?>"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input id="pass1" name="pass1" type="password" name="passwordAdmina"></td>
                        </tr>
                        <tr>
                            <td>Ponovite password:</td>
                            <td><input id="pass2" name="pass2" type="password"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Dodaj" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['usernameAdmina']) && isset($_POST['aliasAdmina']) && isset($_POST['mailAdmina']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
                                    if (strlen(trim($_POST['usernameAdmina'])) == 0)
                                        echo "Username administratora ne smije ostati prazan!";
                                    else if (strlen(trim($_POST['pass1'])) < 6)
                                        echo "Password mora imati minimalnu dužinu 6 karaktera!";
                                    else if ($_POST['pass1'] !== $_POST['pass2'])
                                        echo "Password i ponovljeni password nisu jednaki!";
                                    else if (preg_match('/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/', $_POST['mailAdmina']) == false)
                                        echo "Mail nije u tačnom formatu!";
                                    else {
                                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                        $veza->exec("set names utf8");

                                        $rezultat = $veza->prepare("SELECT * FROM admini WHERE username=?");
                                        $rezultat->execute(array($_POST['usernameAdmina']));

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }
                                        
                                        if ($rezultat->rowCount() >= 1) {
                                            echo "Username koji ste unjeli je zauzet!";
                                        }
                                        else {
                                            $username = htmlentities($_POST['usernameAdmina']);
                                            $alias = htmlentities($_POST['aliasAdmina']);
                                            $mail = htmlentities($_POST['mailAdmina']);
                                            $pass = htmlentities($_POST['pass1']);

                                            $autor = "";
                                            foreach ($rezultat as $a) {
                                                $autor = $a['alias'];
                                            }

                                            if (strlen(trim($alias)) == 0)
                                                $alias = $username;

                                            $rezultat = $veza->prepare("INSERT INTO admini SET username=?, password=md5(?), alias=?, mail=?");
                                            $rezultat->execute(array($username, $pass, $alias, $mail));

                                            if (!$rezultat) {
                                                $greska = $veza->errorInfo();
                                                echo "SQL greška: " . $greska[2];
                                                exit();
                                            }

                                            echo "<span style='color: green'>Uspješno dodavanje administratora.</span>";

                                        }
                                        $veza = null;
                                    }
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div id="brisanjeAdministratora" class="adminAkcijaNevidljiv">
                <form method="post" action="AdminPanel.php">
                    <table>
                        <tr>
                            <td>Odaberite ID administratora:</td>
                            <td><select name="idAdministratora">

                            <?php

                            $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                            $veza->exec("set names utf8");

                            $rezultat = $veza->query("SELECT idAdmina FROM admini");

                            if (!$rezultat) {
                                $greska = $veza->errorInfo();
                                echo "SQL greška: " . $greska[2];
                                exit();
                            }

                            foreach ($rezultat as $id) {
                                echo "<option>".$id['idAdmina']."</option>";
                                $tekstBrisanje = "<option>".$id['idAdmina']."</option>";
                                if (isset($_POST['idAdministratora']) && $_POST['idAdministratora'] == $id['idAdmina'])
                                    $tekstBrisanje = "";
                                echo $tekstBrisanje;
                            }

                            $veza = null;

                            ?>


                            </select></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Obriši" class="adminDugme"></td>
                            <td>
                                <?php

                                if (isset($_POST['idAdministratora'])) {                                 
                                    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                                    $veza->exec("set names utf8");

                                    $rezultat = $veza->prepare("SELECT username FROM admini WHERE idAdmina=?");
                                    $rezultat->execute(array($_POST['idAdministratora']));

                                    if (!$rezultat) {
                                        $greska = $veza->errorInfo();
                                        echo "SQL greška: " . $greska[2];
                                        exit();
                                    }
                                    
                                    $dobar=true;

                                    foreach ($rezultat as $juzernejm) {
                                        if ($juzernejm['username'] == $_SESSION['username'])
                                            $dobar = false;
                                    }

                                    if ($dobar == false) {
                                        echo "Ne možete sebe obrisati!";
                                    }
                                    else {
                                        $rezultat = $veza->prepare("DELETE FROM admini WHERE idAdmina=?");
                                        $rezultat->execute(array($_POST['idAdministratora']));

                                        if (!$rezultat) {
                                            $greska = $veza->errorInfo();
                                            echo "SQL greška: " . $greska[2];
                                            exit();
                                        }

                                        echo "<span style='color: green'>Uspješno brisanje administratora.</span>";
                                    }

                                    $veza = null;
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div id="adminPrikaz">
            <div id="prikazNovosti" class="adminAkcijaVidljiv">
                <table class="tblAdminPrikaz">
                    <tr>
                        <th>ID</th>
                        <th>Naslov</th>
                        <th>Tekst</th>
                        <th>Detaljniji tekst</th>
                        <th>Datum</th>
                        <th>Autor</th>
                        <th>Slika</th>
                    </tr>
                    <?php
                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                        $veza -> exec("set names utf8");
                        $rezultat = $veza -> query("SELECT idNovosti, naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(datumObjave) vrijeme, autor, slika
                                                    FROM novosti");

                        if (!$rezultat) {
                            $greska = $veza->errorInfo();
                            echo "SQL greška: " . $greska[2];
                            exit();
                        }

                        foreach ($rezultat as $novost) {
                            $slikaString = "<img width='100' src='".$novost['slika']."'>";
                            if ($novost['slika'] == null)
                                $slikaString = "<small>Bez slike<small>";
                            $detaljnijeString = $novost['detaljnijiTekst'];
                            if ($novost['slika'] == null)
                                $detaljnijeString = "Bez detalja";

                            echo "<tr>".
                                "<td><small>".$novost['idNovosti']."</small></td>".
                                "<td><small>".$novost['naslov']."</small></td>".
                                "<td><small>".$novost['tekst']."</small></td>".
                                "<td><small>".$detaljnijeString."</small></td>".
                                "<td><small>".date("d.m.Y. (h:i)", $novost['vrijeme'])."</small></td>".
                                "<td><small>".$novost['autor']."</small></td>".
                                "<td>".$slikaString."</td>".
                                "</tr></td>";
                        }
                        $veza = null;
                    ?>
                </table>
            </div>
            <div id="prikazKomentari" class="adminAkcijaNevidljiv">
                <table class="tblAdminPrikaz">
                    <tr>
                        <th>ID</th>
                        <th>Novost</th>
                        <th>Naslov novosti</th>
                        <th>Autor</th>
                        <th>Vrijeme</th>
                        <th>Mail</th>
                        <th>Tekst</th>
                    </tr>
                    <?php
                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                        $veza -> exec("set names utf8");
                        $rezultat = $veza -> query("SELECT idKomentari, idNovosti, autor, mail, UNIX_TIMESTAMP(vrijemeObjave) vrijeme, tekst,
                                                    (
                                                        SELECT naslov
                                                        FROM novosti
                                                        WHERE idNovosti = komentari.idNovosti
                                                    ) naslov
                                                    FROM komentari");

                        if (!$rezultat) {
                            $greska = $veza->errorInfo();
                            echo "SQL greška: " . $greska[2];
                            exit();
                        }

                        foreach ($rezultat as $komentar) {
                            echo "<tr>".
                                "<td><small>".$komentar['idKomentari']."</small></td>".
                                "<td><small>".$komentar['idNovosti']."</small></td>".
                                "<td><small>".$komentar['naslov']."</small></td>".
                                "<td><small>".$komentar['autor']."</small></td>".
                                "<td><small>".date("d.m.Y. (h:i)", $komentar['vrijeme'])."</small></td>".
                                "<td><small>".$komentar['mail']."</small></td>".
                                "<td><small>".$komentar['tekst']."</small></td>".
                                "</tr></td>";
                        }
                        $veza = null;
                    ?>
                </table>
            </div>
            <div id="prikazAdministratori" class="adminAkcijaNevidljiv">
                <table class="tblAdminPrikaz">
                    <tr>
                        <th>ID</th>
                        <th>Alias</th>
                        <th>Username</th>
                        <th>Mail</th>
                    </tr>
                    <?php
                        $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                        $veza -> exec("set names utf8");
                        $rezultat = $veza -> query("SELECT idAdmina, alias, username, mail
                                                    FROM admini");

                        if (!$rezultat) {
                            $greska = $veza->errorInfo();
                            echo "SQL greška: " . $greska[2];
                            exit();
                        }

                        foreach ($rezultat as $admin) {
                            echo "<tr>".
                                "<td><small>".$admin['idAdmina']."</small></td>".
                                "<td><small>".$admin['alias']."</small></td>".
                                "<td><small>".$admin['username']."</small></td>".
                                "<td><small>".$admin['mail']."</small></td>".
                                "</tr></td>";
                        }
                        $veza = null;
                    ?>
                </table>
            </div>
        </div>

        <?php
            else:
        ?>
        <div id="logiranjeForma">
            <form method="post" action="AdminPanel.php">
                <input id="username" name="username" type="text" placeholder="Username"><br><br>
                <input id="password" name="password" type="password" placeholder="Password"><br><br>
                <input id="logirajSe" type="submit" value="Logiraj se">
                <?php
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
                    $veza -> exec("set names utf8");

                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $rezultat = $veza -> prepare("SELECT * FROM admini WHERE username=? && password=md5(?)");
                    $rezultat->execute(array($username, $password));

                    if (!$rezultat) {
                        $greska = $veza->errorInfo();
                        echo "SQL greška: " . $greska[2];
                        exit();
                    }
                    
                    if ($rezultat->rowCount() == 0) {
                        echo "<br><h4>Pogresan username ili password</h4>";
                    }
                    else {
                        $_SESSION['username'] = $_POST['username'];
                        header("Location: AdminPanel.php");
                        exit();
                    }

                    $veza = null;
                }
            ?>
            </form>
        </div>
        <?php
            endif;
        ?>

    </main>

    <footer id="referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
<script src="skripte/adminPanel.js"></script>
</body>
</html>