function otvoriUrlAsinhrono(url) {
    var ajax = new XMLHttpRequest;

    ajax.onreadystatechange = function() {
        if(ajax.status == 200 && ajax.readyState == 4) {
            document.open();
            document.write(ajax.responseText);
            document.close();
        }
    }

    ajax.open("GET", url, true);
    ajax.send();
}