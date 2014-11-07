<?php 
/**
 * Image.class.php
 * Classe Image 
 * Liste des Méthodes :
 * 		public static function telecharger($sNameInputFile, $sDirUpload, $aTypeMime=array("image/gif", "image/pjpeg", "image/jpeg", "image/tiff", "image/vnd.microsoft.icon"), $iTailleMin=150, $iTailleMax=150){
 * 		public static function redimensionnerProportionnel($sUrlImage, $sPath, $sPathDest, $iLargeurMax=150, $iHauteurMax=150, $iBordure=5, $saveCPU= true, $iBorderR=87, $iBorderG=84, $iBorderB=77, $iFondR=186, $iFondG=180, $iFondB=165){
 * 		public static function redimensionner($sUrlImage, $sPath, $sPathDest, $src_x , $src_y, $src_w , $src_h){
 * 
 * @author Caroline Martin cmartin@cmaisonneuve.qc.ca
 * @version 2012-03-23
 */
require_once("TypeException.class.php");
require_once("Fichier.class.php");

class Image extends Fichier{
	
	const ERR_IMAGE_PROPRIETES ="La taille de l'image ne doit pas exc&eacute;der ";
	const ERR_IMAGE_CREATE= "Erreur lors de la création de l'image";
	const ERR_IMAGE_COPY= "Erreur lors de la copie de l'image";
	const ERR_IMAGE_MIME= "Le type MIME spécifié pour cette image n'est pas supporté.";
	
	/**	
	 * Permet de vérifier la taille de l'image  
	 * 
	 * @param string $sNameInputFile la valeur de l'attribut 'name' de la balise input de type 'File'
	 * @param string $sDirUpload le répertoire dans lequel le fichier téléchargé doit être copier
	 * @param $iTailleMin :entier, contient la taille minimale de l'image . 
	 * @param $iTailleMax :entier, contient la taille maximale de l'image . 
	 * @param array $aTypeMime contenant la liste des types Mime 
	 * 
	 * @return  : true si la taille correspond aux valeurs passées en paramètre
	 *                  ERR_IMAGE_SELECT si le fichier n'a pas été sélectionné. 					
	 *               	ERR_IMAGE_PROPRIETES dans le cas où les tailles ne correspondent pas aux valeurs passées en en paramètre
	 */	
	public static function telecharger($sNameInputFile, $sDirUpload, $iTailleMin=150, $iTailleMax=150){
	  	
		TypeException::estNumerique($iTailleMin);
		TypeException::estNumerique($iTailleMax);
		// si le fichier a été choisi
			$aProprietes = getimagesize($_FILES[$sNameInputFile]['tmp_name']);
			if ($aProprietes[0]>$iTailleMin || $aProprietes[1]>$iTailleMax){
			 	return Image::ERR_IMAGE_PROPRIETES ." ".$iTailleMin." x ".$iTailleMax;
			}else{
				return parent::telecharger($sNameInputFile, $sDirUpload, $aTypeMime=array("image/gif", "image/pjpeg", "image/jpeg", "image/jpg", "image/png", "image/tiff", "image/vnd.microsoft.icon"));
			}		
		
	}//fin de la fonction telechargerImage()
	
}//fin de la classe Image
?>