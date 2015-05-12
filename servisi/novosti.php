<?php
/*
$d = new DateTime("05.06.2015. 12:10:20.\r\n");
$d1 = new DateTime("05.06.2015. 12:10:21.\r\n");
$dsad = new DateTime();
$dsad->setTimezone(new DateTimeZone("Europe/Sarajevo"));
if ($d < $d1) echo "Tacno"; else echo "Baha";
*/
// Ide servisi/novosti, zato sto se kod parsira u index.php, a u odnosu na njega relativno je ovako

$fajlovi = scandir("servisi/novosti");
 // Zato sto su na Windowsu uvijek prva dva fajla . i .. Nije najbolje rijesenje jer nece raditi na linux-u. Pretpostavljam da ce ovo zavisiti od toga koji je OS na serveru koji mi daje hosting
 //TODO: Dodati i za linux
$sortiraneNovosti = array();
$sortiraniDatumi = array();

//Popunjavanje
for ($i=2; $i<count($fajlovi); $i++) {
    $trenutniFajl = file("servisi/novosti/".$fajlovi[$i]);
    array_push($sortiraneNovosti, $fajlovi[$i]);
    array_push($sortiraniDatumi, $trenutniFajl[0]);
}

//Sortiranje
$biloIzmjena = true;
while($biloIzmjena == true) {
    $biloIzmjena = false;
    for ($i=0; $i<count($sortiraneNovosti) - 1; $i++) {
        if (new DateTime($sortiraniDatumi[$i]) < new DateTime($sortiraniDatumi[$i+1])) {
            $temp = $sortiraniDatumi[$i+1];
            $sortiraniDatumi[$i+1] = $sortiraniDatumi[$i];
            $sortiraniDatumi[$i] = $temp;
            $temp = $sortiraneNovosti[$i+1];
            $sortiraneNovosti[$i+1] = $sortiraneNovosti[$i];
            $sortiraneNovosti[$i] = $temp;
            $biloIzmjena = true;
        }
    }
}

for ($i=0; $i<count($sortiraneNovosti); $i++):
    $sadrzajFajla = file("servisi/novosti/".$sortiraneNovosti[$i]);



    $opis = "";
    $detaljnije = "";
    $imaDetaljnije = false;

    for ($j=4; $j<count($sadrzajFajla);$j++) {
        echo "Sadrzaj reda: " ; $sadrzajFajla[$j]."<br>";
        if($sadrzajFajla[$j] == "--\r\n" || (strpos($sadrzajFajla[$j], "--") && strlen($sadrzajFajla[$j]) == 3)) {
            $imaDetaljnije = true;
            continue;
        }
        if ($imaDetaljnije == false) {
            $opis .= " ".$sadrzajFajla[$j];
        }
        else {
            $detaljnije .= " ".$sadrzajFajla[$j];
        }
    }
?>
<div class="novost">
    <div class="<?php if($sadrzajFajla[3] == "\r\n") echo "novostiTekstBezSlike"; else echo "novostiTekst"; ?>">
        <p class="maliParagraf"><?=$sadrzajFajla[0]?><br>
        Autor: <?=$sadrzajFajla[1]?></p>
        <a class="vise" style="cursor: pointer; visibility: <?php if($imaDetaljnije == true) print "visible"; else print "hidden"; ?>" onclick="otvoriUrlAsinhrono('NovostDetalji.php?naslov=<?=urlencode(ucfirst(strtolower($sadrzajFajla[2])))?>&tekst=<?=urlencode($detaljnije)?>&opis=<?=urlencode($opis)?>&datum=<?=urlencode($sadrzajFajla[0])?>&autor=<?=urlencode($sadrzajFajla[1])?>&slika=<?=urlencode($sadrzajFajla[3])?>')">Detaljnije</a>
        <h3><?=ucfirst(strtolower($sadrzajFajla[2]))?></h3>
        <p><?=$opis?></p>
    </div>
    <?php if($sadrzajFajla[3] != "\r\n"): ?>
    <img src="<?=$sadrzajFajla[3]?>" alt="Slika za novost kompanije Milenijum-Soft">
    <?php endif; ?>
    <div class="zlato"></div>
</div>

<?php endfor; ?>