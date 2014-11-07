<?php
/**
 * @class Modeles Modeles.class.php "modeles/Modeles.class.php"
 * @version 0.0.2
 * @date 2014-10-27
 * @author Eric Revelle
 * @brief Modèles de base
 * @details Modele contenant les fonctions communes a tout les modeles de l'application
 */
class Modeles extends Connexion{

	// Messages d'erreurs
	const ERR_NO_DATA = "Aucune donnee n'a ete trouve";
	const ERR_REQUEST = "Erreur avec la requete";

	public function __construct(){

		parent::__construct();

	}

	public function selectAllFrom($sNomTable) {

		$sSQL = "SELECT * FROM ".$sNomTable.";";

		$requete = $this->oPDO->prepare($sSQL);

		$aResultats=array();

		if ( $requete->execute() ) {

			if ( $requete->rowCount() ) {

				$aResultats = $requete->fetchAll();

			}

			return $aResultats;

		} else {

			throw new Exception(ERR_REQUEST);

		}

	}


	/** Feng's methods **/

	/*public function selectParCondition($sNomTable, $sCondition) {

		$sSQL = "SELECT * FROM ".$sNomTable." ".$sCondition.";";

		$requete = $this->oPDO->prepare($sSQL);

		if( $requete->execute() ) {

			if( $requete->rowCount() ) {

				$aResultats = $requete->fetchAll();

				return $aResultats;

			} else {

				return array();

			}

		}else{

			throw new Exception("Erreur lors de la requete");

		}

	}

	public function executerRequete($sRequete) {

		$requete = $this->oPDO->prepare($sRequete);

		if( $requete->execute() ) {

			return true;

		} else {

			throw new Exception("Erreur lors de la requete");

		}

	}

	public function insertInto($sRequete) {

		$idInsert = $this->executerRequete($sRequete);

		return $this->oPDO->lastInsertId();

	}

	public function deleteFrom($sRequete) {

	   return $this->executerRequete($sRequete);

	}

	public function update($sRequete) {

		return $this->executerRequete($sRequete);

	}*/

}