<?php $idNovosti = htmlentities($_REQUEST['idNovosti']);
		$tekst = htmlentities($_REQUEST['komentarTekst']);
		$autor = htmlentities($_REQUEST['komentarAutor']);
		$mail = htmlentities($_REQUEST['komentarMail']);

		$veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
		$veza -> exec("set names utf8");

		$rez = $veza->prepare("INSERT INTO komentari SET idNovosti=?, tekst=?, autor=?, mail=?, vrijemeObjave=NOW()");
		$rez->execute(array($idNovosti, $tekst, $autor, $mail));

		if (!$rez) {
        	$greska = $veza->errorInfo();
          	echo "SQL greška: " . $greska[2];
     	}
     	else {
     		header("Location: index.php");
     		exit();
		}
?>