<?php
	date_default_timezone_set('America/New_York');

	$oEnchere = new Enchere($_POST['item_number']);
	$oEnchere->getPrixDirecte();

	$receiver_id = "E7NW5SXHXN9JS";

	$sJournal = date('Y-M-d H:i:s')."\r\n\n";

	foreach ($_POST as $key => $value) {
		$sJournal .= "[clé]: ".$key.", [valeur]: ".$value."\r\n";
	}

	$rFichier = fopen('ipn-logs/ipn-'.date('Y-m-d-H\hi\ms\s').'.txt', 'a+');
	fwrite($rFichier, $sJournal);
	fclose($rFichier);

 ?>