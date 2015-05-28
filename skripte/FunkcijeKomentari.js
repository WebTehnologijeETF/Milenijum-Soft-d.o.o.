// OVO SE POLA NE KORISTI; JER JE OVO TZAB WEB SERVIS - Mislio sam ovako raditi, ali sam se predomislio

var sveTacno = true;
var tekstAlert = "";
//var error = document.getElementById("komentarError");

function OstaviKomentar(redniBroj) {
	//var autor = document.getElementById("komentarAutor").value;
	//var tekst = document.getElementById("komentarTekst").value;
	//var mail = document.getElementById("komentarMail").value;

	sveTacno = true;
	tekstAlert = "";

	validirajAutora(redniBroj);
	validirajTekst(redniBroj);
	validirajMail(redniBroj);

	if (tekstAlert != "")
		alert(tekstAlert);

	/*
	if (true == sveTacno) {
		var ajax = new XMLHttpRequest();

	    ajax.onreadystatechange = function() {
	    	alert(ajax.readyState + "   " + ajax.status);
	        if(ajax.readyState == 4 && ajax.status == 200) {
	            var tekst = ajax.responseText;
	            var rezultat = JSON.parse(tekst);

	            if (rezultat['status'] == 'ok') {
	            	alert("Hvala vam na ostavljanju komentara.");
	            	error.innerHTML = "";
	            }
	            else {
	            	error.innerHTML = rezultat['poruka'];
	            }
	        }
	    }
	    ajax.open("post", "servisi/KomentarDao.php", true);
	    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	    ajax.send ("akcija=komentarCreate&autor=" + autor + "&tekst=" + tekst + "&mail=" + mail + "&idNovosti=" + idNovosti);
	}
	*/

	return sveTacno;
}

function validirajAutora(redniBroj) {
	var autor = document.getElementById("komentarAutor" + redniBroj).value;

	if (autor.trim().length == 0) {
		tekstAlert += "Polje autor ne smije ostati prazno!\n";
		sveTacno = false;
	}
}

function validirajTekst(redniBroj) {
	var tekst = document.getElementById("komentarTekst" + redniBroj).value;

	if (tekst.trim().length == 0) {
		tekstAlert += "Polje tekst komentara ne smije ostati prazno!\n";
		sveTacno = false;
	}
}

function validirajMail(redniBroj) {
    var mail = document.getElementById("komentarMail" + redniBroj).value;

	if (!mail.match(/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/) && mail.length != 0) {
        tekstAlert += "Polje mail nije u prihvatljivom formatu!\n";
		sveTacno = false;
    }
}