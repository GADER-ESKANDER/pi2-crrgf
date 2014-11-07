<?php


require_once("../libs/MySqliLib.class.php");
require_once("../libs/TypeException.class.php");
require_once("../libs/MySqliException.class.php");




/**
 * @date 2014-09-17
 * @author Gader ESKANDER
 * @brief Classe Contact
 * @details ajouter/rechercher/modifier/supprimer un Contact de la base de données
 */

class Contact {

	/**
	 * 
	 * @var int
	 * @access private
	 */
	private  $idContact;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $nomContact;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $prenomContact;

	/**
	 * 
	 * @var sting
	 * @access private
	 */
	private  $courriel;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $message;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $dateContact;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private  $statut;
	
	
	/**
	 * @access public
	 */
	public function __construct($idContact = 0, $nomContact = " ", $prenomContact = " ", $courriel = " ", $message = " ", $dateContact=" ", $statut=" ") {
		$this -> setIdContact($idContact);
		$this -> setNomContact($nomContact);
		$this -> setPrenomContact($prenomContact);
		$this -> setCourriel($courriel);
		$this -> setMessage($message);
		$this -> setDateContact($dateContact);
		$this -> setstatut($statut);
	}//fin de la fonction __construct()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit un numéro de Contact
	 * @param integer $idContact Numéro du Contact
	 */
	public function setIdContact($idContact) {
		TypeException::estNumerique($idContact);
		$this -> idContact = $idContact;
	}//fin de la fonction setIdContact()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit le nom du Contact
	 * @param string $nomContact nom du Contact
	 */
	public function setNomContact($nomContact) {
		TypeException::estVide($nomContact);
		TypeException::estString($nomContact);
		$this -> nomContact = $nomContact;
	}//fin de la fonction setCorpsContact()

	/**
	 * Permet d'affecter à la proriété privée une valeur soit un prénoms  du Contact
	 * @param string $prenomContact prénoms  du Contact
	 */
	public function setPrenomContact($prenomContact) {
		TypeException::estVide($prenomContact);
		TypeException::estString($prenomContact);
		$this -> prenomContact = $prenomContact;
	}//fin de la fonction setPrenomContact()
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit une adresse courriel  du Contact
	 * @param string $courriel adresse courriel du Contact
	 */
	public function setCourriel($courriel) {
		TypeException::estVide($courriel);
		TypeException::estString($courriel);
		$this -> courriel = $courriel;
	}//fin de la fonction setCourriel()

	
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit un message du Contact
	 * @param string $message un message du Contact
	 */
	public function setMessage($message) {
		TypeException::estVide($message);
		TypeException::estString($message);
		$this -> message = $message;
	}//fin de la fonction setMessage()
	
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit une date du Contact
	 * @param string $dateContact une date du Contact
	 */
	public function setDateContact($dateContact) {
		TypeException::estVide($dateContact);
		$this -> dateContact = $dateContact;
	}//fin de la fonction setDate()
	
	
	/**
	 * Permet d'affecter à la proriété privée une valeur soit un statut du Contact
	 * @param string $date un statut du Contact
	 */
	public function setStatut($statut) {
		$this -> statut = $statut;
	}//fin de la fonction setStatut()

	

	/**
	 * Permet de récupérer la valeur de la propriété privée soit le numéro du Contact
	 * @return integer Le numéro du Contact
	 */
	public function getIdContact() {

		return $this -> idContact;
	}//fin de la fonction getIdContact()
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit le corps du Contact
	 * @return integer le corps du Contact
	 */
	public function getNomContact() {

		return $this -> nomContact;
	}//fin de la fonction getNomContact()
	
	
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit un prénoms  du Contact
	 * @return integer prénoms  du Contact
	 */
	public function getPrenomContact() {

		return $this -> prenomContact;
	}//fin de la fonction getPrenomContact()
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit une adresse courriel du Contact
	 * @return integer une adresse courriel du Contact
	 */
	public function getCourriel() {
		return $this -> courriel;
	}//fin de la fonction getContact()
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit un message du Contact
	 * @return integer un message du Contact
	 */
	public function getMessage() {
		return $this -> message;
	}//fin de la fonction getMessage()
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit une date du Contact
	 * @return integer une date du Contact
	 */
	public function getDateContact() {
		return $this -> dateContact;
	}//fin de la fonction getDateContact()
	
	/**
	 * Permet de récupérer la valeur de la propriété privée soit un statut du Contact
	 * @return integer un statut du Contact
	 */
	public function getStatut() {
		return $this -> statut;
	}//fin de la fonction getStatut()
	
	
// -------------------------Méthodes()-----------------------------------------------------


	/**
	 * Permet de rechercher un Contact
	 * @access public
	 * @return boolean true si la recherche est fructueuse (le Contact est trouvé) 
	 * soit false (le Contact n'est pas trouvé) 
	 */
	public final  function rechercherUnContact() {
		//Connecter à la base de données
		$oConnexion = new MySqliLib();
		//Réaliser la requête de recherche par le idMedia	
		$sRequete = "SELECT * FROM pi2_contacts WHERE idContact = ".$this->idContact;
		$bRechercher = false;
		//Exécuter la requête
		$oResult = $oConnexion->executer($sRequete);
		
		//Récupérer le tableau des enregistrements s'il existe
		$aContact = $oConnexion->recupererTableau($oResult);
		if(empty($aContact[0]) != true){
			//Affecter les propriétés de l'objet en cours avec les valeurs
			$this->setNomContact($aContact[0]['nomContact']);
			$this->setPrenomContact($aContact[0]['prenomContact']);
			$this->setCourriel($aContact[0]['courriel']);
			$this->setMessage($aContact[0]['message']);
			$this->setDateContact($aContact[0]['dateContact']);
			$this->setStatut($aContact[0]['statut']);
			$bRechercher=true;	
		}
		return $bRechercher;
	}//fin de la fonction rechercherUnContact()
	
	/**
	 * Ajouter un Contact
	 * @access public
	 * @return boolean la valeur de l'identifiant qui vient d'être inséré si l'ajout s'est bien déroulé
	 * false dans tous les autres cas.
	 */
	function ajouterUnContact(){
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requête d'ajout du Contact
		$date= date("d-M-Y")." , ".date("G:i");
		$sRequete = "
			INSERT INTO pi2_contacts
			SET nomContact = '".$oConnexion->getConnect()->real_escape_string($this->nomContact)."',"
			
			."  prenomContact = '".$oConnexion->getConnect()->real_escape_string($this->prenomContact)."',"
			
			."  courriel = '".$oConnexion->getConnect()->real_escape_string($this->courriel)."',"
			
			."  message = '".$oConnexion->getConnect()->real_escape_string($this->message)."',"
			
			." dateContact = '".$date."',"
			
			."  statut = ''
		";
		//Exécuter la requête
		if($oConnexion->executer($sRequete) == true){
			return $oConnexion->getConnect()->insert_id;
		}
		return false;
	}//fin de la fonction ajouterUnContact()	
	

	/**
	 * Supprimer un Contact à partir de son idContact
	 * @access public
	 * @return boolean true si la suppression s'est bien déroulée
	 * false dans tous les autres cas
	 */
	public  function supprimerUncontact(){
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requete de suppression de Contact identifié par son idContact
		$sRequete = "
			DELETE FROM pi2_contacts
			WHERE idContact = ".$this->getIdContact().";";
		
		//Exécuter la requête
	$oConnexion->executer($sRequete);
	}//fin de la fonction supprimerUncontact()	
	
	/**
	 *Modifier le statut du contact de Non Répense au Répense  
	 * @access public
	 */
	 
	public function modifierStatutContact() {
		//Connexion à la base de données
		$oConnexion = new MySqliLib();
		//Requete de modification de statut du contact
		$sRequete = "
			UPDATE pi2_contacts
			SET statut = 'Repense'
			WHERE idContact = ".$this->idContact."
		";	
		
		//Exécuter la requête
		return $oConnexion->executer($sRequete);

	}
	
	
	/**
	 * Rechercher tous les contacts de la base de données
	 * @return array ce tableau contient des objets Contact
	 */
	 public static function rechercherListeDesContacts(){
	 	//Connexion à la base de données
	 	$oConnexion = new MySqliLib();
	 	//Requête de recherche de tous les contacts
	 	$sRequete = "
	 		SELECT * FROM pi2_contacts ORDER BY idContact DESC
	 	";
	 	//Exécuter la requête
	 	$oResult = $oConnexion->executer($sRequete);
	 	//Récupérer le tableau des enregistrements
	 	$aEnreg = $oConnexion->recupererTableau($oResult);
		$aContacts = array();
	 	//Pour tous les enregistrements
	 	for($iEnreg=0; $iEnreg<count($aEnreg); $iEnreg++){
	 		//affecter un objet à un élément du tableau
	 		$aContacts[$iEnreg] =  new Contact($aEnreg[$iEnreg]['idContact'], $aEnreg[$iEnreg]['nomContact'], $aEnreg[$iEnreg]['prenomContact'], $aEnreg[$iEnreg]['courriel'], $aEnreg[$iEnreg]['message'], $aEnreg[$iEnreg]['dateContact'], $aEnreg[$iEnreg]['statut']);
	 	}
	 	//retourner le tableau d'objets
	 	return $aContacts;
	 }//fin de la fonction rechercherListeDesContacts()
	 

}// Fin class Contact
?>