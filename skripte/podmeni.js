function proizvodiEnter() {
    document.getElementById("proizvodiPodmeni").style.display = "block";
}

function proizvodiLeave() {
    document.getElementById("proizvodiPodmeni").style.display = "none";
}

onload = function() {
    var pozicija = document.getElementById("proizvodi").getBoundingClientRect();
    document.getElementById("proizvodiPodmeni").style.left = pozicija.left - 25 + "px";
}