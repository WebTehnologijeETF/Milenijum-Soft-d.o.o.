function otvoriUrlAsinhrono(url) {
    var ajax = new XMLHttpRequest;

    ajax.onreadystatechange = function() {
        if(ajax.status == 200 && ajax.readyState == 4) {
            document.write(ajax.responseText);
        }
    }

    ajax.open("GET", url, true);
    ajax.send();
}