<?php
    $veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
    $veza -> exec("set names utf8");

    $novosti = $veza -> query("SELECT idNovosti, naslov, tekst, detaljnijiTekst, UNIX_TIMESTAMP(datumObjave) datum, autor, slika,
                                (
                                    SELECT count(*)
                                    FROM komentari as k
                                    WHERE k.idNovosti = n.idNovosti
                                ) as brojKomentara
                                FROM novosti n
                                ORDER BY datumObjave asc");

    if (!$novosti) {
        $greska = $veza->errorInfo();
        echo "SQL greška: " . $greska[2];
        exit();
    }

    $novostiNiz = $novosti->fetchAll();
    $brojac = 0;
    foreach ($novostiNiz as $vijest) :
?>
    <div class="novost">
        <div class="<?php if(true == is_null($vijest['slika'])) echo 'novostiTekstBezSlike'; else echo 'novostiTekst'; ?>">
            <p class="maliParagraf"><?=htmlentities(date("d.m.Y. (h:i)", $vijest['datum']))?><br>
            Autor: <?=htmlentities($vijest['autor'])?></p>
            <a class="vise" style="cursor: pointer; visibility: <?php if(!is_null($vijest['detaljnijiTekst'])) print "visible"; else print "hidden"; ?>" onclick="otvoriUrlAsinhrono('NovostDetalji.php?naslov=<?=urlencode(ucfirst(strtolower($vijest['naslov'])))?>&tekst=<?=urlencode($vijest['detaljnijiTekst'])?>&opis=<?=urlencode($vijest['tekst'])?>&datum=<?=urlencode(date("d.m.Y. (h:i)", $vijest['datum']))?>&autor=<?=urlencode($vijest['autor'])?>&slika=<?=urlencode($vijest['slika'])?>')">Detaljnije</a>
            <h3><?=ucfirst(strtolower(htmlentities($vijest['naslov'])))?></h3>
            <p><?=$vijest['tekst']?></p>
        </div>
        <?php if(false == is_null($vijest['slika'])) : ?>
        <img src="<?=htmlentities($vijest['slika'])?>" alt="Slika za novost kompanije Milenijum-Soft">
        <?php endif; ?>
        <form method="post" action="index.php?akcija=ostaviKomentar" onsubmit="return OstaviKomentar(<?=$brojac?>);">
            <div class="komentarWraper">
                <span>Ostavite komentar:</span><br><br>
                <input id="komentarAutor<?=$brojac?>" name="komentarAutor" class="inputKomentar" type="text" placeholder="Ovdje unesite ime autora *"><br><br>
                <input id="komentarMail<?=$brojac?>" name="komentarMail" class="inputKomentar" type="text" placeholder="Ovdje unesite mail"><br><br>
                <textarea id="komentarTekst<?=$brojac?>" name="komentarTekst" placeholder="Ovdje unesite komentar *"></textarea> <br><br>
                <input class="ostaviKomentar" type="submit" value="Ostavi komentar">
                <input type="hidden" name="idNovosti" value="<?=$vijest['idNovosti']?>"<br><br>
                Ova vijest ima <?=$vijest['brojKomentara']?> komentara<br><a href="otvoriKomentareZaNovost.php?id=<?=$vijest['idNovosti']?>">Pogledajte ih</a>
            </div>
        </form>
        <div class="zlato"></div>
    </div>
<?php
    $brojac++;
    endforeach;
?>