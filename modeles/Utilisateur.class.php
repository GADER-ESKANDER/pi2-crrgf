<?php
/**
 * @class Utilisateur Utilisateur.class.php "modeles/Utilisateur.class.php"
 * @version 0.0.1
 * @date 2014-10-20
 * @author Martin Côté
 * @brief Modèles Utilisateur
 * @details Modele contenant les fonctions Utilisateurs
 */

class Utilisateur extends Modeles{

	/* Propriétés privées */
	private $idUtilisateur;
	private $sNom;
	private $sPrenom;
	private $sCourriel;
	private $sMotDePasse;
	//private $sTel;
	private $sTypeUtilisateur;
	private $sEtat;


	/**
	 * variable qui provient de la relation de composition
	 * entre la classe Dossier et la classe Etudiant
	 */
	/**
	 * Constructeur
	 * @param integer $idEtudiant
	 * @param string $sNom
	 * @param string $sPrenom
	 * @param integer $iAge
	 */
	public function __construct($idUtilisateur=0, $sNom=" ", $sPrenom=" ", $sCourriel=" ", $MotDePasse=" ",$sTypeUtilisateur="membre",$sEtat="actif" ){

		$this->setIdUtilisateur($idUtilisateur);
		$this->setNom($sNom);
		$this->setPrenom($sPrenom);
		$this->setCourriel($sCourriel);
		$this->setMotDePasse($MotDePasse);
		//$this->setTel($sTel);
		$this->setTypeUtilisateur($sTypeUtilisateur);
		$this->setEtat($sEtat);

	} //fin du constructeur

	/* Affectation */
	/**
	 *  * @param string $sNom
	 */
	public function setNom($sNom){
		TypeException::estNom($sNom);
		TypeException::estVide($sNom);
		$this->sNom = $sNom;
	}
	/**
	 * @param string $sPrenom
	 */
	public function setPrenom($sPrenom){
		TypeException::estPrenom($sPrenom);
		TypeException::estVide($sPrenom);

		$this->sPrenom = $sPrenom;
	}
	/**
	 * @param string $sCourriel
	 */
	public function setCourriel($sCourriel){
		TypeException::estCourriel($sCourriel);

		TypeException::estVide($sCourriel);


		$this->sCourriel = $sCourriel;
	}
	/**
	 * @param integer $idUtilisateur
	 */

	public function setIdUtilisateur($idUtilisateur){
		TypeException::estNumerique($idUtilisateur);

		$this->idUtilisateur = $idUtilisateur;
	}
	/**
	* @param string $sTel
	*/
	/*public function setTel($sTel){
		TypeException::estString($sTel);
		TypeException::estVide($sTel);

		$this->sTel = $sTel;
	}
*/
	/**
	* @param string $sTypeUtilisateur
	*/
	public function setTypeUtilisateur($sTypeUtilisateur){
		TypeException::estString($sTypeUtilisateur);

		TypeException::estVide($sTypeUtilisateur);

		$this->sTypeUtilisateur = $sTypeUtilisateur;


	}
	/**
	* @param string $sEtat
	*/
	public function setEtat($sEtat){

		TypeException::estString($sEtat);
		TypeException::estVide($sEtat);

		$this->sEtat = $sEtat;


	}
	/**
	* @param string $sMotDePasse
	*/
	public function setMotDePasse($sMotDePasse){

		
		TypeException::estPassword($sMotDePasse);

		TypeException::estVide($sMotDePasse);

		$this->sMotDePasse = $sMotDePasse;
	}


	
	/**
	 *  * @return string $sNom
	 */
	public function getNom(){
		return htmlentities($this->sNom);
	}
	/**
	 * @return string $sPrenom
	 */
	public function getPrenom(){
		return htmlentities($this->sPrenom);
	}
	/**
	 * @return integer $sCourriel
	 */
	public function getCourriel(){
		return $this->sCourriel;
	}
	/**
	 * @return string $sMotDePasse
	 */
	public function getMotDePasse(){

		return $this->sMotDePasse;

	}
	/**
	 * @return string $sTelRes
	 */
	/*public function getTel(){

		return $this->sTel;

	}*/
	/**
	 * @return string $Etat
	 */
	public function getEtat(){
		return $this->sEtat;
	}
	/**
	 * @return string $sTypeUtilisateur
	 */
	public function getTypeUtilisateur(){
		return $this->sTypeUtilisateur;
	}
	/**
	 * @return integer $idUtilisateur
	 */
	public function getIdUtilisateur(){
		return $this->idUtilisateur;
	}

	/**
	 * Rechercher un utilisateur par son idUtilisateur
	 * @return boolean true si l'enregistrement est trouvé dans la BDD
	 * false dans tous les autres cas
	 */
	function rechercherUnUtilisateur(){

		$oPDO = new Connexion();

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "SELECT * FROM pi2_utilisateurs WHERE id=".$this->getIdUtilisateur();
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			//s'il y a un résultat
			if ( $requete->rowCount() ) {

				$aResultats = $requete->fetchAll();
				$this->setNom($aResultats[0]['nom']);
				$this->setPrenom($aResultats[0]['prenom']);
				$this->setCourriel($aResultats[0]['courriel']);
				$this->setIdUtilisateur($aResultats[0]['id']);
				//$this->setTel($aResultats[0]['telephone']);
				$this->setEtat($aResultats[0]['etat']);
				$this->setMotDePasse($aResultats[0]['motDePasse']);
				$this->setTypeUtilisateur($aResultats[0]['type']);

			} else {

				//$sMsg = array('type'=>'warning', 'msg'=>'Aucune aucun utilisateur n'a été trouvé);

			}

		} else {

			throw new Exception("Erreur lors de la requete");
			//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}//fin de rechercher un utilisateur()

	public function rechercherUtilisateurParEmail(){

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "SELECT * FROM pi2_utilisateurs WHERE courriel=".$this->getCourriel();

		//préparer la requête
        $oPDO = new Connexion();
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			//s'il y a un résultat
			if ( $requete->rowCount() ) {

				$aResultats = $requete->fetchAll();
				$this->setNom($aResultats[0]['nom']);
				$this->setPrenomm($aResultats[0]['prenom']);
				$this->setCourriel($aResultats[0]['courriel']);
				$this->setIdUtilisateur($aResultats[0]['id']);
				//$this->setTel($aResultats[0]['telephone']);
				$this->setEtat($aResultats[0]['etat']);
				$this->setMotDePasse($aResultats[0]['motDePasse']);
				$this->setTypeUtilisateur($aResultats[0]['type']);

			} else {

				//$sMsg = array('type'=>'warning', 'msg'=>'Aucune aucun utilisateur n'a été trouvé);

			}

		} else {

			throw new Exception("Erreur lors de la requete");
			//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}
	public static function emailExiste($sCourriel){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "SELECT * FROM pi2_utilisateurs WHERE courriel='".$sCourriel."' AND etat='actif'";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			//s'il y a un résultat
			if ( $requete->rowCount() ) {

				return true;

			}else{
				return false;
			}
		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}
	}
	public function ajouterUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "INSERT INTO pi2_utilisateurs VALUES(0,'".$this->sNom."','".$this->sPrenom."','".$this->sCourriel."','".$this->sMotDePasse."','".$this->sTypeUtilisateur."','".$this->sEtat."') ";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			$_SESSION['idUser'] = $oPDO->oPDO->lastInsertId();
		} else {

			throw new Exception("Erreur lors de la requete");
			//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}


	}

	public function connexionUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "Select * FROM pi2_utilisateurs WHERE motDePasse='".$this->sMotDePasse."' AND courriel='".$this->sCourriel."' AND etat='actif'";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			if ( $requete->rowCount() ) {
				$aResultats = $requete->fetchAll();

				$this->idUtilisateur=$aResultats[0]["id"];
				return true;

			}else{
				return false;
			}
		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}
	}

	public function modifierUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			UPDATE pi2_utilisateurs
			SET nom='".$this->getNom()."', prenom='".$this->getPrenom()."', courriel='".$this->getCourriel()."', motDePasse='".$this->getMotDePasse()."'
			WHERE id='".$_SESSION['idUser']."'
		";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			if ( $requete->rowCount() ) {

				return true;

			}else{
				return false;
			}
		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}//Fin modifierUtilisateur

	public function desactiverUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			UPDATE pi2_utilisateurs
			SET etat='inactif'
			WHERE id='".$_SESSION['idUser']."'
		";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
				unset($_SESSION['idUser']);


		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}

	public function adm_ajouterUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "INSERT INTO pi2_utilisateurs VALUES('','".$this->sNom."','".$this->sPrenom."','".$this->sCourriel."','".$this->sMotDePasse."','".$this->sTypeUtilisateur."','".$this->sEtat."') ";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			header("location:index.php");
		} else {

			throw new Exception("Erreur lors de la requete");
			//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}//Fin adm_ajouterUtilisateur()

	public function adm_modifierUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			UPDATE pi2_utilisateurs
			SET nom='".$this->getNom()."', prenom='".$this->getPrenom()."', courriel='".$this->getCourriel()."', motDePasse='".$this->getMotDePasse()."', type='".$this->getTypeUtilisateur()."', etat='".$this->getEtat()."'
			WHERE id='".$this->getIdUtilisateur()."'
		";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			if ( $requete->rowCount() ) {

				return true;

			}else{
				return false;
			}
		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}//Fin adm_modifierUtilisateur()

	public function adm_desactiverUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			UPDATE pi2_utilisateurs
			SET etat='inactif'
			WHERE id='".$this->getIdUtilisateur."'
		";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			return true;


		} else {

			throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');
			return false;
		}
	}//Fin adm_desactiverUtilisateur()

	public function adm_supprimerUtilisateur(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			DELETE FROM 'pi2_encheres'.'pi2_utilisateurs' WHERE id='".$this->getIdUtilisateur."'
		";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			return true;


		} else {

			throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');
			return false;
		}
	}//Fin adm_supprimerUtilisateur()

	public static function adm_rechercherUtilisateurs($recherche){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "
			SELECT * FROM pi2_utilisateurs WHERE
			id LIKE'".$recherche."' OR
			nom LIKE'".$recherche."' OR
			prenom LIKE'".$recherche."' OR
			courriel LIKE'".$recherche."' OR
			type LIKE'".$recherche."' OR
			etat LIKE'".$recherche."'";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			//s'il y a un résultat
			if ( $requete->rowCount() ) {

				$aResultats = $requete->fetchAll();
				for($i=0 ;$i<count($aResultats); $i++){

					$aoUtilisateur[$i] = new Utilisateur($aResultats['id'], $aResultats['nom'], $aResultats['prenom'], $aResultats['courriel'], $aResultats['motDePasse'], $aResultats['type'], $aResultats['etat']);

					return $aoUtilisateur;

				}

			} else {

				//$sMsg = array('type'=>'warning', 'msg'=>'Aucune aucun utilisateur n'a été trouvé);

			}
		}


	}//Fin adm_rechercherUtilisateur()

	public function adm_connexion(){
		//ouverture de la connexion
		$oPDO = new Connexion;

		//Réaliser la requête de recherche par le idEtudiant
		$sSQL = "Select * FROM pi2_utilisateurs WHERE motDePasse='".$this->sMotDePasse."' AND courriel='".$this->sCourriel."' AND type='admin'";
		//préparer la requête
		$requete = $oPDO->oPDO->prepare($sSQL);
		//Exécuter la requête
		if ( $requete->execute() ) {
			if ( $requete->rowCount() ) {
				$aResultats = $requete->fetchAll();

				$this->idUtilisateur=$aResultats[0]["id"];
				return true;

			}else{
				return false;
			}
		} else {

		throw new Exception("Erreur lors de la requete");
		//$sMsg = array('type'=>'danger', 'msg'=>'Erreur lors de la requete.');

		}

	}//fin adm_connexion();
}

