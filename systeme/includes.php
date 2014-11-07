<?php
/**
 * Inclus un fichier donc le nom est passé en paramètre
 * @param  String $sNomClasse Nom de la classe a inclure
 */
function chargeFichier($sNomClasse) {

	// Liste des repertoires
	$aRepertoires = array('../systeme/','../controleurs/','../modeles/','../vues/', '../libs/');

	foreach ( $aRepertoires AS $sRepertoire ) {

		// Si le fichier existe
		if( file_exists($sRepertoire.$sNomClasse.".class.php") ){

			require_once $sRepertoire.$sNomClasse.".class.php";

		}

	}

}

// Enregistre une fonction dans la pile __autoload() fournie. Si la pile n'est pas encore active, elle est activée.
spl_autoload_register('chargeFichier');

 ?>