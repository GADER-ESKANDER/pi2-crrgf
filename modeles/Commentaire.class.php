<?php
/**
 * À faire :debugger la fonction modifierUnCommentaire()
 * 
 */

/**
 * @date 2014-09-17
 * @author Gader ESKANDER
 * @brief Classe Commentaire
 * @details ajouter/rechercher/modifier/supprimer un Commentaire de la base de données
 */

class Commentaire {

	/**
	 *
	 * @var int
	 * @access private
	 */
	private $idCommentaire;

	/**
	 *
	 * @var string
	 * @access private
	 */
	private $corpsCommentaire;
	
	/**
	 *
	 * @var date
	 * @access private
	 */
	private $dateCommentaire;

	/**
	 *
	 * @var string
	 * @access private
	 */
	private $abus;

	/**
	 *
	 * @var int
	 * @access private
	 */
	private $idUtilisateur;

	/**
	 *
	 * @var int
	 * @access private
	 */
	private $idEnchere;

	/**
	 * @access public
	 */
	public function __construct($idCommentaire = 0, $corpsCommentaire = " ", $dateCommentaire =" ", $abus = "Non", $idUtilisateur = 0, $idEnchere = 0) {
		$this -> setIdCommentaire($idCommentaire);
		$this -> setCorpsCommentaire($corpsCommentaire);
		$this -> setDateCommentaire($dateCommentaire);
		$this -> setAbus($abus);
		$this -> setIdUtilisateur($idUtilisateur);
		$this -> setIdEnchere($idEnchere);
	}//fin de la fonction __construct()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit un numéro de Commentaire
	 * @param integer $idCommentaire Numéro du Commentaire
	 */
	public function setIdCommentaire($idCommentaire) {
		TypeException::estNumerique($idCommentaire);
		$this -> idCommentaire = $idCommentaire;
	}//fin de la fonction setIdCommentaire()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit le corps du Commentaire
	 * @param string $corpsCommentaire corps du Commentaire
	 */
	public function setCorpsCommentaire($corpsCommentaire) {
		TypeException::estVide($corpsCommentaire);
		TypeException::estString($corpsCommentaire);
		$this -> corpsCommentaire = $corpsCommentaire;
	}//fin de la fonction setCorpsCommentaire()
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit un dateCommentaire  pour un Commentaire
	 * @param string $dateCommentaire
	 */
	public function setDateCommentaire($dateCommentaire) {
		$this -> dateCommentaire = $dateCommentaire;
	}//fin de la fonction setDateCommentaire()
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit un abus  pour un Commentaire
	 * @param string $abus
	 */
	public function setAbus($abus) {
		$this -> abus = $abus;
	}//fin de la fonction setAbus()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit le numéro d'utilisateur
	 * @param integer $idUtilisateur Numéro d'utilisateur
	 */
	public function setIdUtilisateur($idUtilisateur) {
		TypeException::estNumerique($idUtilisateur);
		$this -> idUtilisateur = $idUtilisateur;
	}//fin de la fonction setIdUtilisateur()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit un numéro d'enchère
	 * @param integer $idEnchere Numéro d'enchère
	 */
	public function setIdEnchere($idEnchere) {
		TypeException::estNumerique($idEnchere);
		$this -> idEnchere = $idEnchere;
	}//fin de la fonction setIdEnchere()

	/**
	 * Permet de récupérer la valeur de la propriété privée soit le numéro du Commentaire
	 * @return integer Le numéro du Commentaire
	 */
	public function getIdCommentaire() {

		return $this -> idCommentaire;
	}//fin de la fonction getIdCommentaire()

	/**
	 * Permet de récupérer la valeur de la propriété privée soit le corps du Commentaire
	 * @return integer le corps du Commentaire
	 */
	public function getCorpsCommentaire() {

		return $this -> corpsCommentaire;
	}//fin de la fonction getCorpsCommentaire()

	/**
	 * Permet de récupérer la valeur de la propriété privée soit un abus  pour un Commentaire
	 * @return integer un abus  pour un Commentaire
	 */
	public function getAbus() {

		return $this -> abus;
	}//fin de la fonction getAbus()
	/**
	 * Permet de récupérer la valeur de la propriété privée soit un dateCommentaire  pour un Commentaire
	 * @return integer un dateCommentaire  pour un Commentaire
	 */
	public function getDateCommentaire() {

		return $this -> dateCommentaire;
	}//fin de la fonction DateCommentaire()

	/**
	 * Permet de récupérer la valeur de la propriété privée soit le numéro d'utilisateur
	 * @return integer Le numéro du Commentaire
	 */
	public function getIdUtilisateur() {

		return $this -> idUtilisateur;
	}//fin de la fonction getIdUtilisateur()

	/**
	 * Permet de récupérer la valeur de la propriété privée soit le numéro d'enchère
	 * @return integer Le numéro d'enchère
	 */
	public function getIdEnchere() {

		return $this -> idEnchere;
	}//fin de la fonction getIdEnchere()

	// -------------------------Méthodes()-----------------------------------------------------

	/**
	 * Ajouter un Commentaire
	 * @access public
	 * @return boolean la valeur de l'identifiant qui vient d'être inséré si l'ajout s'est bien déroulé
	 * false dans tous les autres cas.
	 */
	 
	public function ajouterUnCommentaire() {
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requête d'ajout du Commentaire
		$date= date("d-M-Y")." , ".date("G:i");
		$sRequete = "
			INSERT INTO pi2_commentaires
			SET corpsCommentaire = '".$oConnexion->getConnect()->real_escape_string($this->corpsCommentaire)."',"

			." dateCommentaire = '".$date."',"
			
			."  abus = '',"
			
			."  utilisateur_id = ".$this-> idUtilisateur.","
			
			." enchere_id = ".$this-> idEnchere."

		";
		
		//Exécuter la requête
		if ($oConnexion -> executer($sRequete) == true) {
			return $oConnexion -> getConnect() -> insert_id;
		}
		return false;
	}//fin de la fonction ajouterUnCommentaire()

	
	/**
	 * Permet de rechercher un Commentaire par son numéro d'enchère
	 * @return boolean true si la recherche est fructueuse (le Commentaire est trouvé) 
	 * soit false (le Commentaire n'est pas trouvé)
	 */
	public function recherUnCommentParIdEnchere(){		
		//Connecter à la base de données
		$oConnexion = new MySqliLib();
		//Réaliser la requête de recherche par le idProduit	
		$sRequete = "SELECT * FROM pi2_commentaires WHERE enchere_id = ".$this->idEnchere;
		
		$bRechercher = false;
		//Exécuter la requête
		$oResult = $oConnexion->executer($sRequete);
		//Récupérer le tableau des enregistrements s'il existe
		$aCommentaires = $oConnexion->recupererTableau($oResult);
		if(empty($aCommentaires[0]) != true){
			//Affecter les propriétés de l'objet en cours avec les valeurs
			$this->setIdCommentaire($aCommentaires[0]['idCommentaire']);
			$this->setCorpsCommentaire($aCommentaires[0]['corpsCommentaire']);
			$this->setDateCommentaire($aCommentaires[0]['dateCommentaire']);
			$this->setAbus($aCommentaires[0]['abus']);
			$this->setIdUtilisateur($aCommentaires[0]['utilisateur_id']);
			$this->setIdEnchere($aCommentaires[0]['enchere_id']);
			$bRechercher=true;	
		}
		return $bRechercher;
	}//fin de la fonction rechercherUnMediaParNoProduit()
	

	
	/**
	 * Permet de rechercher un Commentaire
	 * @access public
	 * @return boolean true si la recherche est fructueuse (le Commentaire est trouvé) 
	 * soit false (le Commentaire n'est pas trouvé) 
	 */
	public final  function rechercherUnCommentaire() {
		//Connecter à la base de données
		$oConnexion = new MySqliLib();
		//Réaliser la requête de recherche par le idMedia	
		$sRequete = "SELECT * FROM pi2_commentaires WHERE idCommentaire = ".$this->idCommentaire;
		
		$bRechercher = false;
		//Exécuter la requête
		$oResult = $oConnexion->executer($sRequete);
		//Récupérer le tableau des enregistrements s'il existe
		$aCommentaires = $oConnexion->recupererTableau($oResult);
		if(empty($aCommentaires[0]) != true){
			//Affecter les propriétés de l'objet en cours avec les valeurs
			$this->setIdCommentaire($aCommentaires[0]['idCommentaire']);
			$this->setCorpsCommentaire($aCommentaires[0]['corpsCommentaire']);
			$this->setDateCommentaire($aCommentaires[0]['dateCommentaire']);
			$this->setAbus($aCommentaires[0]['abus']);
			$this->setIdUtilisateur($aCommentaires[0]['utilisateur_id']);
			$this->setIdEnchere($aCommentaires[0]['enchere_id']);
			$bRechercher=true;		
		}
		return $bRechercher;
	}//fin de la fonction rechercherUnCommentaire()
	

	
	/**
	 * Supprimer un Commentaire à partir de son idCommentaire
	 * @access public
	 * @return boolean true si la suppression s'est bien déroulée
	 * false dans tous les autres cas
	 */
	public  function supprimerUnCommentaire(){
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requete de suppression de Commentaire identifié par son idCommentaire
		$sRequete = "
			DELETE FROM pi2_commentaires
			WHERE idCommentaire = ".$this->getIdCommentaire().";";
		//Exécuter la requête
		return $oConnexion->executer($sRequete);
	}//fin de la fonction supprimerUnCommentaire()	
	
	
	
	/**
	 * Modifier un Commentaire
	 * @access public
	 * @return boolean true si l'ajout s'est bien déroulé
	 * false dans tous les autres cas.
	 */
	public function modifierUnCommentaire(){
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requête d'ajout du Commentaire
		$date= date("d-M-Y")." , ".date("G:i");
		$sRequete = "
			INSERT INTO pi2_commentaires
			SET corpsCommentaire = '".$oConnexion->getConnect()->real_escape_string($this->corpsCommentaire)."',"

			." dateCommentaire = '".$date."',"
			
			."  abus = 'Non',"
			
			."  utilisateur_id = ".$this-> idUtilisateur.","
			
			." enchere_id = ".$this-> idEnchere."
			WHERE idCommentaire = ".$this->idCommentaire."
		";
		
		//Exécuter la requête
		return $oConnexion->executer($sRequete);
	}
	
	/**
	 * Rechercher tous les commentaires de la base de données pour un enchère
	 * @return array ce tableau contient des objets commentaire
	 */
	 public static function recherListeCommentairesParIdEnchere($idEnchere){
	 	//Connecter à la base de données
		$oConnexion = new MySqliLib();
		//Réaliser la requête de recherche par le idProduit	
		$sRequete = "SELECT * FROM pi2_commentaires WHERE enchere_id =".$idEnchere." ORDER BY idCommentaire DESC";
		
		//Exécuter la requête
	 	$oResult = $oConnexion->executer($sRequete);
	 	//Récupérer le tableau des enregistrements
	 	$aEnreg = $oConnexion->recupererTableau($oResult);
		$aCommentaires = array();
	 	//Pour tous les enregistrements
	 	for($iEnreg=0; $iEnreg<count($aEnreg); $iEnreg++){
	 		//affecter un objet à un élément du tableau
	 		$aCommentaires[$iEnreg] =  new Commentaire($aEnreg[$iEnreg]['idCommentaire'], $aEnreg[$iEnreg]['corpsCommentaire'], $aEnreg[$iEnreg]['dateCommentaire'], $aEnreg[$iEnreg]['abus'], $aEnreg[$iEnreg]['utilisateur_id'], $aEnreg[$iEnreg]['enchere_id']);
	 	}
	 	//retourner le tableau d'objets
	 	return $aCommentaires;
		
	 }//fin de la fonction recherListeCommentairesParIdEnchere()
	 

	
	/**
	 * Rechercher tous les commentaires de la base de données
	 * @return array ce tableau contient des objets commentaire
	 */
	 public static function adm_rechercherListeDesCommentaires(){
	 	//Connexion à la base de données
	 	$oConnexion = new MySqliLib();
	 	//Requête de recherche de tous les commentaires
		$sRequete = "SELECT * FROM pi2_commentaires ORDER BY idCommentaire DESC";
	 	//Exécuter la requête
	 	$oResult = $oConnexion->executer($sRequete);
	 	//Récupérer le tableau des enregistrements
	 	$aEnreg = $oConnexion->recupererTableau($oResult);
		$aCommentaires = array();
	 	//Pour tous les enregistrements
	 	for($iEnreg=0; $iEnreg<count($aEnreg); $iEnreg++){
	 		//affecter un objet à un élément du tableau
	 		$aCommentaires[$iEnreg] =  new Commentaire($aEnreg[$iEnreg]['idCommentaire'], $aEnreg[$iEnreg]['corpsCommentaire'], $aEnreg[$iEnreg]['dateCommentaire'], $aEnreg[$iEnreg]['abus'], $aEnreg[$iEnreg]['utilisateur_id'], $aEnreg[$iEnreg]['enchere_id']);
	 	}
	 	//retourner le tableau d'objets
	 	return $aCommentaires;
	 }//fin de la fonction adm_rechercherListeDesCommentaires()
	 
	
	
	
	/**
	 *Signaler un abus pour un commentaire  
	 * @access public
	 */
	 
	public function SignalerAbus() {
		// var_dump($this);exit;
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requete de modification Modification de champs abus dansle bd
		$sRequete = "
			UPDATE pi2_commentaires
			SET abus = 'Abus'
			WHERE idCommentaire = ".$this->idCommentaire."
		";	
		
		//Exécuter la requête
		return $oConnexion->executer($sRequete);

	}
	
	
	
	
	
	
	
	
	

}// Fin class commentaire
?>