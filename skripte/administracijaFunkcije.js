var sviID = [];
var proizvodi = [];

function osvjezi() {
    var tabela = document.getElementById("tabelaProizvoda");

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var tekst = ajax.responseText;
            studenti = JSON.parse(tekst);

            var tabelaUnutrasnjost = "<tr><th>ID</th><th>Naziv</th><th>Opis</th><th>Slika</th><th>URL</th><th>Cijena</th><th>Dostupost</th></tr>";
            var i;
            for (i=0; i<proizvodi.length; i++) {
                tabelaUnutrasnjost +=
                    "<tr> <td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["id"] +
                    "<tr> <td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Naziv"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Opis"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Slika"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Url"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Cijena"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["Dostupnost"] + "</tr>";
                sviID.push(proizvodi[i]["id"]);
            }
            tabela.innerHTML = tabelaUnutrasnjost;

            // Osvjezi niz ID-ova

            var _idBrisanje = document.getElementById("idBrisanje");
            var _idPromjena = document.getElementById("idPromjena");

            _idBrisanje.innerHTML = " ";
            _idPromjena.innerHTML = " ";

            var i;
            for (i=0; i<sviNazivi.length; i++) {
                _idBrisanje.innerHTML += "<option>" + sviID[i] + "</option>";
                _idPromjena.innerHTML += "<option>" + sviID[i] + "</option>";
            }
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16267", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ();
}
onload = osvjezi();

function promjenaAkcije() {
    var akcija = document.getElementById("akcija").value;

    if(akcija == "Dodavanje") {
        document.getElementById("dodavanje").style.display = "block";
        document.getElementById("promjena").style.display = "none";
        document.getElementById("brisanje").style.display = "none";
    }
    else if (akcija == "Promjena") {
        document.getElementById("dodavanje").style.display = "none";
        document.getElementById("promjena").style.display = "block";
        document.getElementById("brisanje").style.display = "none";
    }
    else if (akcija == "Brisanje") {
        document.getElementById("dodavanje").style.display = "none";
        document.getElementById("promjena").style.display = "none";
        document.getElementById("brisanje").style.display = "block";
    }
    else {
        alert("Neocekivano ponasanje.")
    }
}

function promjenaPromjene() {
    var _naziv = document.getElementById("nazivPromjena");
    var _opis = document.getElementById("opisPromjena");
    var _slika = document.getElementById("slikaPromjena");
    var _url = document.getElementById("urlPromjena");
    var _cijena = document.getElementById("cijenaPromjena");
    var _dostupnost = document.getElementById("dostupnostPromjena");

    var naziv = document.getElementById("nazivPromjena").options[document.getElementById("nazivPromjena").selectedIndex].text;

    var i;
    for(i=0; i<proizvodi.length; i++) {
        if ( naziv == proizvodi[i]["naziv"]) {
            _naziv.value = proizvodi[i]["naziv"];
            _opis.value = proizvodi[i]["opis"];
            _slika.value = proizvodi[i]["slika"];
            _url.value = proizvodi[i]["url"];
            _cijena.value = proizvodi[i]["cijena"];
            _dostupnost.value = proizvodi[i]["dostupnost"];
            break;
        }
    }
}

function dodaj() {
    var _naziv = document.getElementById("nazivDodavanje");
    var _opis = document.getElementById("opisDodavanje");
    var _slika = document.getElementById("slikaDodavanje");
    var _url = document.getElementById("urlDodavanje");
    var _cijena = document.getElementById("cijenaDodavanje");
    var _dostupnost = document.getElementById("dostupnostDodavanje");

    var proizvod = {
        id: 1,
        naziv: _naziv.value,
        opis: _opis.value,
        slika: _slika.value,
        url: _url.value,
        cijena: _cijena.value,
        dostupnost: (_dostupnost.value == "on")
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorDodaj").innerHTML = "Proizvod je uspjesno unesen.";
            osvjezi();
            document.getElementById("nazivPromjena").value = "";
            document.getElementById("opisPromjena").value = "";
            document.getElementById("slikaPromjena").value = "";
            document.getElementById("urlPromjena").value = "";
            document.getElementById("cijenaPromjena").value = "";
            document.getElementById("dostupnostPromjena").value = false;
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći proizvod");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16267", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=dodavanje&proizvod=" + JSON.stringify(proizvod));
}

function obrisi() {

    var proizvod = {
        naziv: document.getElementById("nazivBrisanje").options[document.getElementById("nazivBrisanje").selectedIndex].text,
        opis: "",
        slika: "",
        url: "",
        cijena: "",
        dostupnost: ""
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorObrisi").innerHTML = "Proizvod je uspjesno obrisan.";
            osvjezi();
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći proizvod");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=brisanje&brindexa=16267&proizvod=" + JSON.stringify(proizvod));
}

function promjeni() {
    var _naziv = document.getElementById("nazivPromjena").value;
    var _opis = document.getElementById("opisPromjena").value;
    var _slika = document.getElementById("slikaPromjena").value;
    var _url = parseInt(document.getElementById("urlPromjena").value);
    var _cijena = parseInt(document.getElementById("cijenaPromjena").value);
    var _dostupnost = parseInt(document.getElementById("dostupnostPromjena").value);

    var student = {
        naziv: document.getElementById("nazivPromjena").options[document.getElementById("nazivPromjena").selectedIndex].text,
        opis: _opis,
        slika: _slika,
        url: _url,
        cijena: _cijena,
        dostupnost: _dostupnost
    }

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.status == 200 && ajax.readyState == 4) {
            document.getElementById("errorPromjeni").innerHTML = "Proizvod je uspjesno promjenjen.";
            osvjezi();
            document.getElementById("nazivPromjena").value = "";
            document.getElementById("opisPromjena").value = "";
            document.getElementById("slikaPromjena").value = "";
            document.getElementById("urlPromjena").value = "";
            document.getElementById("cijenaPromjena").value = "";
            document.getElementById("dostupnostPromjena").value = false;
        }
        else if (ajax.status == 400 && ajax.readyState == 4) {
            alert("Neispravni podaci");
        }
        else if (ajax.status == 404 && ajax.readyState == 4) {
            alert("Nepostojeći proizvod");
        }
    }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16267", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=promjena&proizvod=" + JSON.stringify(proizvod));
}