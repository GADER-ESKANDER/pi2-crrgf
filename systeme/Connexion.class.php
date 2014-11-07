<?php
/**
 * @classe Connexion Connexion.class.php "systeme/Connexion.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Gère les connexions à la base de données
 * @details Crée une connexion à la base de donnée et sauvegarde celle-ci
 */
class Connexion{

	// Les paramètres de connexion
	protected $sBDConf = 'defaut'; // Parametre de connexion dans "configs/conf.class.php"
	protected $oPDO; // L'objet PDO / la connexion

	/**
	 * Création de la connexion à la base de donnée
	 */
	public function __construct(){

		$conf = Conf::$aBaseDonnees[$this->sBDConf];

		try {

			// Création d'une connexion si elle n'existe pas
			if ( !isset($this->oPDO) ) {

				$oPDO = new PDO('mysql:host='.$conf['hote'].';dbname='.$conf['bd'].'',''.$conf['utilisateur'].'',''.$conf['motDePasse'].''); // Création d'un objet PDO
				$oPDO->exec('set names utf8'); // Force l'encodage de la connexion
				// Configuration d'attributs PDO
				$oPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Définit le mode de récupération par défaut - Fetch associatif
				$oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // PDO::ERRMODE_SILENT, simplement les codes d'erreur. PDO::ERRMODE_WARNING: alerte E_WARNING. PDO::ERRMODE_EXCEPTION émet une exception.
	    		$oPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Active ou désactive la simulation des requêtes préparées.
				$this->oPDO = $oPDO; // Retourne l'objet PDO (la connexion)

			}

		// Si la connexion ne fonctionne pas
		} catch (PDOException $e) {

			// Message à l'utilisateur
			//echo "<p>Une erreur est survenue. Veuillez réessayer plus tard.</p>";

			// Pour le debugage
			echo "Message: ".$e->getMessage()."<br>";
			echo "Code: ".$e->getCode();
			die(); // Empêche le code qui suit de s'execute

		}

	}

}