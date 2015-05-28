<?php // Ovo je za WEB SERVIS, mislio sam prvo ovako raditi, ali sam se predomislio :D

$rezultat = array("status" => "greska", "poruka" => "Neobrađeni tip greske");

if(!isset($_REQUEST['akcija']))
	$rezultat["poruka"] = "Akcija nije postavljena!";
else if ($_REQUEST['akcija'] != "komentarCreate")
	$rezultat["poruka"] = "Akcija koju ste odabrali ne postoji!";
else if ($_REQUEST['akcija'] == "komentarCreate") {
	if (!isset($_REQUEST['autor']) || !isset($_REQUEST['tekst']) || !isset($_REQUEST['mail']) || !isset($_REQUEST['idNovosti'])) {
		$rezultat["poruka"] =  "Niste poslali sve parametre za akciju komentarCreate!";
	}
	else if (strlen(trim($_REQUEST['autor'])) == 0) {
		$rezultat["poruka"] =  "Polje autor ne smije ostati prazno!";
	}
	else if (strlen(trim($_REQUEST['tekst'])) == 0) {
		$rezultat["poruka"] = "Polje tekst komentara ne smije ostati prazno!";
	}
	else if (false == preg_match('/^[a-z0-9_]+@[a-z.]+\.[a-z][a-z]+$/', $_REQUEST['mail']) && strlen($_REQUEST['mail']) != 0) {
		$rezultat["poruka"] = "Polje mail nije u prihvatljivom formatu!";
	}
	else {
		$idNovosti = htmlentities($_REQUEST['idNovosti']);
		$tekst = htmlentities($_REQUEST['tekst']);
		$autor = htmlentities($_REQUEST['autor']);
		$mail = htmlentities($_REQUEST['mail']);

		$veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
		$veza -> exec("set names utf8");

		$rez = $veza->prepare("INSERT INTO komentari SET idNovosti=?, tekst=?, autor=?, mail=?, vrijemeObjave=NOW()");
		$rez->execute(array($idNovosti, $tekst, $autor, $mail));

		if (!$rez) {
        	$greska = $veza->errorInfo();
          	$rezulzat["poruka"] = "SQL greška: " . $greska[2];
     	}
     	else {
     		print_r($rez);
			$rezultat["status"] = "ok";
			$rezultat["poruka"] = "Komentar je uspjesno dodan.";
			//echo $rez->get_result();
		}
	}
}

echo json_encode($rezultat);

?>