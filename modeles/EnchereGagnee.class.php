<?php
/**
 * @class EnchereGagnee EnchereGagnee.class.php "modeles/EnchereGagnee.class.php"
 * @version 0.0.2
 * @date 2014-11-04
 * @author Eric Revelle
 * @brief Gère les encheres gagnées
 * @details Permet de connaîtres les enchères qui ont été gagnées
 */
class EnchereGagnee extends Modeles {

	private $id;
	private $iEnchereId;
	private $iUtilisateurId;
	private $sDate;

	public function  __construct() {

		parent::__construct();

	}

	public function setId($id) {

		TypeException::estInteger();
		$this->id = $id;

	}

	public function getEncheresGagneesParIdUtilisateur($iUtilisateurId = 1) {

		$sSQL = "SELECT * FROM 'pi2_encheresgagnees' WHERE 'utilisateur_id' = ".$iUtilisateurId." ORDER BY 'date' DESC;";
		$sRequete = $this->oPDO->prepare($sSQL);
		die(gettype($sRequete));

	}

}