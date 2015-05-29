<!DOCTYPE html>
<html>
<head lang="ba">
    <meta charset="UTF-8">
    <title>Milenijum-Soft d.o.o. | Komentari</title>
    <link href="ostalo/stil.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="slike/favicon.png">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!-- <script src="skripte/jquery-2.1.3.js"></script> -->
</head>
<body>
	<div id="forma">
		<?php include("dijelovi/header.php"); ?>
		<main id="o-nama-main">			
			<h2 class="podnaslov">Odabrana novost</h2>
			<?php
				$veza = new PDO("mysql:dbname=milenijumsoft;host=127.13.49.130;charset=utf8", "Faruk", "tajna");
				$veza -> exec("set names utf8");

				$idVijesti = $_GET['id'];
				$komentari = $veza -> prepare("SELECT tekst, UNIX_TIMESTAMP(vrijemeObjave) vrijeme2, autor, mail
											FROM komentari
											WHERE idNovosti=?
											ORDER BY vrijemeObjave desc");
				$komentari->bindValue(1, $idVijesti, PDO::PARAM_INT);
				$komentari->execute();

				if (!$komentari) {
		        	$greska = $veza->errorInfo();
		          	echo "SQL greška: " . $greska[2];
		          	exit();
		     	}

				$komentariNiz = $komentari->fetchAll();

				$brojac = 1;
		     	foreach ($komentariNiz as $komentar) {
		     		$mailTekst = "";
		     		if (!$komentar['mail'] == "") {
		     			$mailTekst = "<form action='mailto:".$komentar['mail']."'>Mail: ".$komentar['mail']."<br><input type='submit' value='Posalji mail'></form>";
		     		}
		        	echo "<h2 class='podnaslov'>".$brojac.". Komentar</h1>Autor: <small>".$komentar['autor']."</small><br>Tekst komentara:<p>".$komentar['tekst']."</p>Datum objavljivanja: <small>".date("d.m.Y. (h:i)", $komentar['vrijeme2'])."</small><br>".$mailTekst;
		        	$brojac++;
		     	}
			?>
		<main>
		<footer>
        &copy; 2015 Milenijum-Soft d.o.o. Sarajevo
    	</footer>
	</div>
<script src="skripte/podmeni.js"></script>
<script src="skripte/otvoriUrlAsinhrono.js"></script>
</body>
</html>