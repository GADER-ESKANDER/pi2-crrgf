<?php
/**
 * Fichier.class.php
 * Classe Fichier 
 * Liste des Méthodes :
 *		public static function filtrer($sIn)
 * 		public static function telecharger($sNameInputFile, $sDirUpload, $aTypeMime)
 *		public static function lireDossier($sNomDossier, &$aDossiers)
 * @author Caroline Martin cmartin@cmaisonneuve.qc.ca
 * @version 2012-03-23
 */

require_once("TypeException.class.php");
class Fichier{
	
	const ERR_FILE_UPLOAD_SUCCES="Le fichier a &eacute;t&eacute; t&eacute;l&eacute;charg&eacute; avec succ&egrave;s sur le serveur.";
	const ERR_FILE_UPLOAD_COPY="ERREUR dans la copie, Le fichier n&rsquo;a pas &eacute;t&eacute; t&eacute;l&eacute;charg&eacute;.";	
	const ERR_FILE_UPLOAD ="Le type MIME du fichier à charger ne correspond pas à : ";
	const ERR_FILE_SELECT ="Le fichier n'a pas &eacute;t&eacute; s&eacute;lectionn&eacute;.";
	const ERR_VALIDATE_EXISTE = "Le paramètre doit être une valeur existante dans le tableau.";
	/**	
	 * Permet de filtrer une chaine de caractères en supprimant tous les caractères spéciaux d'une chaîne
	 * @param string $sIn la chaine de caractères pour laquelle tous les caractères spéciaux doivent être supprimés  
	 * @return string la chaîne sans les caractères spéciaux
	 */	
	public static function filtrer($sIn) {
		$aSearch = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_\.]@');
		$aReplace = array ('e','a','i','u','o','c','_','');
		return preg_replace($aSearch, $aReplace, $sIn);
	}
	/**	
	 * Permet de télécharger un fichier 
	 * Pour une liste des types MIME valides : http://en.wikipedia.org/wiki/Internet_media_type
	 * @param string $sNameInputFile la valeur de l'attribut 'name' de la balise input de type 'File'
	 * @param string $sDirUpload le répertoire dans lequel le fichier téléchargé doit être copier
	 * @param array $aTypeMime contenant la liste des types Mime 
	 * @return integer : 
	 * 					ERR_IMAGE_UPLOAD_SUCCES si le téléchargement s'est bien déroulé
	 *               	ERR_IMAGE_UPLOAD si le fichier ne fait pas partie de la liste des types mime.
	 * 					ERR_IMAGE_UPLOAD_COPY si le fichier n'a pu être copié 
	 */	
	public static function telecharger($sNameInputFile, $sDirUpload, $aTypeMime){
		
		TypeException::estVide($sNameInputFile);
		TypeException::estVide($sDirUpload);
		TypeException::estString($sNameInputFile);
		TypeException::estString($sDirUpload);
		
		if(key_exists($sNameInputFile, $_FILES) == false)
			throw new Exception(get_class(). "::". Fichier::ERR_VALIDATE_EXISTE." sNameInputFile ".$sNameInputFile);
		
		TypeException::estArray($aTypeMime);
		
		$sFileUpload = Fichier::filtrer($_FILES[$sNameInputFile]['name']);
		/* $sFileUpload est maintenant constitué sans caractères indésirables */
		$sNomFicherUpload = $sDirUpload . basename($sFileUpload);
		//echo $sNomFicherUpload ;
		if  (in_array($_FILES[$sNameInputFile]['type'], $aTypeMime)==true){
			
			if (copy($_FILES[$sNameInputFile]['tmp_name'], $sNomFicherUpload) == true) 
						
				{					
					return Fichier::ERR_FILE_UPLOAD_SUCCES;
				}else{
					return Fichier::ERR_FILE_UPLOAD_COPY;
				}
		}
		else{
			$sCh = implode(", ",$aTypeMime);
			return Fichier::ERR_FILE_UPLOAD.$sCh;		
		}
	} //fin de la fonction telecharger()	
	 
	/**	
	 * Permet de lire le contenu d'un dossier
	 * 
	 * @param string $sNomDossier contient le nom du dossier à lire
	 * @param array $aDossiers  contient la liste des dossiers lus dans le dossier dans l'ordre dans lequel le système les stocke.
	 * 
	 * @return boolean : true si la lecture du contenu du dossier s'est bien déroulée
     *                   Une exception est lancée dans les autres cas.
	 */	
	public static function lireDossier($sNomDossier, &$aDossiers){
		if(empty($sNomDossier) == true )
			throw new Exception(get_class(). "::". Dossier::ERR_VALIDATE_EMPTY." sNomDossier");
		
		if(is_numeric($sNomDossier) == true )
			throw new Exception(get_class(). "::". Dossier::ERR_VALIDATE_STRING." sNomDossier");
		
		$ptrDossier = @opendir($sNomDossier);
		if (!$ptrDossier)
			throw new Exception(get_class(). "::". Dossier::ERR_DIR_OUVERTURE." sNomDossier");
	
		$iFichier = -1;
		do {
			$iFichier++;
			$sFile = readdir($ptrDossier);
			$rFichier = @fopen(__DIR__."/".$sNomDossier."/".$sFile, "r");
			if ($rFichier !== false){
				$aDossiers[$iFichier] = $sFile;
				fclose($rFichier);
			}
		}while ($sFile !== false);
	
	   closedir($ptrDossier);
	   return true;
	}//fin de la fonction lireDossier()
}//fin de la classe Fichier

?>