/*
$(document).ready(function() {
    $("#proizvodi").click(function () {
        if ($("#pomocniDiv").width() == 0) {
            $("#pomocniDiv").animate({'width': 90}, "slow");
            document.getElementById("proizvodi").style.backgroundColor = "#0193B7";
            document.getElementById("pomocniDivDva").style.display = "block";
        }
        else {
            $("#pomocniDiv").animate({'width': 0}, "slow");
            document.getElementById("proizvodi").style.backgroundColor = "transparent";
            document.getElementById("pomocniDivDva").style.display = "none";
        }
        $("#podmeni").slideToggle("slow");
    });
    //Postavi poziciju podmenija
    var podmeni = document.getElementById("podmeni");
    var sakriveniDiv = document.getElementById("pomocniDiv");
    var sakriveniDivDva = document.getElementById("pomocniDivDva");
    var proizvodi = document.getElementById("proizvodi");
    var pozicijaProizvodi = proizvodi.getBoundingClientRect();
    sakriveniDiv.style.left = pozicijaProizvodi.left + 95 + "px";
    sakriveniDiv.style.top = pozicijaProizvodi.top + "px";
    sakriveniDivDva.style.left = pozicijaProizvodi.left + "px";
    sakriveniDivDva.style.top = pozicijaProizvodi.top + 35 + "px";
    podmeni.style.left = (pozicijaProizvodi.left - 25) + "px";
    podmeni.style.top = pozicijaProizvodi.top + 40 + "px";
});
*/
function proizvodi_Click() {
    var pomeni = document.getElementById("podmeni");
    if (podmeni.style.display == "block") pomeni.style.display = "none";
    else podmeni.style.display = "block";

    //Postavi poziciju menija
    //var sakriveniDiv = document.getElementById("pomocniDiv");
    //var sakriveniDivDva = document.getElementById("pomocniDivDva");
    var proizvodi = document.getElementById("proizvodi");
    var pozicijaProizvodi = proizvodi.getBoundingClientRect();
    //sakriveniDiv.style.left = pozicijaProizvodi.left + 95 + "px";
    //sakriveniDiv.style.top = pozicijaProizvodi.top + "px";
    //sakriveniDivDva.style.left = pozicijaProizvodi.left + "px";
    //sakriveniDivDva.style.top = pozicijaProizvodi.top + 35 + "px";
    podmeni.style.left = (pozicijaProizvodi.left - 25) + "px";
    podmeni.style.top = pozicijaProizvodi.top + 40 + "px";
}