var sveValidno = true;

$(document).ready(function(){
    $("#posalji").click(function(){
        sveValidno = true;

        validirajIme();
        validirajMail();
        validirajPoruku();

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
    }
    else if (!mail.value.match(/^[a-z0-9_]+@[a-z]+\.[a-z][a-z]+$/)) {
        mail.style.backgroundColor="red";
        document.getElementById("errorMail").style.display="block";
        document.getElementById("errorMail").innerHTML="Mail mora biti u tacnom formatu.";
        sveValidno = false;
    }
    else {
        mail.style.backgroundColor="lightgreen";
        document.getElementById("errorMail").style.display="none";
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