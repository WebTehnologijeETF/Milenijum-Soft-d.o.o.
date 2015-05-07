<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Administracija Proizvoda</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
</head>
<body>
<div id="forma">
    <?php include("dijelovi/header.php"); ?>
    <main id="proizvodiAdministracija-main">
        <h2 class="podnaslov">Odaberite akciju i uredite proizvode</h2>
        <div id="tabelaProizvodaDiv">
            <table id="tabelaProizvoda"></table>
        </div>

        <div id="funkcije">
            Odaberite akciju:
            <select id="akcija" onchange="promjenaAkcije()">
                <option>Dodavanje</option>
                <option>Promjena</option>
                <option>Brisanje</option>
            </select>
            <div id="dodavanje">
                <table>
                    <tr>
                        <td>Naziv:</td>
                        <td><input type="text" id="nazivDodavanje"></td>
                    </tr>
                    <tr>
                        <td>Opis:</td>
                        <td><input type="text" id="opisDodavanje"></td>
                    </tr>
                    <tr>
                        <td>Slika:</td>
                        <td><input type="text" id="slikaDodavanje"></td>
                    </tr>
                    <tr>
                        <td>Url:</td>
                        <td><input type="text" id="urlDodavanje"></td>
                    </tr>
                    <tr>
                        <td>Cijena:</td>
                        <td><input type="text" id="cijenaDodavanje"></td>
                    </tr>
                    <tr>
                        <td>Dostupan:</td>
                        <td><input type="checkbox" id="dostupnostDodavanje"></td>

                    </tr>
                </table>

                <button id="dodaj" onclick="dodaj()">OK</button>
                <span id="errorDodaj"></span>
            </div>
            <div id="promjena">
                <table>
                    <tr>
                        <td>Id:</td>
                        <td><select id="idPromjena" onchange="promjenaPromjene()"></select></td>
                    </tr>
                    <tr>
                        <td>Naziv:</td>
                        <td><input type="text" id="nazivPromjena"></td>
                    </tr>
                    <tr>
                        <td>Opis:</td>
                        <td><input type="text" id="opisPromjena"></td>
                    </tr>
                    <tr>
                        <td>Slika:</td>
                        <td><input type="text" id="slikaPromjena"></td>
                    </tr>
                    <tr>
                        <td>Url:</td>
                        <td><input type="text" id="urlPromjena"></td>
                    </tr>
                    <tr>
                        <td>Cijena:</td>
                        <td><input type="text" id="cijenaPromjena"></td>
                    </tr>
                    <tr>
                        <td>Dostupan:</td>
                        <td><input type="checkbox" id="dostupnostPromjena"></td>
                    </tr>
                </table>

                <button id="promjeni" onclick="promjeni()">OK</button>
                <span id="errorPromjeni"></span>
            </div>
            <div id="brisanje">
                <table>
                    <tr>
                        <td>
                            Id:
                        </td>
                        <td>
                            <select id="idBrisanje"></select>
                        </td>
                    </tr>
                </table>

                <button id="obrisi" onclick="obrisi()">OK</button>
                <span id="errorObrisi"></span>
            </div>
        </div>

    </main>

    <footer id="referenceFooter">
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    </footer>
</div>

<script src="skripte/administracijaFunkcije.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>