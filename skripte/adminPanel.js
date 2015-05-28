onload = function() {
	if(typeof(Storage) !== "undefined") {
        if (typeof(localStorage.getItem("tipAkcije"))!='undefined' && typeof(localStorage.getItem("akcija"))!='undefined') {
            document.getElementById("tipAkcije").selectedIndex = sessionStorage.tipAkcije;
            promjenaTipAkcije(sessionStorage.akcija);
        } else {
            sessionStorage.akcija = 0;
            sessionStorage.tipAkcije = 0;
            document.getElementById("akcija").selectedIndex = 0;
            document.getElementById("tipAkcije").selectedIndex = 0;
        }
        
    } else {
        alert("Vaš browser ne podržava web storage, te aplikacija neće korektno funkcionisati. Molimo izvršite update.");
    }
}

function promjenaTipAkcije(onLoadPoziv) {
	if (typeof onLoadPoziv === 'undefined') { onLoadPoziv = 0; }

	var cbbAkcija = document.getElementById("akcija");

	sessionStorage.tipAkcije = document.getElementById("tipAkcije").selectedIndex;
	if (sessionStorage.tipAkcije == 0) {
		for(i=cbbAkcija.options.length-1;i>=0;i--)
                cbbAkcija.remove(i);

        var opcijaDodaj = document.createElement("option");
        opcijaDodaj.text = "Dodaj";
        cbbAkcija.add(opcijaDodaj);
        var opcijaModifikuj = document.createElement("option");
        opcijaModifikuj.text = "Modifikuj";
        cbbAkcija.add(opcijaModifikuj);
        var opcijaObrisi = document.createElement("option");
        opcijaObrisi.text = "Obrisi";
        cbbAkcija.add(opcijaObrisi);
	}
	else if (sessionStorage.tipAkcije == 1) {
		for(i=cbbAkcija.options.length-1;i>=0;i--)
                cbbAkcija.remove(i);

        var opcijaObrisi = document.createElement("option");
        opcijaObrisi.text = "Obrisi";
        cbbAkcija.add(opcijaObrisi);
	}
	else if (sessionStorage.tipAkcije == 2) {
		for(i=cbbAkcija.options.length-1;i>=0;i--)
                cbbAkcija.remove(i);

        var opcijaDodaj = document.createElement("option");
        opcijaDodaj.text = "Dodaj";
        cbbAkcija.add(opcijaDodaj);
        var opcijaObrisi = document.createElement("option");
        opcijaObrisi.text = "Obrisi";
        cbbAkcija.add(opcijaObrisi);
	}

    cbbAkcija.selectedIndex = onLoadPoziv;

	sessionStorage.akcija = onLoadPoziv;

	pomocnaSakrijSvePrikaze();

	if (sessionStorage.tipAkcije == 0)		
		document.getElementById("prikazNovosti").style.display = "block";
	else if (sessionStorage.tipAkcije == 1)
		document.getElementById("prikazKomentari").style.display = "block";
	else if (sessionStorage.tipAkcije == 2)
		document.getElementById("prikazAdministratori").style.display = "block";

	promjenaAkcije();
}

function promjenaAkcije() {
	sessionStorage.akcija = document.getElementById("akcija").selectedIndex;

	pomocnaSakrijSveAkcije();

	if (sessionStorage.tipAkcije == 0) {
		if (sessionStorage.akcija == 0) 
			document.getElementById("dodavanjeNovosti").style.display = "block";
		else if (sessionStorage.akcija == 1)
			document.getElementById("modifikacijaNovosti").style.display = "block";
		else if (sessionStorage.akcija == 2)
			document.getElementById("brisanjeNovosti").style.display = "block";
	}
	else if (sessionStorage.tipAkcije == 1)
		document.getElementById("brisanjeKomentara").style.display = "block";
	else if (sessionStorage.tipAkcije == 2) {
		if (sessionStorage.akcija == 0) 
			document.getElementById("dodavanjeAdministratora").style.display = "block";
		else if (sessionStorage.akcija == 1)
			document.getElementById("brisanjeAdministratora").style.display = "block";
	}
}

function pomocnaSakrijSvePrikaze () {
	document.getElementById("prikazNovosti").style.display = "none";
	document.getElementById("prikazKomentari").style.display = "none";
	document.getElementById("prikazAdministratori").style.display = "none";
}

function pomocnaSakrijSveAkcije () {
	document.getElementById("dodavanjeNovosti").style.display = "none";
	document.getElementById("modifikacijaNovosti").style.display = "none";
	document.getElementById("brisanjeNovosti").style.display = "none";
	document.getElementById("brisanjeKomentara").style.display = "none";
	document.getElementById("dodavanjeAdministratora").style.display = "none";
	document.getElementById("brisanjeAdministratora").style.display = "none";
}