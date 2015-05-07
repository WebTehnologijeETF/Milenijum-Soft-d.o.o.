var sveValidno = true;
var ispravanMail = true;

$(document).ready(function(){
    $("#posalji").click(function(){
        sveValidno = true;

        validirajIme();
        ispravanMail = true;
        validirajMail();
        validirajPonovniMail();
        validirajPoruku();
        validirajOpcinu();
        validirajSrednjuSkolu();

        var posalji = document.getElementById("posalji");

        if (true == sveValidno) {
            posalji.type = "submit";
        }
    });

    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var citac = new FileReader();
                citac.onload = ucitanaSlika;
                citac.readAsDataURL(this.files[0]);
            }
        });
    });

    function ucitanaSlika(e) {
        $('#kontakt_slikaKorisnika').attr('src', e.target.result);
    }
});

function validirajIme() {
    var ime = document.getElementById("ime");

    // Validavija imena (ovo je validacija regexom)
    if (ime.value.length == 0 ) {
        ime.style.backgroundColor="red";
        document.getElementById("errorIme").style.display="block";
        document.getElementById("errorIme").innerHTML="Ime ne smije ostati prazno.";
        sveValidno = false;
    }
    else if (!ime.value.match(/^[a-zA-Z ČčĆćŽžŠšĐđ]+$/)) {
        ime.style.backgroundColor="red";
        document.getElementById("errorIme").style.display="block";
        document.getElementById("errorIme").innerHTML="Ime mora sadrzavati samo slova.";
        sveValidno = false;
    }
    else {
        ime.style.backgroundColor="lightgreen";
        document.getElementById("errorIme").style.display="none";
    }
}

function validirajMail() {
    var mail = document.getElementById("mail");

    // Validacija maila
    if (mail.value.length == 0 ) {
        mail.style.backgroundColor="red";
        document.getElementById("errorMail").style.display="block";
        document.getElementById("errorMail").innerHTML="Mail ne smije ostati prazan.";
        sveValidno = false;
        ispravanMail = false;
    }
    else if (!mail.value.match(/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/)) {
        mail.style.backgroundColor="red";
        document.getElementById("errorMail").style.display="block";
        document.getElementById("errorMail").innerHTML="Mail mora biti u tacnom formatu.";
        sveValidno = false;
        ispravanMail = false;
    }
    else {
        mail.style.backgroundColor="lightgreen";
        document.getElementById("errorMail").style.display="none";
    }
}

// Cross validacija
function validirajPonovniMail() {
    var ponovniMail = document.getElementById("ponovniMail");
    var mail = document.getElementById("mail");

    // Validacija ponovnig maila
    if (mail.value != ponovniMail.value) {
        ponovniMail.style.backgroundColor="red";
        document.getElementById("errorPonovniMail").style.display="block";
        document.getElementById("errorPonovniMail").innerHTML="Mail i ponovni mail nisu isti.";
        sveValidno = false;
    }
    else if(ispravanMail == false) {
        ponovniMail.style.backgroundColor="red";
        document.getElementById("errorPonovniMail").style.display="block";
        document.getElementById("errorPonovniMail").innerHTML="Mail nije dobro unesen.";
        sveValidno = false;
    }
    else {
        ponovniMail.style.backgroundColor="lightgreen";
        document.getElementById("errorPonovniMail").style.display="none";
    }
}

function validirajPoruku() {
    var poruka = document.getElementById("poruka");

    // Validacija poruke (ovo je jedna validacija bez regexa)
    if (poruka.value.length == 0) {
        poruka.style.backgroundColor="red";
        document.getElementById("errorPoruka").style.display="block";
        sveValidno = false;
    }
    else {
        poruka.style.backgroundColor="lightgreen";
        document.getElementById("errorPoruka").style.display="none";
    }
}

function validirajOpcinu() {
    var opcina = document.getElementById("opcina");

    if (opcina.value.length != 0 && !opcina.value.match(/^[a-zA-Z ČčĆćŽžŠšĐđ]+$/)) {
        opcina.style.backgroundColor="red";
        document.getElementById("errorOpcina").style.display="block";
        document.getElementById("errorOpcina").innerHTML="Općina mora biti samo slova.";
        sveValidno = false;
    }
    else {
        opcina.style.backgroundColor="lightgreen";
        document.getElementById("errorOpcina").style.display="none";
    }
}

function validirajSrednjuSkolu() {
    var srednjaSkola = document.getElementById("srednjaSkola");
    var opcina = document.getElementById("opcina");

    var ajax = new XMLHttpRequest;

    ajax.onreadystatechange = function() {
        if(ajax.status == 200 && ajax.readyState == 4) {
            var odgovor = JSON.parse(ajax.responseText);

            var tacnaSrednjaSkola = false;
            if (Object.keys(odgovor)[0] == "ok")
                tacnaSrednjaSkola = true;

            if (false == tacnaSrednjaSkola && opcina.value.length > 0 && srednjaSkola.value.length > 0) {
                srednjaSkola.style.backgroundColor="red";
                document.getElementById("errorSrednjaSkola").style.display="block";
                document.getElementById("errorSrednjaSkola").innerHTML=odgovor.greska;
                sveValidno = false;
            }
            else {
                srednjaSkola.style.backgroundColor="lightgreen";
                document.getElementById("errorSrednjaSkola").style.display="none";
            }
        }
    }

    ajax.open("GET", "http://zamger.etf.unsa.ba/wt/srednja_skola.php?opcina=" + opcina.value + "&skola=" + srednjaSkola.value, true);
    ajax.send();

    if (srednjaSkola.value.length != 0 && !srednjaSkola.value.match(/^[a-zA-Z ČčĆćŽžŠšĐđ]+$/)) {
        srednjaSkola.style.backgroundColor="red";
        document.getElementById("errorSrednjaSkola").style.display="block";
        document.getElementById("errorSrednjaSkola").innerHTML="Škola mora biti samo slova.";
        sveValidno = false;
    }
    else {
        srednjaSkola.style.backgroundColor="yellow";
        document.getElementById("errorSrednjaSkola").style.display="none";
    }
}