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
	private $sTitre;
	private $fPrixAchat;
	private $sDate;
	private $iUtilisateurId;
	private $iEnchereId;

	public function  __construct($id = 0, $sTitre = " ", $fPrixAchat = 0.0, $sDate = " ", $iUtilisateurId = 0, $iEnchereId = 0 ) {

		parent::__construct();

		$this->setId($id);
		$this->setTitre($sTitre);
		$this->setPrixAchat($fPrixAchat);
		$this->setDate($sDate);
		$this->setUtilisateurId($iUtilisateurId);
		$this->setEnchereId($iEnchereId);

	}


//------------------------------------ SETTERS --------------------------------------

	public function setId($id) {

		TypeException::estInteger($id);
		$this->id = $id;

	}

	public function setTitre($sTitre) {

		TypeException::estVide($sTitre);
		TypeException::estString($sTitre);
		$this->sTitre = $sTitre;

	}

	public function setPrixAchat($fPrixAchat) {

		TypeException::estNumerique($fPrixAchat);
		$this->fPrixAchat = $fPrixAchat;

	}

	public function setDate($sDate) {

		TypeException::estVide($sDate);
		TypeException::estString($sDate);
		$this->sDate = $sDate;

	}

	public function setUtilisateurId($id) {

		TypeException::estInteger($id);
		$this->iUtilisateurId = $id;

	}

	public function setEnchereId($id) {

		TypeException::estInteger($id);
		$this->iEnchereId = $id;

	}


//------------------------------------ GETTERS --------------------------------------

	public function getId() {

		return htmlentities($this->id);

	}

	public function getTitre() {

		return htmlentities($this->sTitre);

	}

	public function getPrixAchat() {

		return htmlentities($this->fPrixAchat);

	}

	public function getDate() {

		return htmlentities($this->sDate);

	}

	public function getUtilisateurId() {

		return htmlentities($this->iUtilisateurId);

	}

	public function getEnchereId() {

		return htmlentities($this->iEnchereId);

	}


//-----------------------------------------------------------------------------------

	public function listeEncheresGagneesParIdUtilisateur($iUtilisateurId) {
		$aOencheresGagnees = array();

		$sSQL = "SELECT eg.id, eg.date, e.prixFin prixAchat, o.titre FROM `pi2_encheresgagnees` AS eg left join pi2_encheres AS e on eg.enchere_id = e.id left join pi2_oeuvres AS o on e.oeuvre_id = o.id WHERE eg.utilisateur_id = ".$iUtilisateurId." ORDER BY `date` DESC;";
		$oRequete = $this->oPDO->prepare($sSQL);

		if ( $oRequete->execute() ) {

			$aResultats = $oRequete->fetchAll();
			//die(var_dump($aResultats));

			foreach ( $aResultats AS $aResultat ) {

				$aOencheresGagnees[] = new EnchereGagnee($aResultat['id'], $aResultat['titre'], $aResultat['prixAchat'], $aResultat['date']);

			}

		} else {

			throw new Exception("Une erreur est survenue avec la requête.");

		}

		return $aOencheresGagnees;

	}

}