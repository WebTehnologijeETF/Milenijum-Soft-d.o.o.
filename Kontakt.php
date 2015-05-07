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
        <h2 class="podnaslov">Unesite podatke i kontaktirajte nas (* - obavezni podaci)</h2>
        <form action="php/kontakti.php" method="post">
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
                            <input type="file">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Ime*:
                    </td>
                    <td>
                        <input id="ime" name="ime" type="text" onblur="validirajIme()">
                    </td>
                    <td class="error" id="errorIme">

                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Mail*:
                    </td>
                    <td>
                        <input id="mail" name="mail" type="email" onblur="validirajMail()">
                    </td>
                    <td class="error" id="errorMail">

                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Ponovite mail*:
                    </td>
                    <td>
                        <input id="ponovniMail" name="ponovniMail" type="email" onblur="validirajPonovniMail()">
                    </td>
                    <td class="error" id="errorPonovniMail">

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
                        <input id="opcina" type="text">
                    </td>
                    <td class="error" id="errorOpcina" onblur="validirajOpcinu()">

                    </td>
                </tr>
                <tr>
                    <td class="naziv">
                        Srednja škola:
                    </td>
                    <td>
                        <input id="srednjaSkola" type="text" onblur="validirajSrednjuSkolu()">
                    </td>
                    <td class="error" id="errorSrednjaSkola">

                    </td>
                </tr>
                <tr>
                    <td class="naziv" id="poruka-tekst">
                        Poruka*:
                    </td>
                    <td>
                        <textarea id="poruka" name="poruka" onblur="validirajPoruku()"></textarea>
                    </td>
                    <td class="error" id="errorPoruka">
                        Poruka ne smije ostati prazna.
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input id="posalji" type="button" value="Pošalji">
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