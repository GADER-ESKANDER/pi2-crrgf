<?php
    class MySqliException extends Exception {

		const ERR_CONNEXION = "Erreur - Le serveur ne répond pas.";
		const ERR_REQUETE="Erreur - La requête est invalide.";

    	/**
		 * détermine si le paramètre est une chaîne vide
		 * @param mysqli $oConnect
		 */
    	public static function estConnecte(mysqli $oConnect){
    		if($oConnect->connect_error){
				throw new Exception(get_class()." :: ".MySqliException::ERR_CONNEXION);
			}
    	}

    	/**
		 * détermine si la requête est valide ou si le serveur n'est pas down
		 * @param mixed $oMysqliResult
		 */
    	public static function estUneRequeteValide($oMysqliResult){
    		if($oMysqliResult == false){
				throw new Exception(get_class()." :: ". MySqliException::ERR_REQUETE);
			}
    	}



		public function __construct($sMsg="", $iCode=0){
			parent::__construct($sMsg, $iCode);
		}

    }
?>