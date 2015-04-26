var sviID = [];
var proizvodi = [];

function osvjezi() {
    var tabela = document.getElementById("tabelaProizvoda");

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var tekst = ajax.responseText;
            proizvodi = JSON.parse(tekst);

            sviID = [];
            var tabelaUnutrasnjost = "<tr><th>Id</th><th>Naziv</th><th>Opis</th><th>Slika</th><th>URL</th><th>Cijena</th><th>Dostupost</th></tr>";
            var i;
            for (i=0; i<proizvodi.length; i++) {
                var dostupan = proizvodi[i]["dostupnost"] == 1 ? "Da" : "Ne";
                tabelaUnutrasnjost +=
                    "<tr> <td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["id"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["naziv"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'><div style='max-width: 100px; max-height: 200px; overflow: hidden;'>" + proizvodi[i]["opis"] + "</div>" +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'><img width=200 src='" + proizvodi[i]["slika"] + "'>" +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'><a target='_blank' href='" + proizvodi[i]["url"] + "'>Link</a>" +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + proizvodi[i]["cijena"] +
                    "</td><td style='border: 1px solid black; border-radius: 5px; padding: 5px'>" + dostupan + "</tr>";
                sviID.push(proizvodi[i]["id"]);
            }
            tabela.innerHTML = tabelaUnutrasnjost;

            // Osvjezi niz ID-ova

            var _idBrisanje = document.getElementById("idBrisanje");
            var _idPromjena = document.getElementById("idPromjena");

            for(i=_idBrisanje.options.length-1;i>=0;i--)
            {
                _idBrisanje.remove(i);
                _idPromjena.remove(i);
            }

            for (i=0; i<sviID.length; i++) {
                var opcija1 = document.createElement("option");
                opcija1.text = sviID[i].toString();
                _idBrisanje.add(opcija1);
                var opcija2 = document.createElement("option");
                opcija2.text = sviID[i].toString();
                _idPromjena.add(opcija2);
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

    var _id = document.getElementById("idPromjena").options[document.getElementById("idPromjena").selectedIndex].text;

    var i;
    for(i=0; i<proizvodi.length; i++) {
        if ( _id == proizvodi[i]["id"]) {
            _naziv.value = proizvodi[i]["naziv"];
            _opis.value = proizvodi[i]["opis"];
            _slika.value = proizvodi[i]["slika"];
            _url.value = proizvodi[i]["url"];
            _cijena.value = proizvodi[i]["cijena"];
            _dostupnost.checked = (proizvodi[i]["dostupnost"] == 1);
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

    if (parseFloat(_cijena.value) < 0) {
        document.getElementById("errorDodaj").innerHTML = "Cijena ne smije biti manja od nule.";
        return;
    }

    var proizvod = {
        naziv: _naziv.value,
        opis: _opis.value,
        slika: _slika.value,
        url: _url.value,
        cijena: _cijena.value,
        dostupnost: _dostupnost.checked
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
            document.getElementById("dostupnostPromjena").checked = false;
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
        id: parseInt(document.getElementById("idBrisanje").options[document.getElementById("idBrisanje").selectedIndex].text),
        naziv: "",
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
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16267", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send ("akcija=brisanje&proizvod=" + JSON.stringify(proizvod));
}

function promjeni() {
    var _naziv = document.getElementById("nazivPromjena").value;
    var _opis = document.getElementById("opisPromjena").value;
    var _slika = document.getElementById("slikaPromjena").value;
    var _url = document.getElementById("urlPromjena").value;
    var _cijena = parseFloat(document.getElementById("cijenaPromjena").value);
    var _dostupnost = (document.getElementById("dostupnostPromjena").checked ? 1 : 0);

    if (parseFloat(_cijena.value) < 0) {
        document.getElementById("errorDodaj").innerHTML = "Cijena ne smije biti manja od nule.";
        return;
    }

    var proizvod = {
        id: parseInt(document.getElementById("idPromjena").options[document.getElementById("idPromjena").selectedIndex].text),
        naziv: _naziv,
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
            document.getElementById("dostupnostPromjena").checked = false;
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