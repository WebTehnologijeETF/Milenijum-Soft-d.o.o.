<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Kontakt</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="skripte/jquery-2.1.3.js"></script>
    <script src = "skripte/gradovi.js"></script>
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>
    <main id="kontakt-main">

        <?php include('servisi/serverSideValidacija.php'); ?>

        <?php if(isset($_POST['ime']) && isset($_POST['mail']) && isset($_POST['ponovniMail']) && isset($_POST['poruka']) && ($_POST['ime']) && validirajMail($_POST['mail']) && validirajPonovniMail($_POST['mail'], $_POST['ponovniMail']) && validirajPoruku($_POST['poruka'])) : ?>
            <?php include("dijelovi/potvrdaSlanja.php"); ?>

        <?php else : ?>

        <h2 class="podnaslov">Unesite podatke i kontaktirajte nas (* - obavezni podaci)</h2>
        <form action="Kontakt.php" method="post" onsubmit="return validirajSve();">
            <table id="kontakt-tabela">
                <tr>
                    <td class="staviNaCentar" colspan="3">
                        <h3>Dodajte sliku:</h3>
                        <img src="slike/korisnik.png" id="kontakt_slikaKorisnika" alt="User image that can be uploaded">
                    </td>
                </tr>
                <tr>
                    <td class="staviNaCentar" colspan="3">
                        <p>
                            <input name="slika" type="file">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Ime*:
                    </td>
                    <td>
                        <input <?php if(isset($_POST['ime'])){ if(validirajIme($_POST['ime'])) echo "class='ispravnoPolje'"; else echo "class='neispravnoPolje'";} ?> id="ime" name="ime" type="text" onblur="validirajIme()" value="<?php if(isset($_REQUEST['ime'])) echo $_REQUEST['ime']; else echo ""; ?>">
                    </td>
                    <td class="error" id="errorIme" <?php if(isset($_POST['ime'])){ if(validirajIme($_POST['ime'])) echo ""; else echo "style='display: block'";} ?>>
                        Pogrešnon uneseno ime.
                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Mail*:
                    </td>
                    <td>
                        <input <?php if(isset($_POST['mail'])){ if(validirajMail($_POST['mail'])) echo "class='ispravnoPolje'"; else echo "class='neispravnoPolje'";} ?> id="mail" name="mail" type="email" onblur="validirajMail()" value="<?php if(isset($_REQUEST['mail'])) echo $_REQUEST['mail']; else echo ""; ?>">
                    </td>
                    <td class="error" id="errorMail" <?php if(isset($_POST['mail'])){ if(validirajMail($_POST['mail'])) echo ""; else echo "style='display: block'";} ?>>
                        Pogrešno unesen mail.
                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Ponovite mail*:
                    </td>
                    <td>
                        <input <?php if(isset($_POST['ponovniMail'])){ if(validirajPonovniMail($_POST['mail'], $_POST['ponovniMail'])) echo "class='ispravnoPolje'"; else echo "class='neispravnoPolje'";} ?> id="ponovniMail" name="ponovniMail" type="email" onblur="validirajPonovniMail()" value="<?php if(isset($_REQUEST['ponovniMail'])) echo $_REQUEST['ponovniMail']; else echo ""; ?>">
                    </td>
                    <td class="error" id="errorPonovniMail" <?php if(isset($_POST['ponovniMail'])){ if(validirajPonovniMail($_POST['mail'], $_POST['ponovniMail'])) echo ""; else echo "style='display: block'";} ?>>
                        Mailovi nisu jednaki.
                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Drzava:
                    </td>
                    <td>
                        <select id="country" name ="country"></select>
                    </td>
                    <td class="error" id="errorDrzava">

                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Grad:
                    </td>
                    <td>
                        <select name ="state" id ="state"></select>
                    </td>
                    <td class="error" id="errorGrad">

                    </td>
                </tr>
                <!--                       OPĆINA I SREDNJA SKOLA                     -->
                <tr>
                    <td class="naziv">
                        Općina:
                    </td>
                    <td>
                        <input id="opcina" name="opcina" type="text" onblur="validirajOpcinu()" value="<?php if(isset($_REQUEST['opcina'])) echo $_REQUEST['opcina']; else echo ""; ?>">
                    </td>
                    <td class="error" id="errorOpcina">

                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Srednja škola:
                    </td>
                    <td>
                        <input id="srednjaSkola" name="srednjaSkola" type="text" onblur="validirajSrednjuSkolu()" value="<?php if(isset($_REQUEST['srednjaSkola'])) echo $_REQUEST['srednjaSkola']; else echo ""; ?>">
                    </td>
                    <td class="error" id="errorSrednjaSkola">

                    </td>
                </tr>
                <tr>
                    <td class="naziv" id="poruka-tekst">
                        Poruka*:
                    </td>
                    <td>
                        <textarea <?php if(isset($_POST['poruka'])){ if(validirajPoruku($_POST['poruka'])) echo "class='ispravnoPolje'"; else echo "class='neispravnoPolje'";} ?> id="poruka" name="poruka" onblur="validirajPoruku()"><?php if(isset($_POST['poruka'])) echo $_POST['poruka']; else echo ""; ?></textarea>
                    </td>
                    <td class="error" id="errorPoruka" <?php if(isset($_POST['poruka'])){ if(validirajPoruku($_POST['poruka'])) echo ""; else echo "style='display: block'";} ?>>
                        Poruka ne smije ostati prazna.
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input id="posalji" type="submit" value="Pošalji">
                    </td>
                </tr>
            </table>
        </form><br><br>
        <p>Enrique Iglesias - Bailando</p>
        <audio controls>
            <source src="ostalo/pjesma.mp3" type="audio/mpeg">
        </audio>
        <iframe id="video" width="720" height="490" src="https://www.youtube.com/embed/2nztIcqZwoA"></iframe>
        <details>
            <summary>Detalji o videu</summary>
            <p>Video možete pogledati i na youtube.com tako što pratite <a href="https://www.youtube.com/watch?v=2nztIcqZwoA">ovaj</a> link.</p>
        </details>

        <?php endif; ?>

    </main>
    <footer id="referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script>
    populateCountries("country", "state");
</script>
<script src="skripte/Podmeni.js"></script>
<script src="skripte/KontaktForma.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>